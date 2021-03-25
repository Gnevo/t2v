<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/team.php');
$employee = new employee();
$team = new team();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml","tooltip.xml"), FALSE);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
if(urldecode($_REQUEST['select_all']) == 'all' || $_SESSION['select_all_prev'] == 1){
    $smarty->assign('pre_role',$_REQUEST['role_all']);
    $smarty->assign('select_all','All Employees');
}else{
    if(urldecode($_GET['cust']) != "" && urldecode($_GET['empl']) == ""){
        $employees_selected = $team->get_team_employees(urldecode($_GET['role']), urldecode($_GET['cust']));
        $selected = '';
        for($i=0;$i<count($employees_selected);$i++){
            if($selected == ""){
                $selected = $employees_selected[$i]['username'];
            }else{
                $selected = $selected.",".$employees_selected[$i]['username'];
            }
        }
        $smarty->assign('cust','cust');
        $smarty->assign('selected',$selected);
    }
    else if(urldecode($_GET['cust']) != "" && urldecode($_GET['empl']) !=""){
        $employees = explode(',', urldecode($_GET['empl']));
        $employees_selected = $employee->get_employee_detail_privilege($employees);
        for($i=0;$i<count($employees_selected);$i++){
            if($selected == ""){
                $selected = $employees_selected[$i]['username'];
            }else{
                $selected = $selected.",".$employees_selected[$i]['username'];
            }
        }
        $smarty->assign('cust','cust');
        $smarty->assign('selected',$selected);
    }else{
        $employees = explode(',', urldecode($_GET['empl']));
        $employees_selected = $employee->get_employee_detail_privilege($employees);
    }
}

$smarty->assign('employees',$employees_selected);
$smarty->display("ajax_selected_employee_privilege.tpl");
?>