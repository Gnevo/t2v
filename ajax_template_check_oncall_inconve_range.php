<?php

    require_once('class/setup.php');
    require_once ('class/customer.php');
    require_once ('class/employee.php');
    require_once ('class/employee.php');
    require_once ('class/template.php')

    $smarty   = new smartySetup(array("gdschema.xml", "month.xml", "button.xml", 'messages.xml'), FALSE);
    $customer = new customer();
    $employee = new employee();
    $obj_tmp  = new template();

    $id_slots   = explode("-", $_REQUEST['ids']);
    $slot_count = count($id_slots);
    $time_flag = 0;
    for ($i = 0; $i < $slot_count; $i++) {
        $slot_det = $obj_tmp->customer_employee_slot_details($id_slots[$i]);
        $inconv_timing = $employee->get_inconvenient_on_a_day_for_customer($slot_det['date'], $slot_det['customer'], 3);
        $incon_count = count($inconv_timing);
        $time = explode("-", $slot_det['slot']);
        $time_from = $time[0];
        $time_to = $time[1];
        for ($j = 0; $j < $incon_count; $j++) {
            if ((floatval($time_from) >= floatval($inconv_timing[$j]['time_from']) && floatval($time_from) < floatval($inconv_timing[$j]['time_to'])) && (floatval($time_to) > floatval($inconv_timing[$j]['time_from']) && floatval($time_to) <= floatval($inconv_timing[$j]['time_to']))) {
    //            $time_flag = 1;
                break;
            }
        }
        if ($incon_count == $j) {
            $time_flag = 1;
            break;
        }
    }
    if($time_flag == 0){
        echo 'success';
    }else{
        echo 'fail';
    }
?>