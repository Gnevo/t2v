<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$obj_employee = new employee();
$obj_customer = new customer();

$return_obj = array( );
$action = trim($_REQUEST['action']);

if($action == 'get_customers'){
    $related_employee   = trim($_REQUEST['related_employee']);
    $request_from       = trim($_REQUEST['view']);
    $year_week          = trim($_REQUEST['year_week']);
    
    if($related_employee == '')
        $team_customers = $obj_customer->customer_list();
    else
        $team_customers = $obj_employee->customers_list_for_right_click($related_employee);
    
    $week_shedules = $obj_customer->customer_weeks_shedule($team_customers, $year_week,1);
    $tbl_data = '';
//    echo "<pre>".print_r($week_shedules, 1)."</pre>";
    if (!empty($week_shedules)) {
        foreach ($week_shedules as $week_shedule) {
            $summery_values = array();
            if (!empty($week_shedule['week_datas'])) {
                foreach ($week_shedule['week_datas'] as $week_data) {

                    $special_class = '';
                    if ($week_data['allocation'] >= $week_data['total_hours'] && $week_data['total_hours'] != 0)
                        $special_class = 'col-highlight-primary';
                    else if ($week_data['total_hours'] != 0)
                        $special_class = 'col-highlight-secondary';
                    else if ($week_data['week']['year_week'] == $year_week)
                        $special_class = 'highlight-week';

                    $summery_values[] = array(
                        'highlight_class'   => $special_class,
                        'year_week'         => $week_data['week']['year_week'],
                        'allocation'        => $week_data['allocation'],
                        'total_hours'       => $week_data['total_hours'],
                    );
                }
            }
            $return_obj[] = array(
                'username'  => $week_shedule['customer']['username'], 
                'full_name' => ($_SESSION['company_sort_by'] == 1 ? $week_shedule['customer']['first_name'] . ' ' . $week_shedule['customer']['last_name'] : $week_shedule['customer']['last_name'] . ' ' . $week_shedule['customer']['first_name']),
                'code'      => $week_shedule['customer']['code'],
                'ssn'       => $week_shedule['customer']['social_security'],
                'summery_values' => $summery_values,
            );
        }
    }
}
else if($action == 'get_employees'){
    $related_customer   = trim($_REQUEST['related_customer']);
    $employee_search_query= trim($_REQUEST['employee_search_query']);
    $request_from       = trim($_REQUEST['view']);
    $year_week          = trim($_REQUEST['year_week']);
//    echo "<pre>".print_r($_REQUEST, 1)."</pre>";
    
    if(isset($_REQUEST['related_customer'])){
        if($related_customer == ''){
            $team_employees = $obj_employee->employee_list();
            $team_employees = array_slice($team_employees, 0, 50);
        }else
            $team_employees = $obj_employee->employees_list_for_right_click($related_customer);
    }
    else if(isset($_REQUEST['employee_search_query'])){
        if($employee_search_query == ''){
            $team_employees = $obj_employee->employee_list();
            $team_employees = array_slice($team_employees, 0, 50);
        }else
            $team_employees = $obj_employee->employee_list($employee_search_query, NULL, '', TRUE);
    }
    else
        $team_employees = array();
    
    
    $week_shedules = $obj_employee->employee_weeks_shedule($team_employees, $year_week,1);
    $tbl_data = '';
//    echo "<pre>".print_r($week_shedules, 1)."</pre>";
    if (!empty($week_shedules)) {
        foreach ($week_shedules as $week_shedule) {
            $summery_values = array();
            if (!empty($week_shedule['week_datas'])) {
                foreach ($week_shedule['week_datas'] as $week_data) {

                    $special_class = '';
                    if ($week_data['allocation'] >= $week_data['total_hours'] && $week_data['total_hours'] != 0)
                        $special_class = 'col-highlight-primary';
                    else if ($week_data['total_hours'] != 0)
                        $special_class = 'col-highlight-secondary';
                    else if ($week_data['week']['year_week'] == $year_week)
                        $special_class = 'highlight-week';

                    $summery_values[] = array(
                        'highlight_class'   => $special_class,
                        'year_week'         => $week_data['week']['year_week'],
                        'allocation'        => $week_data['allocation'],
                        'total_hours'       => $week_data['total_hours'],
                    );
                }
            }
            $return_obj[] = array(
                'username'  => $week_shedule['employee']['username'], 
                'full_name' => ($_SESSION['company_sort_by'] == 1 ? $week_shedule['employee']['first_name'] . ' ' . $week_shedule['employee']['last_name'] : $week_shedule['employee']['last_name'] . ' ' . $week_shedule['employee']['first_name']),
                'code'      => $week_shedule['employee']['code'],
                'ssn'       => $week_shedule['employee']['social_security'],
                'summery_values' => $summery_values,
            );
        }
    }
}

//echo "<pre>".print_r($return_obj, 1)."</pre>";
echo json_encode($return_obj);
?>