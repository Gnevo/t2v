<?php

require_once('class/employee_ext.php');
require_once('class/user.php');

$obj_emp = new employee_ext();
$user    = new user();

$smarty = new smartySetup(array("reports.xml", "user.xml", "messages.xml", "button.xml", "month.xml", "tooltip.xml", 'company.xml','mail.xml'));


$all_employee_checklist = $obj_emp->get_all_employee_checklist();
$smarty->assign('all_employee_checklist',$all_employee_checklist);
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->assign('privileges_general', $user->get_privileges($_SESSION['user_id'], 2));

if($_REQUEST['action'] == 'add_new_checklist'){
    $responce = new stdClass();
    $checklist_description = $_REQUEST['checklistDescription'];
    $alloc_employee        = $_SESSION['user_id'];
    $max_sortorder         = $obj_emp->get_max_value_of_checklist_sortorder();
    $max_sortorder == null ? $max_sortorder = 1 : $max_sortorder++ ;
    $insert_checklist_id = $obj_emp->save_new_checklist($checklist_description,$max_sortorder,$alloc_employee);
    if($insert_checklist_id !== FALSE){
        $responce->status      = true;
        $responce->cheklist_id = $insert_checklist_id;
        $responce->description = htmlspecialchars($checklist_description);
        $responce->sort_order  = $max_sortorder;

    }
    else{
        $responce->status = false;
    }
    echo json_encode($responce);
    exit();
}
elseif($_REQUEST['action'] == 'edit_checklist'){
    $responce       = new stdClass();
    $id             = $_REQUEST['id'];
    $description    = $_REQUEST['description']; 
    $edit_checklist = $obj_emp->edit_single_checklist($id,$description);
    if($edit_checklist){
        $responce->status      = true;
        $responce->cheklist_id = $id;
        $responce->description = htmlspecialchars($description);
    }
    else{
         $responce->status = false;
    }
    echo json_encode($responce);
    exit();
}
elseif($_REQUEST['action'] == 'delete_check_list'){
    $id = $_REQUEST['id'];
    $delete_check_list = $obj_emp->delete_single_checklist($id);
    echo json_encode($delete_check_list);
    exit();
}

elseif($_REQUEST['action'] == 'changing_sort_order'){
    $new_sort_order = array();
    $before_sort_order = $obj_emp->get_all_employee_checklist('sort_order');
    // $before_sort_order = $_REQUEST['before_sort_order'];
    $after_sort_id     = $_REQUEST['after_sort_id'];
    foreach ($after_sort_id as $key => $id) {
       $new_sort_order[$id] = $before_sort_order[$key];
    }
    $update  = $obj_emp->change_the_sort_order($new_sort_order);
     if($update){
        echo json_encode($new_sort_order);
    }
    exit();
}
$smarty->display('layouts/employee_checklist.tpl');
?>