<?php
//error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);
//ini_set("display_errors", 1);

require_once('class/setup.php');
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/general.php');
require_once('class/employee.php');
require_once('class/dona.php');
$daylight_saving_date = '2018-10-28';
$company_obj = new company();
$obj_general = new general();
$companies = $company_obj->company_list();
$encoded_month = $company_obj->getMonthDetails(date('m'));

//echo "<pre>\n".print_r($companies, 1)."</pre>";
foreach($companies as $single_company){
    $obj_general->utf8_string_array_encode($single_company);
    if($single_company['status'] == 0 || $single_company['day_light_saving'] == 0)
        continue;
    
    //echo "<pre>".print_r($single_company, 1)."</pre>";    
    
    $customer = new customer();
    $new_company = new company();
    $obj_emp = new employee();
    $obj_dona = new dona();
    
    $customer->select_db($single_company['db_name']);
    $new_company->select_db($single_company['db_name']);
    $obj_emp->select_db($single_company['db_name']);
    $obj_dona->select_db($single_company['db_name']);

    $datas = $new_company->get_timeslots_for_daylight($daylight_saving_date);

    //echo "<pre>".print_r($datas, 1)."</pre>";

    //echo "------------------------------------------------------<br>";
    //exit();
    $obj_emp->begin_transaction();
    $obj_dona->begin_transaction();
    $error = 0;
    $i_count = 0;
    foreach($datas as $data){
        $i_count ++;
        if((float)$data['time_from'] < 2 && (float)$data['time_to']>3){
            //adjust first and add second
            //echo $data['time_from']."--".$data['time_to']."<br>";
            
            if($obj_emp->customer_employee_slot_edit($data['slot_id'],$data['time_from'],2.00)){
                
                if(!$obj_dona->customer_employee_slot_add($data['employee'], $data['customer'], $daylight_saving_date , 3.00, $data['time_to'], $data['alloc_emp'], $data['fkkn'], $data['type'],$data['relation_id'], null, $data['status'])){
                    $error = 1;
                    break;
                }
            }else{
                $error = 1;
                break;
            }    

        }elseif((float)$data['time_from'] >= 2 && (float)$data['time_to'] <= 3){
            //echo $data['time_from']."--".$data['time_to']."<br>";
            //remove slot
            if (!$obj_dona->customer_employee_slot_remove($data['slot_id'])){
                $error = 1;
                break;
            }
            

        }elseif((float)$data['time_from'] >= 2){
            //echo $data['time_from']."--".$data['time_to']."<br>";
            if(!$obj_emp->customer_employee_slot_edit($data['slot_id'], 3.00, $data['time_to'])){
                $error = 1;
                break;
            }
        }elseif((float)$data['time_to'] > 2){
            //echo $data['time_from']."--".$data['time_to']."<br>";
            //adjust time_from
            if(!$obj_emp->customer_employee_slot_edit($data['slot_id'], $data['time_from'], 2.00)){
                $error = 1;
                break;
            }
        }
        
    }
    //exit();
    if($error){
        echo "Something Went Wrong";
        $obj_dona->rollback_transaction();
        $obj_emp->rollback_transaction();
        
    }else{
        echo "Prcessed Successfully<br>";
        echo $single_company['name']."=".$i_count."<br>";
        echo "----------------------------------------------------------<br>";
        $obj_dona->commit_transaction();
        $obj_emp->commit_transaction();
        
    }
    
    
}



?>