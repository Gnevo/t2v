<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
require_once('class/inconvenient_timing.php');
require_once ('class/employee.php');
require_once ('class/timetable.php');
require_once ('class/work.php');
$smarty = new smartySetup(array("user.xml","messages.xml","button.xml","month.xml","reports.xml"),FALSE);
$employee = new employee();
$works = new work();
//echo $day = date('D',strtotime('2012-09-21'));
 global $month;
    $month_num=array();
    $month_name=array();

    foreach ($month as $m_id)
    {
        $month_num[]=$m_id['id'];
        $month_name[]=$smarty->translate[$m_id['month']];
    }

    $smarty->assign("month_option_values", $month_num);
    $smarty->assign("month_option_output", $month_name);

$employee_data = $employee->employee_list();
$works_in = $works->work_list();
$years_work = $employee->distinct_years();
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);
$smarty->assign('employees', $employee_data);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
if (isset($_POST['report'])) {   
//    $month = $_POST['month'];
//    $year = $_POST['year'];
//    $emp = $_POST['employee'];
//    $smarty->assign('month',$month);
//    $smarty->assign('emp',$emp);
//    $smarty->assign('report_year',$year);
//    $inconvinient_details = $employee->get_inconvinient_details($month,$year);
//    $inconvinient_details_holiday = $employee->get_inconvinient_details_holiday($month,$year);
//    $inconvenient_block = $employee->get_inconvenient_block(); 
//    $inconvinient_timings =  $employee->employee_inconvenient_time_month($emp,$year,$month,$inconvinient_details,$works_in,$inconvinient_details_holiday,$inconvenient_block,1);
//    $smarty->assign('reports',$inconvinient_timings);
   /* $normal_timings =  $employee->employee_inconvenient_time_month($emp,$year,$month,$inconvinient_details,$works_in,$inconvinient_details_holiday,$inconvenient_block,1);
   $holiday_timings =  $employee->employee_inconvenient_time_month($emp,$year,$month,$inconvinient_details,$works_in,$inconvinient_details_holiday,$inconvenient_block,3);   
    //print_r($holiday_timings);
      $works_ids = $employee->get_employee_works($month,$year,$emp);
    $counts = count($works_ids);
    $normal_totals = $employee->get_total_normal($normal_timings);
    
    $holiday_total = $employee->get_holiday_total($holiday_timings,$works_ids);
  //  echo "<br><br> THIS <br>";
   // print_r($holiday_timings);
    $inconvinient_timings_total = $employee->get_total_inconvinient($inconvinient_timings,$counts);
    $smarty->assign('normal_total',$normal_totals);
    $smarty->assign('normals',$normal_timings);
    $smarty->assign('inconvenients',$inconvinient_timings_total );
    $smarty->assign('holidays',$holiday_total);*/
}
//$smarty->display('extends:layouts/dashboard.tpl|inconveninent_timing_report_detail.tpl');
?>