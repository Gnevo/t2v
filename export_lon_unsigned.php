<?php
ini_set('display_errors', true);
ini_set('xdebug.var_display_max_depth', 10);
error_reporting(E_ALL ^ E_NOTICE);

require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/converter.php');
require_once('class/user.php');
require_once('class/dona.php');
require_once('plugins/message.class.php');
require_once('class/sms.php');
require_once('class/export.php');
require_once('class/inconvenient_timing.php');
require_once ('class/mail.php');
require_once ('class/company.php');
require_once('class/inconvenient.php');



$inc_timing = new inconvenient_timing();
$obj_inconv = new inconvenient();
//$list = $inc_timing->inconvenient_timing_list();
$list = $inc_timing->inconvenient_timing_list_copy();
$holi_list = $inc_timing->holiday_timing_list();
$messages = new message();
$obj_sms = new sms('hai');
$export = new export();
$obj_emp = new employee();
$obj_company  = new company();

$company_details = $obj_company->get_company_detail($_SESSION['company_id']);
// Autoload export classes.
spl_autoload_register('export_autoload');
$smarty = new smartySetup(array("month.xml", "messages.xml", "button.xml", "forms.xml", "export.xml", "export-config.xml", "reports.xml"));
$smarty->assign('message', '');
if($_SESSION['report_return_url'] != ''){
    
    $_SESSION['report_return_url'] = '';
    unset($_SESSION['report_return_url']);
}
$out = array();
//////////////////////////////////////////////////getting the internal entries//////////////////////

if (!empty($holi_list)) {

    for ($i = 0; $i < count($holi_list); $i++) {   // this loop is used to find year of upperlimit of 'days' field in the table
        if ((int) $holi_list[$i]['year_to']) {
            $holi_list[$i]['name'] .= ' - ' . $holi_list[$i]['year_to'];
            //unset($holi_list[$i]);
            //continue;
        }
    }
}
// internal ones - small process
foreach ($list as $key => $entry) {
    $out[] = $entry['group_id'];
    
    $out[] = $entry['group_id'] . '.1';
    
    $out[] = $entry['group_id'] . '.2';

    if($entry['type'] == 3){
        $out[] = $entry['group_id'] . '.3';
    }
    
    // update the key from array
    unset($list[$key]);
    $list['id_' . $entry['group_id']] = $entry;
    $group_id_temp = $entry['group_id'];
        $temp_name = $entry['name'];
        $entry['group_id'] = $group_id_temp . '.1';
        $entry['name'] = $temp_name . ' intro';
        $list['id_' . $entry['group_id']] = $entry;
        
        $entry['group_id'] = $group_id_temp . '.2';
        $entry['name'] = $temp_name . ' komp';
        $list['id_' . $entry['group_id']] = $entry;
    
        if($entry['type'] == 3){
         
            $entry['group_id'] = $group_id_temp . '.3';
            $entry['name'] = $temp_name . ' mertid';
            $list['id_' . $entry['group_id']] = $entry;
        }
}
asort($holi_list);
foreach ($holi_list as $entryTmp) {
    $out[] = '1000' . '.' . (1000 + $entryTmp['group_id']);
}
foreach ($holi_list as $key => $entry) {
    $out[] = 1000 + $entry['group_id'];


    // update the key from array
    unset($holi_list[$key]);
    $holi_list['id_' . (1000 + $entry['group_id'])] = $entry;
}

// karens
$out[] = 2000;
foreach ($smarty->leave_type as $key => $entry) {
    if($key == 10 || $key == 11){continue;}
    $out[] = 2000 + $key;

    // add the sick combinations
    if ($key == 1) {
        $out[] = '2001.0';

        foreach ($list as $entryTmp) {
            if(!preg_match('/komp/',$entryTmp['name']))
            $out[] = '2001' . '.' . $entryTmp['group_id'];
        }

        foreach ($holi_list as $entryTmp) {
            $out[] = '2001' . '.1000.' . (1000 + $entryTmp['group_id']);
        }

        foreach ($holi_list as $entryTmp) {
            $out[] = '2001' . '.' . (1000 + $entryTmp['group_id']);
        }
        $out[] = '2001' . '.2013';
    }elseif($key == 2){
        $out['2002.1'] = '2002.1';
    }elseif($key == 3){
        $out['2003.2013'] = '2003.2013';
    }elseif($key == 4){
        $out['2004.2010'] = '2004.2010';
    }
}

// take out the 2008 code
unset($out[2008]);

// status codes from "timetable"
$out[] = 3000;
$out[] = 3001;
$out[] = 3002;
//$out[] = 3003;
$out[] = 3004;
$out[] = 3005;
$out[] = 3006;
$out[] = 3007;
$out[] = 3008;
$out[] = 3009;
$out[] = 3010;
$out[] = 3011;
//$out[] = 3012;
//$out[] = 3013;
$out[] = 3014;
$out[] = 4000;

$out = array_unique($out);
$current_time_code_count = count($out);
$stored_external_time_code_count = $obj_emp->get_salary_code_count(1, $out);
$stored_monthly_time_code_count = $obj_emp->get_salary_code_count(2, $out);
$flag_monthly_salary = $obj_emp->check_monthly_salary();
///////////////////////////////////////////////////////////////////////////////////////////////////





function export_autoload($class) {
    include('./export_formats/' . $class . '.php');
}

function getUserRoles($users) {
    $user = new user();
    if (is_array($users)) {
        foreach ($users as $key => $value) {
            $users[$key] = $user->user_role($key);
        }
    }

    return $users;
}

function exportExists($month, $year, $app, $signedUsers) {
    global $sql;
    //echo "<pre>\n".print_r($signedUsers , 1)."</pre>";
    // sanitize
    $month = (int) $month;
    $year = (int) $year;
    $app = (string) $app;
    $app = str_replace(array("'", '"'), '', $app);

    if (!is_array($signedUsers)) {
        return array();
    }

    // get the existing exports
    //echo "SELECT employee_exported,customers FROM exports_lon WHERE year=? AND month=? AND app=?";
    //echo $year.$month.$app;
    $query = $sql->prepare("SELECT employee_exported,customers FROM exports_lon_unsigned WHERE year=? AND month=? AND app=?");
    $query->execute(array(
        $year,
        $month,
        $app
    ));
    
    if ($query->rowCount()) {
        while (($row = $query->fetch()) && count($signedUsers)) {
            //echo "<pre>\n".print_r($signedUsers[$row['employee_exported']] , 1)."</pre>";
            $exported_customers = explode(',', $row['customers']);
            //echo "<pre>\n".print_r($exported_customers , 1)."</pre>";
            if(is_array($signedUsers[$row['employee_exported']])){
                $temp_array = array_diff($signedUsers[$row['employee_exported']], $exported_customers);
                //echo "<pre>\n".print_r($temp_array , 1)."</pre>";
                if(!empty($temp_array)){
                    $signedUsers[$row['employee_exported']] = array_values($temp_array);
                }else{
                    unset($signedUsers[$row['employee_exported']]);
                }            }
        }
    }
    
    if (count($signedUsers)) {
        return $signedUsers;
    } else {
        return array();
    }
}

function pending_leaves($month, $year, $signedUsers, $customer) {
    global $sql;
    $messages = new message();
    // sanitize
    $month = (int) $month;
    $year = (int) $year;
   

    if (!is_array($signedUsers)) {
        return true;
    }
    
    $employee_export = "'";
    $employee_export .= implode("','", $signedUsers);
    $employee_export .= "'";

    // get the existing exports
    //echo "SELECT employee_exported,customers FROM exports_lon WHERE year=? AND month=? AND app=?";
    //echo $year.$month.$app;
    
    $query = $sql->prepare("SELECT distinct employee,date,time_from,time_to, (SELECT concat(last_name,' ',first_name)  FROM employee where username = leave.employee) as employee_name FROM `leave` WHERE year(date)=? AND month(date)=? AND employee in($employee_export) and status=0");
    $query->execute(array(
        $year,
        $month,
        
    ));
    
    if ($query->rowCount()) {
         $emp_names = array();
         $emp_i = 0;
         if($customer){
            while ($row = $query->fetch()){
                $query1 = $sql->prepare("SELECT id FROM timetable WHERE employee = ? AND customer = ? AND date=? AND status=2 AND 
                    ((time_from >=? and time_from < ?) OR (time_to > ? and time_to <= ?) OR (time_from < ? and time_to > ?))");
                $query1->execute(array(
                $row['employee'],
                $customer,
                $row['date'],
                (float)$row['time_from'],
                (float)$row['time_to'],
                (float)$row['time_from'],
                (float)$row['time_to'],
                (float)$row['time_from'],
                (float)$row['time_to'],    
                ));
                if ($query1->rowCount()){
                    $emp_names[] = $row['employee_name'];
                    $emp_i ++;
                }
            }
         }else{
             while ($row = $query->fetch()){
                $emp_names[] = $row['employee_name'];
                $emp_i ++;
            }
             
         }
        if($emp_i){

            $messages->set_message_exact('fail', implode(",", array_unique($emp_names))); 
            return false;
        }else{
            return true;
        }
    }else{
        return true;
    }

    
}

function filter_employee_list_by_employee_have_work($obj_emp_temp, $employee_list, $year, $month = NULL, $sel_customer = NULL, $allowed_employees = array(), $flag_show_previous_ = 'N'){
    /**
        * @author: Shamsudheen <shamsu@arioninfotech.com>
        * for: remove employees who have no work/leave slots
    */
    if (!empty($employee_list)){
        foreach ($employee_list as $key => $employees) {
            if($flag_show_previous_ != 'Y' && !in_array($employees['username'], $allowed_employees)){
                unset($employee_list[$key]);
                continue;
            }
            $work_flag = FALSE;
            if($month == NULL){
                for ($i = 1; $i <= 12; $i++) {
                    $employee_work_details = $obj_emp_temp->get_all_work_details_include_normal_nd_leave($employees['username'], $i, $year, $sel_customer);
                    $employee_list[$key]['have_work'][$i] = (!empty($employee_work_details) ? 1 : 0);
                    if (!empty($employee_work_details)){
                        $work_flag = TRUE;
//                        break;
                    }
                }
            } else {
                $employee_work_details = $obj_emp_temp->get_all_work_details_include_normal_nd_leave($employees['username'], $month, $year, $sel_customer);
                $employee_list[$key]['have_work'][$month] = (!empty($employee_work_details) ? 1 : 0);
                if (!empty($employee_work_details))
                    $work_flag = TRUE;
            }
            if (!$work_flag)
                unset($employee_list[$key]);
        }
        $employee_list = array_values($employee_list);      //for reindexing array
    }
    return $employee_list;
}

//echo "<pre>\n".print_r($_POST , 1)."</pre>";exit();

// year & month
if (isset($_POST['month']) && isset($_POST['year'])) {
    // sanitize
    $_POST['month'] = preg_replace('/[^0-9]/i', '', $_POST['month']);
    $_POST['year'] = preg_replace('/[^0-9]/i', '', $_POST['year']);
} else if ($_POST['sms_month'] != "" && $_POST['sms_year'] != "") {
    $_POST['month'] = $_POST['sms_month'];
    $_POST['year'] = $_POST['sms_year'];
} else {
    $_POST['month'] = date('m') - 1;
    $_POST['year'] = date('Y');
    if($_POST['month'] == 0){
        $_POST['month'] = 12;
        $_POST['year'] = $_POST['year'] - 1;
    }
}

global $db;
if ($_SESSION['db_name']) {
    $db['database'] = $_SESSION['db_name'];
}

$sql = new PDO($db['driver'] . ':host=' . $db['host'] . ';dbname=' . $db['database'], $db['username'], $db['password']);
$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$sql->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$equipment = new equipment();
$customer = new customer();
//$employee = new employee();
$dummy = new dummy($_POST['year'], $_POST['month']);
$obj_emp = new employee();

// errors
$err = array();
$salary_code = $customer->get_salary_code($_SESSION['company_id']);
// months
global $month;
$months = array();
foreach ($month as $m) {
    $months[] = $m['month'];
}

// customers list



$c_list = $customer->customer_list_for_export();


if (is_array($c_list)) {
    $customer_list = array();
    foreach ($c_list as $c_list_key => $c_list_item) {
        $customer_list[$c_list_item['username']] = $c_list_item['last_name'] . ' ' . $c_list_item['first_name'];
    }
    asort($customer_list);
}
$c_list_post = $c_list;
if ($_POST['customer']) {
    unset($c_list_post);
    $c_list_post[$_POST['customer']] = $customer->customer_detail($_POST['customer']);
}

if (isset($_POST['del_file'])) {
     $query = $sql->prepare("DELETE from exports_lon_unsigned WHERE filename= ?");
     $query->execute(array($_POST['del_file']));
}

//$userSigned = getUserRoles($dummy->getSigned());
$salary_code = $customer->get_salary_code($_SESSION['company_id']);
if($salary_code == 1)
    $salary_format = "visma600";
elseif($salary_code == 2)
    $salary_format = "visma";
elseif($salary_code == 3)
    $salary_format = "hogia";
elseif($salary_code == 4)
    $salary_format = "crona";
elseif($salary_code == 6)
    $salary_format = "bl";

if(isset($_POST['app'])){
    $salary_format = $_POST['app'];
}
$userSigned = $userNotSigned = $dummy->getNotSigned();

$employees_to_exp = exportExists($_POST['month'], $_POST['year'], $salary_format, $userSigned);
//echo "<pre>\n".print_r($employees_to_exp , 1)."</pre>";


$customers_to_export = array();
if(!empty($employees_to_exp)){
    foreach($employees_to_exp as $employee => $customers){
        if(is_array($customers)){
            foreach ($customers as $customer_data){
                if(!in_array($customer_data, $customers_to_export))
                     $customers_to_export[] =   $customer_data; 
            }
        }
    }
}

foreach ($customer_list as $cust_key => $cust_value) {
    if (!in_array($cust_key, $customers_to_export)) {
        unset($customer_list[$cust_key]);
    }
}
$temp_post = array();
if (!$_POST['customer']) {
    foreach ($c_list_post as $cust_key => $cust_value) {
        if (in_array($cust_value['username'], $customers_to_export)) {
            $temp_post[$cust_value['username']] = $cust_value;
        }
    }
    $c_list_post = $temp_post;
}


if(!pending_leaves($_POST['month'], $_POST['year'], array_keys($employees_to_exp), $_POST['customer'])){
            $messages->set_message('fail', 'untreated_leaves');
            $smarty->assign('message', $messages->show_message());
}
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$smarty->assign('month', $_POST['month']);
$smarty->assign('months', range(1, 12));
$smarty->assign('monthsn', $months);
$smarty->assign('year', $_POST['year']);
$smarty->assign('years', range(2012, date('Y')));
$smarty->assign('customer_list', array_keys($customer_list));
$smarty->assign('customer_list_n', $customer_list);
$smarty->assign('post_customer', $_POST['customer']);
$smarty->assign('post_year', $_POST['year']);
$smarty->assign('salary_code', $salary_code);
if($_SESSION['company_id'] == 14){
    $smarty->assign('export_data_flag', 0);
}else{
    $smarty->assign('export_data_flag', 1);
}
$smarty->assign('company_id', $_SESSION['company_id']);
if (isset($_POST['export']) || isset($_POST['verify'])) {
     
    $dtz = new DateTime; 
    $dtz->setTimestamp(time());
    $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
    $filenNameCommon = 'Un_'.$_POST['year'] . sprintf('%02d', $_POST['month']) . '_' . $_SESSION['user_id'] . '_' . $dtz->format('Ymd_His'); //date('Ymd_His');
        if(isset($_POST['export']) && isset($_POST['export_data']) && $_POST['export_data'] !=''){
            
            switch (strtolower(trim($_POST['app']))) {
                    case 'visma600':
                        $fileName = 'visma600_' . $filenNameCommon . '.tlu';
                        break;

                    case 'visma':
                        $fileName = 'visma_' . $filenNameCommon . '.tlu';
                        break;

                    case 'hogia':
                        $fileName = 'hogia_' . $filenNameCommon . '.wli';
                        break;

                    case 'crona':
                        $fileName = 'crona_' . $filenNameCommon . '.pax';
                        break;

                    case 'agda':
                        $fileName = 'agda_' . $filenNameCommon . '.xml';
                        break;
                    case 'bl':
                        $fileName = 'bl_' . $filenNameCommon . '.txt';
                        break;
                }
            foreach($aUsersSigned as $employee => $customers_data){
                $customer_data_implode = implode(",", $customers_data); 

                $query = $sql->query(
                            "INSERT IGNORE INTO exports_lon_unsigned (year,month,timestamp,employee,employeeName,filename,employee_exported,customers,app) VALUES (" .
                            (int) $_POST['year'] . "," .
                            (int) $_POST['month'] . "," .
                            strtotime($dtz->format('Y-m-d H:i:s')) . "," .
                            $sql->quote($_SESSION['user_id']) . "," .
                            $sql->quote($_SESSION['user_name']) . "," .
                            $sql->quote($fileName) . "," .
                            $sql->quote($employee) . "," .
                            $sql->quote($customer_data_implode) . "," .
                            $sql->quote(strtolower(trim($_POST['app']))) .
                            ")"
                    );
            }
            // save the file on the HDD
            $dona = new dona();
            $company_folder = $dona->get_company_directory($_SESSION['company_id']);
            file_put_contents(dirname(__FILE__) . '/' . $company_folder['upload_dir'] . '/salary/' . $fileName, html_entity_decode($_POST['export_data']));
        }
        else{            
            $userSigned = $userNotSigned = $dummy->getNotSigned();       

            // get the signed usernames
            $aUsersSigned = exportExists($_POST['month'], $_POST['year'], $_POST['app'], $userSigned);
            
            if(!empty($aUsersSigned)){
                foreach($aUsersSigned as $employee => $customers_data){
                    
                    foreach($customers_data as $k => $customer_data){
                       
                        if(!in_array($customer_data, array_keys($c_list_post))){
                            unset($aUsersSigned[$employee][$k]);
                        }
                        
                    }
                    if(empty($aUsersSigned[$employee])){
                        unset($aUsersSigned[$employee]);
                    }else{
                        
                        $aUsersSigned[$employee] = array_values($aUsersSigned[$employee]);
                    }
                        
                    
                }
                
                
            }
            
            // TODO: listing of the unsigned customers and the persons that did not signed
            if (count($aUsersSigned) == 0) {
                $messages->set_message('fail', 'none_without_signed');
                $smarty->assign('message', $messages->show_message());
            } elseif(!pending_leaves($_POST['month'], $_POST['year'], array_keys($aUsersSigned), $_POST['customer'])){
                $messages->set_message('fail', 'untreated_leaves');
                $smarty->assign('message', $messages->show_message());
            }else {
                date_default_timezone_set('UTC');

                // export if not already exported
                if ($aUsersSigned !== false) {
                    

                    $sUsersSigned = implode(',', $aUsersSigned);

                    $date[] = strtotime('01-' . $_POST['month'] . '-' . $_POST['year']);
                    $date[] = strtotime('+1 month -1 day', $date[0]);
                    $strt_dates = $_POST['year']."-".sprintf('%02s', $_POST['month'])."-01";
                    $end_dates = $_POST['year']."-".sprintf('%02s', $_POST['month'])."-".cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']); ;
                    //$timetable = $equipment->customer_timetable_month($_POST['customer'], (int) $_POST['month'], (int) $_POST['year'], $_SESSION['user_id'], $_SESSION['user_role']);
                    $timetable = $equipment->customer_timetable_month($_POST['customer'], $strt_dates, $end_dates, $_SESSION['user_id'], $_SESSION['user_role']);
                    
                    $conv = new Converter(array('fromDate' => $date[0], 'toDate' => $date[1]), $timetable, $_POST['year']);
                    $conv->employeeObj = new employee();
                    $conv->customerObj = new customer();
                    $conv->exportYear = $_POST['year'];
                    $conv->exportMonth = $_POST['month'];
                    //$timetable = $conv->customer_timetable_month($_POST['customer'], (int)$_POST['month'], (int)$_POST['year'], $_SESSION['user_id'], $_SESSION['user_role']);
                    //$postCustomer = !empty($_POST['customer']) ? $_POST['customer'] : 'all';
                    $postCustomer = $_SESSION['user_id'];
                    
                    //header('Content-Type: text/xml');
                    $error = '';
                   
                    switch (strtolower(trim($_POST['app']))) {
                        case 'visma600':
                            $fileName = 'visma600_' . $filenNameCommon . '.tlu';
                            $x = $conv->toVisma600(true, $date, $c_list_post, $aUsersSigned, $export, $error, $company_details['fkkn_split']);
                            break;

                        case 'visma':
                            $fileName = 'visma_' . $filenNameCommon . '.tlu';
                            $export = $conv->toVismaPay(true, $date, $_POST['customer']);
                            break;

                        case 'hogia':
                            $fileName = 'hogia_' . $filenNameCommon . '.wli';
                            $x = $conv->toHogia(true, $date, $c_list_post, $aUsersSigned, $export, $error);
                            break;

                        case 'crona':
                            $fileName = 'crona_' . $filenNameCommon . '.pax';
                            $x = $conv->toCrona(true, $date, $c_list_post, $aUsersSigned, $export, $error, $company_details['fkkn_split']);
                            //echo $error;
                            break;

                        case 'agda':
                            $fileName = 'agda_' . $filenNameCommon . '.xml';
                            $export = $conv->toAgda(true, $date, $c_list_post, $aUsersSigned);
                            break;
                        case 'bl':
                            $fileName = 'bl_' . $filenNameCommon . '.txt';
                            $x = $conv->toBl(true, $date, $c_list_post, $aUsersSigned, $export, $error);
                            break;
                    }
                    //echo "<pre>\n".print_r($c_list_post , 1)."</pre>"; 
                    //echo "<pre>";print_r($error);exit();
                    if($error){
                        $messages->set_message('fail', 'export_failed_with_following_reasons');
                        $smarty->assign('message', $messages->show_message());
                        $smarty->assign('export_error', $error);
                        $smarty->assign('export_data_flag', 0);
                    }else{
                        if(isset($_POST['export'])){
                        foreach($aUsersSigned as $employee => $customers_data){
                            $customer_data_implode = implode(",", $customers_data); 

                            $query = $sql->query(
                                        "INSERT IGNORE INTO exports_lon_unsigned (year,month,timestamp,employee,employeeName,filename,employee_exported,customers,app) VALUES (" .
                                        (int) $_POST['year'] . "," .
                                        (int) $_POST['month'] . "," .
                                        strtotime($dtz->format('Y-m-d H:i:s')) . "," .
                                        $sql->quote($_SESSION['user_id']) . "," .
                                        $sql->quote($_SESSION['user_name']) . "," .
                                        $sql->quote($fileName) . "," .
                                        $sql->quote($employee) . "," .
                                        $sql->quote($customer_data_implode) . "," .
                                        $sql->quote(strtolower(trim($_POST['app']))) .
                                        ")"
                                );
                        }
                        // save the filexport_data_flage on the HDD
                        $dona = new dona();
                        $company_folder = $dona->get_company_directory($_SESSION['company_id']);

                        // create the storage directory
                        
                        file_put_contents(dirname(__FILE__) . '/' . $company_folder['upload_dir'] . '/salary/' . $fileName, $export);
                        }else{
                            //echo "<pre>\n".print_r($aUsersSigned , 1)."</pre>";
                            $smarty->assign('export_data', htmlentities($export));
                            $smarty->assign('export_data_flag', 1);
                            $smarty->assign('export_data_users', serialize($aUsersSigned));
                            $messages->set_message('success', 'verification_passed_without_errors');
                            $smarty->assign('message', $messages->show_message());
                        }
                    }
                }
            }
        }
}elseif(isset($_POST['customer']) && isset($_POST['month']) && isset($_POST['year']) && $_POST['customer'] != '' && $_POST['month'] != '' && $_POST['year'] != ''){
    $list_employees = array();
    $sel_customer = $_POST['customer'];
    $sort_charecter = NULL;
    $search_emp_ids = array();
    $flag_show_previous_connections = 'Y';
    $selected_month = $_POST['month'];
    $selected_year = $_POST['year'];
       
    //if $flag_show_previous_connections == 'Y'  => get all connected employees
    $list_employees = $obj_emp->team_members_with_tt_connected_employees($sel_customer, $selected_year, $selected_month, $sort_charecter);
    $list_employees = filter_employee_list_by_employee_have_work($obj_emp, $list_employees, $selected_year, $selected_month, $sel_customer, $search_emp_ids, $flag_show_previous_connections);
    $total_records_count_including_connected = count($list_employees);
    if($flag_show_previous_connections != 'Y'){
        $list_employees = $obj_emp->team_members_for_employee_detailed_report($sel_customer,$sort_charecter);
        $list_employees = filter_employee_list_by_employee_have_work($obj_emp, $list_employees, $selected_year, $selected_month, $sel_customer, $search_emp_ids, $flag_show_previous_connections);
    }
    $total_records_count = count($list_employees);
    
    if(!empty($list_employees)){
        $j = 0;
        foreach ($list_employees as $obj_emps) {
            $report_list[$j]['username'] = $obj_emps['username'];
            $report_list[$j]['first_name'] = $obj_emps['first_name'];
            $report_list[$j]['last_name'] = $obj_emps['last_name'];
            if($selected_month == NULL){
                for ($i = 1; $i <= 12; $i++) {
                    $obj_emp_signing_details = $obj_emp->get_signin_details_by_employee_customer($selected_year, $i, $obj_emps['username'], $sel_customer);
        //            $obj_emp_work_details = $obj_emp->get_all_work_details_include_normal_nd_leave($obj_emps['username'], $i, $selected_year, $sel_customer);
        //            $report_list[$j]['have_work'][$i] = (!empty($obj_emp_work_details) ? 1 : 0);
                    $report_list[$j]['have_work'][$i] = $obj_emps['have_work'][$i];
                    $report_list[$j]['Sign_details'][$i] = (!empty($obj_emp_signing_details) ? $obj_emp_signing_details[$obj_emps['username']] : array());
                }
            }
            else {
                $obj_emp_signing_details = $obj_emp->get_signin_details_by_employee_customer($selected_year, $selected_month, $obj_emps['username'], $sel_customer);
                $report_list[$j]['have_work'][$selected_month] = $obj_emps['have_work'][$selected_month];
                $report_list[$j]['Sign_details'][$selected_month] = (!empty($obj_emp_signing_details) ? $obj_emp_signing_details[$obj_emps['username']] : array());
            }
            $j++;
        }
    }
    
    if(!empty($report_list) && $selected_month != NULL){
        foreach ($report_list as $key => $record) {
            $obj_inconv->reset_inconvenient_variables();
            $obj_inconv->generate_work_report($record['username'], $selected_month, $selected_year, $sel_customer);
            $sum_total_normal = array_sum($obj_inconv->sum_normal) + array_sum($obj_inconv->sum_travel) + array_sum($obj_inconv->sum_break) + array_sum($obj_inconv->sum_over) + array_sum($obj_inconv->sum_quality) +
                    array_sum($obj_inconv->sum_more) + array_sum($obj_inconv->sum_some) + array_sum($obj_inconv->sum_training) + array_sum($obj_inconv->sum_voluntary) + array_sum($obj_inconv->sum_complementary) + array_sum($obj_inconv->sum_standby);
    //                    $sum_personal = $obj_inconv->sum_personal;
            $sum_total_oncall = array_sum($obj_inconv->sum_oncall) + array_sum($obj_inconv->sum_calltraining) + array_sum($obj_inconv->sum_complementary_oncall) + array_sum($obj_inconv->sum_more_oncall);
            
            $report_list[$key]['work_hours'] = array(   'total_working_days'  => count($obj_inconv->days_in_month),
                                                        'total_normal'  => round($sum_total_normal, 2),
                                                        'total_oncall'  => round($sum_total_oncall, 2),
                                                        'total'         => round($sum_total_normal+$sum_total_oncall, 2));
        }
    }
    $smarty->assign('report_list', $report_list);
    $smarty->assign('search_type', 'customer');
    $smarty->assign('list_month', $selected_month);
    $smarty->assign('list_year', $selected_year);
    $smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
    
    //echo "<pre>\n".print_r($report_list , 1)."</pre>";exit();
    
}

// download exports
$query = $sql->prepare("SELECT distinct filename, count(distinct customers) as customer_count, customers, timestamp,employee,year,month,app FROM exports_lon_unsigned WHERE year=? AND month=? GROUP BY filename ORDER BY `timestamp` DESC");
$query->execute(array(
    (int) $_POST['year'],
    (int) $_POST['month']
));
$existing = false;
if ($query->rowCount()) {
    while ($data = $query->fetch()) {
        if($data['customers']){
        if($data['customer_count'] != 1 || strpos(',', $data['customers']) != false)
                $data['customers'] = '';
        }
        $existing[] = $data;
        
    }
}

if (isset($_POST['download']) && isset($_POST['filename'])) {
    
    if ($existing !== false) {
        foreach ($existing as $key => $value) {
            if ($value['filename'] == $_POST['filename']) {
                $dona = new dona();
                $company_folder = $dona->get_company_directory($_SESSION['company_id']);
                $file = dirname(__FILE__) . '/' . $company_folder['upload_dir'] . '/salary/' . $value['filename'];

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . $value['filename']);
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));

                readfile($file);
                exit;
            }
        }
    }
}




////////////////////Start of Jim's Code////////////////////////////////
$num_employees = $dummy->numEmployees();
$employees_signed = $dummy->getNotSigned();

$num_exported = 0;

$users_to_export = exportExists($_POST['month'], $_POST['year'], $salary_format, $employees_signed);

$num_signed = 0;
foreach ($users_to_export as $key=> $user_to_export){
    $num_signed += count($user_to_export);
}
//echo "<pre>\n".print_r($users_to_export , 1)."</pre>";
$query = $sql->prepare("SELECT e.first_name,e.last_name,employee_exported,customers FROM exports_lon_unsigned INNER JOIN employee e ON employee_exported LIKE e.username WHERE year=? AND month=? AND app=?");
    $query->execute(array(
        (int) $_POST['year'],
        (int) $_POST['month'],
        $salary_format
    ));
   
    
$num_exported = 0;
$employees_exported = array();
while (($row = $query->fetch())){
    $temp_employee_exported_username = $row['employee_exported'];
    $temp_employee_exported_employee = $row['last_name']." ". $row['first_name'];
    if($_SESSION['company_sort_by'] == 1)
        $temp_employee_exported_employee = $row['first_name']." ". $row['last_name'];
    
    $num_exported += substr_count($row['customers'], ",") + 1;
    $temp_exported_customers = explode(",", $row['customers']);
    if(array_key_exists($temp_employee_exported_username, $employees_exported))
        $employees_exported[$temp_employee_exported_username]['customers'] = array_merge ($employees_exported[$temp_employee_exported_username]['customers'], $temp_exported_customers);
    else{
        $employees_exported[$temp_employee_exported_username]['employee'] = $temp_employee_exported_employee;
        $employees_exported[$temp_employee_exported_username]['customers'] = $temp_exported_customers;
    }

}

//echo "<pre>\n".print_r($employees_exported , 1)."</pre>";

$customers_to_export = array();
if(!empty($employees_to_exp)){
    foreach($users_to_export as $employee => $customers){
        if(is_array($customers)){
            foreach ($customers as $customer_data){
                if(!in_array($customer_data, $customers_to_export))
                     $customers_to_export[] =   $customer_data; 
            }
        }
    }
}

foreach ($customer_list as $cust_key => $cust_value) {
    if (!in_array($cust_key, $customers_to_export)) {
        unset($customer_list[$cust_key]);
    }
}


//echo "$num_signed - $num_exported";
$smarty->assign('num_employees', $num_employees);
$smarty->assign('num_not_signed', $num_signed);
$smarty->assign('num_exported', $num_exported);
$smarty->assign('not_signed', $num_signed);
$smarty->assign('customer_list', array_keys($customer_list));
$smarty->assign('customer_list_n', $customer_list);
$smarty->assign('employees_exported', $employees_exported);
$smarty->assign('fkkn_split', $company_details['fkkn_split']);
///////////////////End of Jim's Code //////////////////////////////////

$smarty->assign('errors', $err);
if ($existing === false) {
    $smarty->assign('done', false);
} else {
    $smarty->assign('done', true);
    $smarty->assign('existing', $existing);
}
$smarty->assign('sms_num','');
$smarty->assign('email_num','');
$smarty->display('extends:layouts/dashboard.tpl|export_lon_unsigned.tpl');