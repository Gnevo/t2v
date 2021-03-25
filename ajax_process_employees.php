<?php
require_once ('class/employee.php');
require_once('class/setup.php');
$smarty = new smartySetup(array('button.xml'), FALSE);
$obj_emp = new employee();

if(!isset($_REQUEST['type']) || $_REQUEST['type'] == '' || $_REQUEST['type'] == 'del_list' || $_REQUEST['type'] == 'rep_list'){
    $start_date = date('Y-m-d', strtotime(substr($_REQUEST['cur_week'],0,4)."W".str_pad($_REQUEST['from_week'],2,'0',STR_PAD_LEFT).'1'));
    $start_date_minus = date('Y-m-d',strtotime($start_date .' -1 day'));
    $end_date = date('Y-m-d', strtotime($start_date_minus.' +'.str_pad($_REQUEST['no_of_weeks'],2,'0',STR_PAD_LEFT).' week'));
    //echo "<script>alert(\"".$start_date." : ".$end_date."\")</script>";
    if($emp_list = $obj_emp->employee_list_for_process($start_date, $end_date, $_REQUEST['user'])){
       // print_r($emp_list);
        $smarty->assign('employee_details',$emp_list);
        
        if($_REQUEST['type'] == 'rep_list')
                $smarty->assign('type','rep');
        else if($_REQUEST['type'] == 'del_list')
            $smarty->assign('type','del');
    }
}elseif($_REQUEST['type'] == 'rep'){
    $smarty->assign('type','rep');
    $emp_list = $obj_emp->employee_list_for_process($_REQUEST['start_date'], $_REQUEST['end_date'], $_REQUEST['user']);
    if($emp_list){
        $smarty->assign('employee_details',$emp_list);
    }
}
else if($_REQUEST['type'] == 'atl_list'){
    $start_date = $_REQUEST['year_month']."-01";
    $end_date = date('Y-m-t', strtotime($start_date));
    if($emp_list = $obj_emp->employee_list_for_process($start_date, $end_date, $_REQUEST['user'])){
    
        $smarty->assign('employee_details',$emp_list);
        $smarty->assign('type','atl');
       
    }
}
$smarty->display('ajax_process_employees.tpl')
?>