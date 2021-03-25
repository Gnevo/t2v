<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml", 'button.xml','messages.xml'),FALSE);
$date = new datecalc();
$customer = new customer();
$employee = new employee();
$msg = new message();

//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('message', $msg->show_message()); //messages of actions
$page_start = 1;
$page_limit = 5;
$page_key = "";
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assign sortby firstname or lastname

if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {

    $query_string = explode('&', $_SERVER['QUERY_STRING']);
    $year_week = $query_string[0];
    $page_start = $query_string[1];
    $week_position = 8;
    if (!empty($query_string[2])) {
        $week_position = $query_string[2];
    }else{
        $week_position = $query_string[2];
    }
    if (!empty($query_string[3])) {
        $page_key = $query_string[3];
    }else{
        $page_key = null;
    }
} else {

    $year_week = date('Y') . '|' . date('W');
    $week_position = 8;
}

$smarty->assign('year_week', $year_week);
$smarty->assign('week_position', $week_position);
$smarty->assign('page_start', $page_start);
$smarty->assign('page_key', $page_key);
//get week datas
$week_numbers = $date->get_weeks($year_week, 15, $week_position);
$smarty->assign('week_numbers', $week_numbers);

$employee->employee_privilege();
$total_employees = 0;
if($_SESSION['user_role'] == 1){
    if($page_key){
        $total_pages = ceil(count($employee->employee_list($page_key))/10);
        $employees = $employee->employee_list_limit($page_start-1, $page_limit,$page_key);
    }    
    else{
        $total_pages = ceil(count($employee->employee_list())/10);
        $employees = $employee->employee_list_limit($page_start-1, $page_limit);
    }    
    $pagination = array();
    if($total_pages > 1 && $page_start !=1){
        $pagination[] = '<li><a onclick="navigatePage(\''.$smarty->url.'week/gdschema/'.$year_week.'/1/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);" ><img src="'.$smarty->url.'images/first.png"  /></a></li> ';
        $pagination[] = '<li><a class="prev" onclick="navigatePage(\''.$smarty->url.'week/gdschema/'.$year_week.'/'.($page_start-1).'/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);"><img src="'.$smarty->url.'images/prev.png"  /></a></li> ';
    }
    $loop_start = $page_start;
    
    if($total_pages>1 && $page_start > 1)
        $loop_start = $page_start - 1;
    if($total_pages>1 && $page_start == $total_pages)
        $loop_start = $page_start - 2;
    
    for($i=$loop_start; $i <= $total_pages && $i <= $page_start+2; $i++){
        if($i == $page_start)
            $pagination[] = ' <li><a class="selected" onclick="navigatePage(\''.$smarty->url.'week/gdschema/'.$year_week.'/'.$i.'/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);">'.$i.'</a></li>';
        else
            $pagination[] = ' <li><a onclick="navigatePage(\''.$smarty->url.'week/gdschema/'.$year_week.'/'.$i.'/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);">'.$i.'</a></li>';
    }
    if($total_pages > 1 && $page_start != $total_pages){
        $pagination[] = ' <li><a class="nxt" onclick="navigatePage(\''.$smarty->url.'week/gdschema/'.$year_week.'/'.($page_start+1).'/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);"><img src="'.$smarty->url.'images/nxt.png"  /></a></li> ';
        $pagination[] = '<li><a onclick="navigatePage(\''.$smarty->url.'week/gdschema/'.$year_week.'/'.$total_pages.'/'.$week_position.'/'.$page_key.'/\',1);" href="javascript:void(0);"><img src="'.$smarty->url.'images/last.png"  /></a></li> ';
    }
    //print_r($pagination);
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


//gdschema week data
$smarty->assign('privileges', $employee->employee_privilege());
$smarty->assign('week_datas', $employee->timetable_week($customers, $employees, $year_week));
//$customer->customer_to_allocate($year_week)
if($customers_to_allocate = $customer->non_allocated_customers($year_week)){
    $smarty->assign('customers_to_allocate', $customers_to_allocate);
}
if($employees_to_allocate = $employee->employee_to_allocate($year_week)){
    $smarty->assign('employees_to_allocate', $employees_to_allocate);
}
if($leave_employees = $employee->leave_employee_week($year_week)){
    $smarty->assign('leave_employees', $leave_employees);
}

if($employees[0] == ""){
    $smarty->assign('values','');
}else{
    $smarty->assign('values','hai');
}
//setting layout and page

$smarty->display('gdschema_week.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|gdschema_week.tpl');
?>