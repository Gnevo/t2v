<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
ob_start("ob_gzhandler");
//require_once ('class/php_Session.php');
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once ('plugins/date_calc.class.php');
require_once('plugins/message.class.php');
require_once('plugins/calender.class.php');

$obj_user = new user();
$customer = new customer();
$obj_employee = new employee();
$messages = new message();
$date_calc = new datecalc();
$calender = new calender();
$obj_user->username = $_SESSION['user_id'];
$obj_user->company_id = $_SESSION['company_id'];

$query_string = array();
$date_tstamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
$date = date('Y-m-d');
$year = (int) date('Y', $date_tstamp);
$this_month = (int) date('m', $date_tstamp);
$week_no = sprintf("%02d", (int) date('W', $date_tstamp));
$year_week = date('o') . '|' . $week_no;
if(isset($_SESSION['year_week_date']) && $_SESSION['year_week_date'] != ""){
    $year_week_date = explode('/', $_SESSION['year_week_date']);
    $year_week = $year_week_date[0];
    $date = $year_week_date[1];
    $week_data = explode('|', $year_week);
    $year = $week_data[0];
    $week_no = sprintf("%02d", $week_data[1]);
    $this_month = date('m', strtotime($date));
    
}
if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {
    $query_string = explode('&', $_SERVER['QUERY_STRING']);
    if($query_string[0] != 'l'){
        
        $year_week = $query_string[0];
        $_SESSION['year_week_date'] = $year_week."/".$query_string[1];
        $date = $query_string[1];

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        
        $this_month = date('m', strtotime($date));
    }
} 
 
//Don't remove 'messages.xml' -> it will set some translates in dashboards for gdschema
$smarty = new smartySetup(array('gdschema.xml','month.xml', 'tooltip.xml', 'user.xml', 'messages.xml'),FALSE);
$login_user_data = $obj_user->validate_secondary_login_username();
$create_date = $login_user_data['last_pw_update_date'];
$date_after = strtotime(date("Y-m-d", strtotime($create_date)) . "+6 month"); // calculating date after 6 month
$expire_days = floor(($date_after-strtotime(date('Y-m-d')))/(60*60*24));
if(isset($query_string[0]) && $query_string[0] == 'l'){
    $smarty = new smartySetup(array('gdschema.xml','month.xml', 'tooltip.xml', 'user.xml', 'messages.xml'));
    $obj_user->update_session();
}
$smarty->assign('expire_days', 16);
if(isset($query_string[1]) && $query_string[1] == '1')
    $smarty->assign('expire_days', $expire_days);


$smarty->assign('message', $messages->show_message());
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('date', $date);
$prv_week = date("Y", strtotime($year . 'W' . $week_no . '1' . '-1 week')) . '|' . date("W", strtotime($year . 'W' . $week_no . '1' . '-1 week'));
$next_week = date("Y", strtotime($year . 'W' . $week_no . '7' . '+1 week')) . '|' . date("W", strtotime($year . 'W' . $week_no . '7' . '+1 week'));
$smarty->assign('prv_week', $prv_week);
$smarty->assign('next_week', $next_week);

// Taking employee list
$employees = $obj_employee->employee_list();

$first_50_emps = array_slice($employees, 0, 15);
//echo "<pre>".print_r($employees, 1)."</pre>"; 
//echo "<pre>".print_r($first_50_emps, 1)."</pre>"; 
//exit();

$smarty->assign('cur_week', $week_no);
$smarty->assign('cur_year', $year);
$smarty->assign('cur_month', $this_month);
$smarty->assign('year_week', $year_week);
$smarty->assign('weeks', $date_calc->get_five_weeks($year_week));
//echo $year_week;
//$customer->non_allocated_customers($year_week);
//$customer_to_allocate = $customer->non_allocated_customers($year_week);
$employee_to_allocate = $obj_employee->non_allocated_employees($year_week);
//echo "$year_week<pre>".print_r($employee_to_allocate, 1)."</pre>";exit();
if($employee_to_allocate){
    $smarty->assign('employees_to_allocate', $employee_to_allocate);
}
$week_shedules = $obj_employee->employee_weeks_shedule($first_50_emps, $year_week,1);
$tbl_data = '';
// echo "<pre>".print_r($week_shedules, 1)."</pre>";exit();
foreach ($week_shedules as $week_shedule){
                    $tbl_data .= '<tr class="cust_name1">';
                        $tbl_data .= '<td class="col-fixed-width-customersname cust_name">';
                          $tbl_data .= '<a onclick="navigatePage(\''.$smarty->url.'month/gdschema/employee/'.$year.'/'.$this_month.'/'.$week_shedule['employee']['username'].'/\',1);" href="javascript:void(0);" title="'.$smarty->translate['tltp_go_to_monthly_view'].'">';
                          if($_SESSION['company_sort_by'] == 1)
                              $tbl_data .= $week_shedule['employee']['first_name'].' '.$week_shedule['employee']['last_name'];
                          elseif($_SESSION['company_sort_by'] == 2)
                             $tbl_data .= $week_shedule['employee']['last_name'].' '.$week_shedule['employee']['first_name'];
                                
                            $tbl_data .= '</a>';
                        $tbl_data .= '</td>';
                        foreach ($week_shedule['week_datas'] as $week_data){
                            
                            $special_class = '';
                            if ($week_data['allocation'] >= $week_data['total_hours'] && $week_data['total_hours'] != 0)
                                $special_class = 'col-highlight-primary';
                            else if ($week_data['total_hours'] != 0)
                                $special_class = 'col-highlight-secondary';
                            else if ($week_data['week']['year_week'] == $year_week)
                                $special_class = 'highlight-week';
                            $tbl_data .= '<td class="table-col-center '.$special_class.'">';
                                
                            $tbl_data .= '<a onclick="navigatePage(\''.$smarty->url.'employee/gdschema/'.$week_data['week']['year_week'].'/'.$week_shedule['employee']['username'].'/\',1);" href="javascript:void(0);" title="'.$smarty->translate['tltp_goto_week'].'">';
                                if ($week_data['total_hours'] != 0)
                                    $tbl_data .= $week_data['allocation'].($week_data['allocation'] != $week_data['total_hours'] ? (' / '.$week_data['total_hours']) : '');
                                else
                                    $tbl_data .= '---';
                            $tbl_data .= '</a></td>';
                        }
                    $tbl_data .= '</tr>';
                    
}

$smarty->assign('tbl_data', $tbl_data);
$smarty->assign('week_shedules', $week_shedules);

$list_accessible_customers = $customer->customer_list();
$list_accessible_customers_modified = array();
if(!empty($list_accessible_customers)){
    foreach ($list_accessible_customers as $acustomer) {
        $list_accessible_customers_modified[] = array( 
            'uname' => $acustomer['username'],
            'label' => ($_SESSION['company_sort_by'] == 1 ? $acustomer['first_name'].' '.$acustomer['last_name'] : $acustomer['last_name'].' '.$acustomer['first_name']).'('.$acustomer['code'].')',
            'code'  => $acustomer['code'],
            'ssn'   => $acustomer['social_security'],
            'mobile'=> $acustomer['mobile'],
            'phone' => $acustomer['phone']
        );
    }
}
// echo "<pre>".print_r($list_accessible_customers_modified, 1)."</pre>"; exit();
//$smarty->assign('employees',$obj_employee->employee_list());
$smarty->assign('customers',  json_encode($list_accessible_customers_modified));

$list_accessible_employees_modified = array();
if(!empty($employees)){
    foreach ($employees as $aemployee) {
        $list_accessible_employees_modified[] = array( 
            'uname' => $aemployee['username'],
            'label' => ($_SESSION['company_sort_by'] == 1 ? $aemployee['first_name'].' '.$aemployee['last_name'] : $aemployee['last_name'].' '.$aemployee['first_name']).'('.$aemployee['code'].')',
            'code'  => $aemployee['code'],
            'ssn'   => $aemployee['social_security'],
            'mobile'=> $aemployee['mobile'],
            'phone' => $aemployee['phone']
        );
    }
}
// echo "<pre>".print_r($list_accessible_employees_modified, 1)."</pre>"; exit();
$smarty->assign('ac_employees',  json_encode($list_accessible_employees_modified));
////////////////////////////////////////////////Time Line/////////////////////////////////////////////////////
if($_SESSION['user_role'] == 3){
    $smarty->assign('user_slots', $obj_user->get_user_day_slots($_SESSION['user_id'], $date));
    //echo "<pre>".print_r($obj_user->get_user_day_slots($_SESSION['user_id'], $date), 1)."</pre>";
}
////////////////////////////////////////////////End Time Line/////////////////////////////////////////////////

///////////////////////////calender part starts//////////////////////////////////////////////////////
$months = $calender->get_months();
$smarty->assign('months', $months);
$smarty->assign('weeks_days', $calender->get_weeks());
$cur_year = date('Y');
$cur_month = date('m');
$cur_day = date('d');
$smarty->assign('cur_year', $cur_year);
$smarty->assign('cur_month', $cur_month);
$smarty->assign('cur_day', $cur_day);
//echo $_SERVER['QUERY_STRING'];
if ($date) {

//    $query_string = explode("&", $_SERVER['QUERY_STRING']);
//    if (count($query_string) == 1) {
        
        $date = explode('-', $date);
        $cur_year = $date[0];
        $cur_month = $date[1];
        $cur_day = $date[2];
}
$smarty->assign('year', $cur_year);
$smarty->assign('month', $cur_month);
$smarty->assign('day', $cur_day);
$prv_month = date("m", strtotime($cur_year . $cur_month . $cur_day . '-1 month'));
$prv_year = date("Y", strtotime($cur_year . $cur_month . $cur_day . '-1 month'));
$next_month = date("m", strtotime($cur_year . $cur_month . $cur_day . '+1 month'));
$next_year = date("Y", strtotime($cur_year . $cur_month . $cur_day . '+1 month'));
$smarty->assign('prv_month', $prv_month);
$smarty->assign('prv_year', $prv_year);
$smarty->assign('next_month', $next_month);
$smarty->assign('next_year', $next_year);
$month_label = $months[((int) $cur_month - 1)]['month'];
$smarty->assign('month_label', $month_label);
$smarty->assign('month_weeks', $calender->calender_month($cur_year, $cur_month, $cur_day));
$smarty->assign('user_role', $_SESSION['user_role']);
/////////////////////////////////////////////////////////////////////////////////
//Setting layout and page
if($query_string[0] == 'l')
    $smarty->display('extends:layouts/dashboard.tpl|gdschema_start_employee.tpl');
else
    $smarty->display('gdschema_start_employee.tpl');
?>