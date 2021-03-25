<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml"),FALSE);
//$dona = new dona();
$employee = new employee();
$customer = new customer();
$date = new datecalc();
$msg = new message();
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('message', $msg->show_message()); //messages of actions
$page_start = 1;
$page_limit = 5;
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assign sortby firstname or lastname
if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {

    $query_string = explode('&', $_SERVER['QUERY_STRING']);
    
    $year_week = $query_string[0];
    $week_position = 8;
    if (!empty($query_string[1])) {
        $week_position = $query_string[2];
    }
    //getting date of current week
    $week_data = explode('|', $year_week);
    $year = $week_data[0];
    $page_start = $query_string[1];
    $week_no = sprintf("%02d", $week_data[1]);
    $week_date = date('Y-m-d', strtotime($year . 'W' . $week_no . '1'));
    $page_key = 1;
    if($week_date <= date('Y-m-d') && (date('Y-m-d', strtotime($year . 'W' . $week_no . '7'))) >= date('Y-m-d')){
        
        $week_date = date('Y-m-d');
    }
    if (!empty($query_string[4])) {

        $week_date = $query_string[4];
    }
    if(!empty($query_string[3]) && $query_string[3] != '1'){
        $page_key = $query_string[3];
    }
    
    
} else {

    $year_week = date('Y') . '|' . date('W');
    $week_position = 8;
}
$smarty->assign('page_start', $page_start);
$smarty->assign('page_key', $page_key);
$employees = $customers = array();
if($_SESSION['user_role'] == 1){
    if($page_key){
        $total_pages = ceil(count($employee->employee_list($page_key))/10);
        if($page_key == 1)
            $employees = $employee->employee_list_limit($page_start-1, $page_limit,null);
        else
            $employees = $employee->employee_list_limit($page_start-1, $page_limit,$page_key);
    }    
    else{
        
        $total_pages = ceil(count($employee->employee_list())/10);
        $employees = $employee->employee_list_limit($page_start-1, $page_limit);
    }
    $pagination = array();
    
    if($total_pages > 1 && $page_start !=1){
        $pagination[] = '<li><a onclick="navigatePage(\''.$smarty->url.'day/gdschema/'.$year_week.'/1/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);"><img src="'.$smarty->url.'images/first.png"  /></a></li> ';
        $pagination[] = ' <li><a class="prev" onclick="navigatePage(\''.$smarty->url.'day/gdschema/'.$year_week.'/'.($page_start-1).'/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);"><img src="'.$smarty->url.'images/prev.png"  /></a></li> ';
    }
    $loop_start = $page_start;
//    if($page_start == $total_pages && $total_pages>1)
//        $loop_start = $page_start - 1;
    if($total_pages>1 && $page_start > 1)
        $loop_start = $page_start - 1;
    if($total_pages>1 && $page_start == $total_pages)
        $loop_start = $page_start - 2;
    
    for($i=$loop_start; $i <= $total_pages && $i <= $page_start+1; $i++){
        if($i == $page_start)
            $pagination[] = ' <li><a class="selected" onclick="navigatePage(\''.$smarty->url.'day/gdschema/'.$year_week.'/'.$i.'/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);">'.$i.'</a></li>';
        else
            $pagination[] = ' <li><a onclick="navigatePage(\''.$smarty->url.'day/gdschema/'.$year_week.'/'.$i.'/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);">'.$i.'</a></li>';
    }
    if($total_pages > 1 && $page_start != $total_pages){
        $pagination[] = ' <li><a class="nxt" onclick="navigatePage(\''.$smarty->url.'day/gdschema/'.$year_week.'/'.($page_start+1).'/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);"><img src="'.$smarty->url.'images/nxt.png"  /></a></li> ';
        $pagination[] = '<li><a onclick="navigatePage(\''.$smarty->url.'day/gdschema/'.$year_week.'/'.$total_pages.'/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);"><img src="'.$smarty->url.'images/last.png"  /></a></li> ';
    }
    $employees_detail = array();
    /*$i =0;
    foreach ($employees as $emp_data){
        $employees[$i]['signed_in'] = $employee->chk_employee_rpt_signed($emp_data['username'], $week_date);
        $i++;
    }*/
    $smarty->assign('pagination', $pagination);
    $smarty->assign('employees', $employees);
    $formatted_employees = '';
    if(!empty ($employees)){
        $formatted_employees = "'";
        foreach ($employees as $emps){
            if($emps['username'])
                $formatted_employees .= $emps['username']."','";
        }
        $formatted_employees .= "'";
        $customers = $customer->customer_list_limit($formatted_employees);
        $smarty->assign('customers', $customers);
    }    
}else{
    $employees = $employee->employee_list();
    $smarty->assign('employees', $employees);

    $customers = $customer->customer_list();
    $smarty->assign('customers', $customers);
}

/*$emp_cust_sign_details = array();
if(!empty($customers) && !empty($employees)){
//    echo "<pre>customers".print_r($customers, 1)."</pre>";
//    echo "<pre>employees".print_r($employees, 1)."</pre>";
    foreach ($employees as $elist) {
        foreach ($customers as $clist) {
            $emp_cust_sign_details[$elist['username']][$clist['username']] = $employee->chk_employee_rpt_signed($elist['username'], $clist['username'], $week_date);
        }
    }
//    echo "<pre>emp_cust_sign_details".print_r($emp_cust_sign_details, 1)."</pre>";
}*/
//$customers = $customer->customer_list();
//$smarty->assign('customers', $customers);
//
//$employees = $employee->employee_detail_list($week_date);
//$smarty->assign('employees', $employees);
$smarty->assign('year_week', $year_week);
$smarty->assign('week_position', $week_position);
$smarty->assign('employee', $employee_username);
//get week datas
$week_numbers = $date->get_weeks($year_week, 15, $week_position);
$smarty->assign('week_numbers', $week_numbers);
$smarty->assign('week_days', $date->get_week_days($year_week, $week_date));
$smarty->assign('date', $week_date);
//gdschema week data
$smarty->assign('privileges', $employee->employee_privilege());
$smarty->assign('day_datas',$hello = $employee->timetable_day($customers, $employees, $week_date));
$smarty->assign('privileges_gd', $employee->get_privileges($_SESSION['user_id'], 1));//setting previlege

if($employees[0] == ""){
    $smarty->assign('values','');
}
else{
    $smarty->assign('values','hai');
}
$customers_to_allocate = $customer->non_allocated_customers($year_week);
if($customers_to_allocate)
    $smarty->assign('customers_to_allocate', $customers_to_allocate);
$employees_to_allocate = $employee->employee_to_allocate($year_week);
if($employees_to_allocate)
    $smarty->assign('employees_to_allocate', $employees_to_allocate);
$leave_employees = $employee->leave_employee_week($year_week);
if($leave_employees)
    $smarty->assign('leave_employees', $leave_employees);

//setting layout and page
$smarty->display('gdschema_day.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|gdschema_day.tpl');
?>