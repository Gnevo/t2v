<?php
require_once('class/setup.php');
require_once('class/template.php');


$obj_tmp  = new template();

if($_POST['action'] == 'check_overlap'){
    $ids = $_POST['ids'];
    $employee_username = $_POST['employee_username'];
    echo $return_value = $obj_tmp->check_overlap_slots($ids,$employee_username);
}
?>