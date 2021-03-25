<?php

require_once('configs/config.inc.php');
require_once('class/setup.php');
//$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
require_once ('class/user.php');
require_once ('class/db.php');
require_once('class/customer.php');
require_once('class/customer_ai.php');
require_once('class/employee.php');

class customer_pdf extends db {

    function getCustomerDetails($username) {
        require_once ('plugins/customize_pdf_customer_info.class.php');
        $pdf = new PDF_Customer_info();
        $customer = new customer();
        $employee = new employee();
        $customer_ai = new customer_ai();
        $obj_company = new company();
        
        $customer_detail = $customer->customer_detail($username);
        $customer_relatives = $customer->customer_relatives($username);
        $customer_health = $customer->customer_health($username);
        $customer_guardian = $customer->customer_guardian($username);

        $contract_details = $customer->contract_customer($username);
        $result = array();
        for ($i = 0; $i < count($contract_details); $i++) {
            $result[$i]['date_from'] = $contract_details[$i]['date_from'];
            $result[$i]['date_to'] = $contract_details[$i]['date_to'];
            $result[$i]['hour'] = $contract_details[$i]['hour'];
            $result[$i]['fkkn'] = $contract_details[$i]['fkkn'];
            $oncall = $customer->oncall_customer($customer_username, $contract_details[$i]['date_from'], $contract_details[$i]['date_to']);
            $result[$i]['oncall'] = $oncall;
            if ($contract_details[$i]['fkkn'] == 1) {
                $result[$i]['fkkn'] = "fk";
            } else
                $result[$i]['fkkn'] = "kn";
            $hrs = $contract_details[$i]['hour'];
            $current_date = date('Y-m-d');

            $diff = $employee->date_difference($contract_details[$i]['date_from'], $contract_details[$i]['date_to']);
            $tot_month = floor($diff / (30 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (30 * 24 * 60 * 60));
            $tot_week = floor($diff / (7 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (7 * 24 * 60 * 60));
            $tot_day = floor($diff / (24 * 60 * 60)) == 0 ? 1 : floor($diff / (24 * 60 * 60));
            $current_date = date('Y-m-d');
            if (strtotime($current_date) < strtotime($contract_details[$i]['date_from'])) {

                $result[$i]['remaining_hour'] = $contract_details[$i]['hour'];
            } else if (strtotime($current_date) > strtotime($contract_details[$i]['date_to'])) {
                $result[$i]['remaining_hour'] = "0";
            } else {
                $total_hours = $customer->get_timetable_customer($customer_username, $contract_details[$i]['date_from'], $contract_details[$i]['date_to'], $current_date, $contract_details[$i]['fkkn']);
                $remaining_hours = $total_hours;
                $result[$i]['remaining_hour'] = $remaining_hours;
            }
        }

        $allocated_employees_array = $customer_ai->customer_team_members($username);
        $team_leader = $customer_ai->customer_team_leader($username);
        $super_team_leader = $customer_ai->customer_super_team_leader($username);
        $tl = $stl = '';
        for($i=0;$i<count($team_leader);$i++){
             if($tl == ''){
                 $tl = $team_leader[$i]['employee'];
             }else{
                 $tl = $tl.",".$team_leader[$i]['employee'];
             }
        }
        for($i=0;$i<count($super_team_leader);$i++){
             if($stl == ''){
                 $stl = $super_team_leader[$i]['employee'];
             }else{
                 $stl = $stl.",".$super_team_leader[$i]['employee'];
             }
        }
       // $stl = $super_team_leader['employee'];
        $customer_team =  $customer_ai->customer_alocate_employee($allocated_employees_array, $tl,$stl);
       // echo "<pre>".print_r($customer_team, 1)."</pre>";

        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        
        $pdf->AddPage();
        $pdf->report_header($company_details);
        $pdf->customer_personal_info($customer_detail);
        $pdf->customer_relatives_info($customer_relatives);
        $pdf->customer_additional_info($customer_health);
        $pdf->customer_guardian_info($customer_guardian);
        $pdf->team_information($customer_team);
        // $pdf->contract_info($customer_detail);
        $pdf->customer_order_info($result);

        $pdf->Output();
    }

    function getCustomerInsuranceDetails($username, $fkkn, $date) {

        require_once ('plugins/customize_pdf_customer_insurance.class.php');
        $pdf = new PDF_Customer_insurance();
        $customer = new customer();
        $obj_company = new company();
        $employee = new employee();
        $equipment = new equipment();

        $contract_id = $date;
        $ful_details_contract = $customer->get_ful_contract_detail($contract_id);
        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        $customer_detail = $customer->customer_detail($username);

        $hrs = $ful_details_contract[0]['hour'];
        $diff = $employee->date_difference($ful_details_contract[0]['date_from'], $ful_details_contract[0]['date_to']);
        $tot_day = abs(floor($diff / (24 * 60 * 60))) + 1;    //adding 1 for including count both boudary dates
        $current_date = date('Y-m-d');
        if (strtotime($current_date) < strtotime($ful_details_contract[0]['date_from'])) {
            $remaining_hours = $ful_details_contract[0]['hour'];
        } else if (strtotime($current_date) > strtotime($ful_details_contract[0]['date_to'])) {
            $remaining_hours = "0";
        } else {
            $fkkn_org = $fkkn == 'fk'?1:($fkkn == 'kn'? 2 : 3);
            $total_hours = $customer->get_timetable_customer($username, $ful_details_contract[0]['date_from'], $ful_details_contract[0]['date_to'], $current_date, $fkkn_org,1);
            $remaining_hours = $customer->time_difference($hrs, $equipment->time_user_format($total_hours,60),100,'exact');
        }
        //$hrs = $equipment->time_user_format($hrs, 100);
        $remaining_hours = $equipment->time_user_format($remaining_hours, 100);
        $pdf->no_of_days = $tot_day;
        $pdf->monthly_hrs = round(($hrs / $tot_day) * 30, 2);
        $pdf->weekly_hrs = round(($hrs / $tot_day) * 7, 2);
        $pdf->remaining_hrs = round($remaining_hours, 2);
        $pdf->hrs = $equipment->time_user_format($ful_details_contract[0]['hour'], 100);

        $pdf->AddPage();
        $pdf->report_header($company_details, $fkkn);
        $pdf->customer_personal_info($customer_detail);
        $pdf->customer_admin_decision($ful_details_contract, $fkkn);
        $fname = 'Customer_'.$fkkn.'_'.$username."_".date('Y-m-d');
        $pdf->Output($fname,"I");
    }

    function getCustomerImplan($username, $date, $dt) {

        require_once ('plugins/customize_pdf_customer_implan.class.php');
        $pdf = new PDF_Customer_insurance();
        $customer = new customer();
        $obj_company = new company();
//        $employee = new employee();
//        $travel_type = $smarty->travel_type;

        $implan_id = $date;
        $customer_ai = new customer_ai();
        $implementation = $customer_ai->customer_implementation_details($implan_id);
        $field_names = $customer_ai->get_implan_field_names();
        $new_implan_details = $customer_ai->new_implan_description_show($implan_id);
        // echo "<pre>".print_r($implementation, 1)."</pre>";
        // var_dump($new_implan_details);
        // exit('fgfd');

        $created_by_name = NULL;
//        if($implementation['created_by'] != ''){
//            $created_emp_details = $employee->get_employee_detail($implementation['created_by']);
//            if(!empty($created_emp_details))
//                $created_by_name = $_SESSION['company_sort_by'] == 1 ? $created_emp_details['first_name'].' '.$created_emp_details['last_name'] : $created_emp_details['last_name'].' '.$created_emp_details['first_name'];
//        }
        
        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        
        $customer_detail = $customer->customer_detail($username);
        $pdf->AddPage();
        $pdf->report_header($company_details);
        $pdf->customer_personal_info($customer_detail);
        $pdf->customer_implan($implementation, $dt, $created_by_name, $field_names,$new_implan_details);
        $pdf->Output();
    }

    function getCustomerDesWork($username, $date, $dt) {
        require_once ('plugins/customize_pdf_customer_deswork.class.php');
        $pdf = new PDF_Customer_insurance();
        $customer = new customer();
//        $employee = new employee();
        $obj_company = new company();
        $customer_ai = new customer_ai();
        $customer    = new customer();

        $customer_detail = $customer->customer_detail($username);
        $works = $customer->get_customer_works_date($date);
        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        $field_names = $customer_ai->get_deswork_field_names();
        $new_work_details = $customer->new_deswork_description_show($date);
        $created_by_name = NULL;


//        if($works[0]['created_by'] != ''){
//            $created_emp_details = $employee->get_employee_detail($works[0]['created_by']);
//            if(!empty($created_emp_details))
//                $created_by_name = $_SESSION['company_sort_by'] == 1 ? $created_emp_details['first_name'].' '.$created_emp_details['last_name'] : $created_emp_details['last_name'].' '.$created_emp_details['first_name'];
//        }
        
        $pdf->AddPage();
        $pdf->report_header($company_details);
        $pdf->customer_personal_info($customer_detail);
        $pdf->customer_des_work($works, $dt, $created_by_name, $field_names,$new_work_details);
        $pdf->Output();
    }

    function getCustomerEquipment($username, $year, $month, $month_txt) {
        require_once ('plugins/customize_pdf_customer_equipment.class.php');
        $pdf = new PDF_Customer_insurance();
        $customer = new customer();
        $obj_company = new company();
        
        $customer_detail = $customer->customer_detail($username);
        $equipment_issues = $customer->get_all_issue_data($username, $year, $month);
        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
//        var_dump($equipment_issues);
        
        $pdf->AddPage();
        $pdf->report_header($company_details);
        $pdf->customer_personal_info($customer_detail);
        $pdf->customer_equipment($equipment_issues, $year, $month_txt);

        $pdf->Output();
    }

    function getCustomerDocumentation($username, $date, $date_id) {
        require_once ('plugins/customize_pdf_customer_documentation.class.php');
        $pdf = new PDF_Customer_insurance();
        $customer = new customer();
        $employee = new employee();
        $obj_company = new company();
        
        $employees = $employee->employee_list();
        $customer_detail = $customer->customer_detail($username);
        $data = $customer->get_documentation_date($date_id);
        $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
        
        $created_by_name = NULL;
//        if($data[0]['created_by'] != ''){
//            $created_emp_details = $employee->get_employee_detail($data[0]['created_by']);
//            if(!empty($created_emp_details))
//                $created_by_name = $_SESSION['company_sort_by'] == 1 ? $created_emp_details['first_name'].' '.$created_emp_details['last_name'] : $created_emp_details['last_name'].' '.$created_emp_details['first_name'];
//        }
        $pdf->AddPage();
        $pdf->report_header($company_details);
        $pdf->customer_personal_info($customer_detail);
        $pdf->customer_documentation($data, $date, $employees, $created_by_name);

        $pdf->Output();
    }
    
    function getCustomer3066($username, $customer_detail, $emps_details_loaded, $company_detail) {
        require_once ('plugins/customize_pdf_customer_3066.class.php');
        $pdf = new PDF_Customer_3066();
        $pagecount = $pdf->setSourceFile('./pdf_forms/fk3066_002_f_001.pdf');
        
//        echo "<pre>".print_r($emps_details_loaded, 1)."</pre>";
//        echo "<pre>".print_r($customer_detail, 1)."</pre>";

        if(!empty($emps_details_loaded)){
            foreach ($emps_details_loaded as $emp_data) {
                $pdf->AddPage();
                $tppl = $pdf->importPage(1);
                $pdf->useTemplate($tppl, -2, 0, 210);
                
                $pdf->report_section_1($customer_detail);
                $pdf->report_section_2($emp_data);
                
                $pdf->AddPage();
                $tppl = $pdf->importPage(2); 
                $pdf->useTemplate($tppl, -2, 0, 210);
                
                $pdf->report_section_3($emp_data, $company_detail);
                if(!empty($emp_data['saved_data']) && $emp_data['saved_data']['signing_employee'] != '')
                    $pdf->report_section_4($emp_data);
            }
        }
        else
            $pdf->AddPage();
        
        $pdf->Output();
    }
}
?>