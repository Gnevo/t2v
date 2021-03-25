<?php
ini_set('display_errors', true);
ini_set('xdebug.var_display_max_depth', 10);
error_reporting(E_ALL ^ E_NOTICE);
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


$inc_timing = new inconvenient_timing();
//$list = $inc_timing->inconvenient_timing_list();
$list = $inc_timing->inconvenient_timing_list_copy();
$holi_list = $inc_timing->holiday_timing_list();
$messages = new message();
$obj_sms = new sms('hai');
$export = new export();
$obj_emp = new employee();
$obj_company  = new company();
$smarty = new smartySetup(array("month.xml", "messages.xml", "button.xml", "forms.xml", "export.xml", "export-config.xml"));
$company_details = $obj_company->get_company_detail($_SESSION['company_id']);
// Autoload export classes.
spl_autoload_register('export_autoload');

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
    }elseif($key == 2){
        $out['2002.1'] = '2002.1';
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




if ($_POST['sms_num'] || $_POST['email_num']) {
    //echo "<pre>".print_r($_POST['sms_num'],1)."</pre>";
    if($_POST['sms_num'] != "" || $_POST['sms_num'] != NULL){
        $sms_numbers = explode(",", $_POST['sms_num']);
    }else{
        $sms_numbers = array();
    }
    if($_POST['sms_num'] != "" || $_POST['email_num'] != NULL){
        $email_ids = explode(",", $_POST['email_num']);
    }else{
        $email_ids = array();
    }
    $monthes = $_POST['sms_month'];
    $years = $_POST['sms_year'];
    foreach($email_ids as $email_id){
        $employee_det = $obj_emp->get_employee_detail($email_id);
        if($employee_det['email']){
        $mail_message = $smarty->translate['label_hi'] . ' ' .$employee_det['last_name'] . ' ' . $employee_det['first_name'] . '<br/>'; ;
        $mail_subject = $smarty->translate['export_email_subject'];

        if ($_POST['textfield'] != "") {
            $mail_message .= $_POST['textfield'];
        }else{
            $mail_message .= $smarty->translate['export_email_message'];
        }
        $mail = new SimpleMail($mail_subject, $mail_message);
        $mail->addSender("cirrus-noreplay@time2view.se");
        $mail->addRecipient($employee_det['email']);
        $export->employees_mail[] = $employee_det['username'];
        $mail->send ();

        }
    }
    if(count($sms_numbers) > 0){
        for ($i = 0; $i < count($sms_numbers); $i++) {
            $obj_sms->addRecipient($sms_numbers[$i]);
        }
        
        
        $export->employees_sms = $obj_sms->recipients;

        if ($_POST['textfield'] != "") {
            $obj_sms->message = $_POST['textfield'];
        } else {
            $obj_sms->message = $smarty->translate[sms_export_message];
        }
        if($obj_sms->recipients)
            $obj_sms->send_export();
        $datas = $export->send_sms_export($monthes, $years);
        
    }
    if(count($export->employees_mail)){
        $datas1 = $export->send_mail_export($monthes, $years);
    }
    if ($datas == 1 || $datas1) {
        $message = 'sms_send_sucess';
        $type = "success";
        $messages->set_message($type, $message);
        $smarty->assign('message', $messages->show_message());
    }
}

//if($_SERVER['QUERY_STRING']){
//    $message = 'sms_send_sucess';
//      $type = "success";
//      $messages->set_message($type, $message);
//      $smarty->assign('message', $messages->show_message());
//}
// Nothing fancy.
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
    $query = $sql->prepare("SELECT employee_exported,customers FROM exports_lon WHERE year=? AND month=? AND app=?");
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
                }
                
    //                foreach ($exported_customers as $exported_customer){
    //                    if (($key = array_search($exported_customer, $signedUsers[$row['employee_exported']])) !== false) {
    //                        unset($signedUsers[$row['employee_exported']][$key]);
    //                    }
    //                }
    //                if(empty($signedUsers[$row['employee_exported']])){
    //                    unset($signedUsers[$row['employee_exported']]);
    //                }
            }
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

        /* if(empty($c_list_item['code']))
          {
          $c_list[$c_list_key]['code'] = $c_list_item['century'].$c_list_item['social_security'];
          }
          //        $c_list_item['first_name'] = utf8_decode($c_list_item['first_name']);
          //        $c_list_item['last_name'] = utf8_decode($c_list_item['last_name']); */
        $customer_list[$c_list_item['username']] = $c_list_item['last_name'] . ' ' . $c_list_item['first_name'];
    }
    asort($customer_list);
}
$c_list_post = $c_list;
if ($_POST['customer']) {
    unset($c_list_post);
    $c_list_post[$_POST['customer']] = $customer->customer_detail($_POST['customer']);
    /* if(empty($c_list_post[0]['code']))
      {
      $c_list_post[0]['code'] = $c_list_post[0]['century'].$c_list_post[0]['social_security'];
      } */
}

if (isset($_POST['del_file'])) {
     $query = $sql->prepare("DELETE from exports_lon WHERE filename= ?");
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
$userSigned = $dummy->getSigned();
$employees_to_exp = exportExists($_POST['month'], $_POST['year'], $salary_format, $userSigned);
//echo "<pre>\n".print_r($employees_to_exp , 1)."</pre>";

//$employees_to_export = "'";
//if (!empty($employees_to_exp))
//    $employees_to_export .= implode("','", $employees_to_exp);
//$employees_to_export .= "'";
//
//
//$customers_to_export = $customer->get_customers_for_employees($employees_to_export, $_POST['month'], $_POST['year']);
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
    
    // role values
    // 1 -> admin
    // 2 -> TL
    // 3 -> employee
    // 4 -> customer
    //echo $current_time_code_count."--".$stored_external_time_code_count."--".$flag_monthly_salary;
    /*if ($current_time_code_count == $stored_external_time_code_count &&
            ($flag_monthly_salary == FALSE ||
            ($flag_monthly_salary == TRUE && $current_time_code_count == $stored_monthly_time_code_count)
            )
    ) {*/
        
    //        $userSigned = getUserRoles($dummy->getSigned());
    //        $userNotSigned = getUserRoles($dummy->getNotSigned());
    $dtz = new DateTime; // current time = server time
    $dtz->setTimestamp(time());
    $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
    $filenNameCommon = $_POST['year'] . sprintf('%02d', $_POST['month']) . '_' . $_SESSION['user_id'] . '_' . $dtz->format('Ymd_His'); //date('Ymd_His');
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
            $aUsersSigned = unserialize($_POST['export_data_users'])    ;
            //echo "<pre>\n".print_r($aUsersSigned , 1)."</pre>";
            foreach($aUsersSigned as $employee => $customers_data){
                $customer_data_implode = implode(",", $customers_data); 

                $query = $sql->query(
                            "INSERT IGNORE INTO exports_lon (year,month,timestamp,employee,employeeName,filename,employee_exported,customers,app) VALUES (" .
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
            
        $userSigned = $dummy->getSigned();
        $userNotSigned = $dummy->getNotSigned();

        // get the signed usernames
        $aUsersSigned = exportExists($_POST['month'], $_POST['year'], $_POST['app'], $userSigned);
        
        // echo "<pre>\n".print_r($userSigned , 1)."</pre>";
        // echo "<pre>\n".print_r($userNotSigned , 1)."</pre>";
        // exit();
    //        
    //        echo "----------------------------------------------------------------------";
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
            $messages->set_message('fail', 'timesheets_not_signed');
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
                //                echo "-------------------------------------------";
                //echo $sUsersSigned;
                // write to DB table
                /*if ($_POST['customer'] == "") {
                    $query = $sql->query(
                            "INSERT IGNORE INTO exports_lon (year,month,timestamp,employee,employeeName,filename,employees,app) VALUES (" .
                            (int) $_POST['year'] . "," .
                            (int) $_POST['month'] . "," .
                            strtotime($dtz->format('Y-m-d H:i:s')) . "," .
                            $sql->quote($_SESSION['user_id']) . "," .
                            $sql->quote($_SESSION['user_name']) . "," .
                            $sql->quote($fileName) . "," .
                            $sql->quote($sUsersSigned) . "," .
                            $sql->quote(strtolower(trim($_POST['app']))) .
                            ")"
                    );
                } else {
                    $query = $sql->query(
                            "INSERT IGNORE INTO exports_lon (year,month,timestamp,employee,employeeName,filename,employees,app) VALUES (" .
                            (int) $_POST['year'] . "," .
                            (int) $_POST['month'] . "," .
                            strtotime($dtz->format('Y-m-d H:i:s')) . "," .
                            $sql->quote($_SESSION['user_id']) . "," .
                            $sql->quote($_SESSION['user_name']) . "," .
                            $sql->quote($fileName) . "," .
                            "''" . "," .
                            $sql->quote(strtolower(trim($_POST['app']))) .
                            ")"
                    );
                }*/
                
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
                                    "INSERT IGNORE INTO exports_lon (year,month,timestamp,employee,employeeName,filename,employee_exported,customers,app) VALUES (" .
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
                    //if (!file_exists('/salary'))
                    //{
                    //  mkdir('/salary', 0777, true);
                    //}
                    // save the export in the file
                    //echo dirname(__FILE__) . '/' . $company_folder['upload_dir'] . '/salary/' . $fileName;

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
    /*}else{
        $messages->set_message('fail', 'salary_code_incomplete');
        $smarty->assign('message', $messages->show_message());
    }*/
}

// download exports
$query = $sql->prepare("SELECT distinct filename, count(distinct customers) as customer_count, customers, timestamp,employee,year,month,app FROM exports_lon WHERE year=? AND month=? GROUP BY filename ORDER BY `timestamp` DESC");
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
$employees_signed = $dummy->getSigned();
$employees_not_signed_details = $dummy->getNotSignedEmployee();
$employees_not_signed = array_keys($employees_not_signed_details);
$num_not_signed = 0;
foreach ($employees_not_signed_details as $key=>$employees_not_signed_detail){
    $num_not_signed += count($employees_not_signed_detail);
}
$num_exported = 0;
$not_signed = '';
$temp = "'";
$temp .= implode("','", $employees_not_signed);
$temp .="'";
$dummy->tables = array('employee');
$dummy->fields = array('username','first_name','last_name','phone,mobile,email');
$dummy->conditions = array('IN', 'username', $temp);
$dummy->order_by = array('LOWER(last_name)', 'LOWER(first_name)');
$dummy->query_generate();
$datas = $dummy->query_fetch();
$even_odd = 1;
foreach ($datas as $personalia) {

    $row_span = count($employees_not_signed_details[$personalia['username']]);
//    echo "<pre>". print_r($employees_not_signed_details[$personalia['username']], 1)."</pre>";
//    echo "SELECT date_format(send_date,'%Y-%m-%d %H:%i') AS sd FROM export_lon_sms WHERE employee='" . $personalia['username'] . "' AND `month`=" . (int) $_POST['month'] . " AND `year`=" . (int) $_POST['year'] . " ORDER BY send_date DESC LIMIT 1";
//    echo "SELECT COUNT(send_date) AS count_send FROM export_lon_sms WHERE employee='" . $personalia['username'] . "' AND `month`=" . (int) $_POST['month'] . " AND `year`=" . (int) $_POST['year'];
    $query_last_send = $sql->prepare("SELECT date_format(send_date,'%Y-%m-%d %H:%i') AS sd FROM export_lon_sms WHERE employee='" . $personalia['username'] . "' AND `month`=" . (int) $_POST['month'] . " AND `year`=" . (int) $_POST['year'] . " ORDER BY send_date DESC LIMIT 1");
    $query_send_count = $sql->prepare("SELECT COUNT(send_date) AS count_send FROM export_lon_sms WHERE employee='" . $personalia['username'] . "' AND `month`=" . (int) $_POST['month'] . " AND `year`=" . (int) $_POST['year']);
    $query_last_send->execute();
    $last_date = $query_last_send->fetch();
    $query_send_count->execute();
    $send_count = $query_send_count->fetch();
    
//    echo "SELECT date_format(send_date,'%Y-%m-%d %H:%i') AS sd FROM export_lon_mail WHERE employee='" . $personalia['username'] . "' AND `month`=" . (int) $_POST['month'] . " AND `year`=" . (int) $_POST['year'] . " ORDER BY send_date DESC LIMIT 1";
//    echo "SELECT COUNT(send_date) AS count_send FROM export_lon_mail WHERE employee='" . $personalia['username'] . "' AND `month`=" . (int) $_POST['month'] . " AND `year`=" . (int) $_POST['year'];
    $query_last_send_mail = $sql->prepare("SELECT date_format(send_date,'%Y-%m-%d %H:%i') AS sd FROM export_lon_mail WHERE employee='" . $personalia['username'] . "' AND `month`=" . (int) $_POST['month'] . " AND `year`=" . (int) $_POST['year'] . " ORDER BY send_date DESC LIMIT 1");
    $query_send_count_mail = $sql->prepare("SELECT COUNT(send_date) AS count_send FROM export_lon_mail WHERE employee='" . $personalia['username'] . "' AND `month`=" . (int) $_POST['month'] . " AND `year`=" . (int) $_POST['year']);
    $query_last_send_mail->execute();
    $last_date_mail = $query_last_send_mail->fetch();
//    echo "<pre>". print_r($last_date_mail, 1)."</pre>";
    $query_send_count_mail->execute();
    $send_count_mail = $query_send_count_mail->fetch();
    
    /*if ($even_odd % 2 == 0) {
        $class = "odd";
        $even_odd++;
    } else {
        $class = "even";
        $even_odd++;
    }*/
    
    
    
    foreach($employees_not_signed_details[$personalia['username']] as $customer_data_details){
        $not_signed .= '
                    <tr>';
        if($_SESSION['company_sort_by'] == 1)
            $not_signed .=    '<td>' . $personalia['first_name'] . ' ' . $personalia['last_name'] . ' / '.$customer_data_details.'</td>';
         elseif($_SESSION['company_sort_by'] == 2)
            $not_signed .=    '<td>' . $personalia['last_name'] . ' ' . $personalia['first_name'] . ' / '.$customer_data_details.'</td>';
                               
                            
                            
                            if($personalia['mobile'])
                                $not_signed .= '<td>0' . $personalia['mobile'] . '</td>';
                            else
                                $not_signed .= '<td></td>';
        if ($personalia['mobile'] != "" || $personalia['mobile'] != null) {
            $not_signed .= '<td class="center"><input class="small-col check_sms" type="checkbox" name="sms[]" id="sms_' . $personalia['mobile'] . '" value="' . $personalia['mobile'] . '"></td>';
        } else {
            $not_signed .= '<td></td>';
        }
        if ($personalia['email'] != "" || $personalia['email'] != null) {
            $not_signed .= '<td class="center"><input class="small-col check_email" type="checkbox" name="email[]" id="email_' . $personalia['mobile'] . '" value="' . $personalia['username'] . '"></td>';
        } else {
            $not_signed .= '<td></td>';
        }
        if ($last_date['sd'] != "" && $last_date['sd'] != NULL ) {
            $sd = $last_date['sd'];
            $send_cnt = $send_count['count_send'];
            $send_pic = '<img src="'.$smarty->url.'/images/sms.png">';
            if(strtotime($last_date['sd']) < strtotime($last_date_mail['sd'])){
                $sd = $last_date_mail['sd'];
                $send_pic = '<img src="'.$smarty->url.'/images/mail_sms.jpg">';
            }
            if($send_count_mail['count_send'] > 0)
                $send_cnt .= "/".$send_count_mail['count_send'];
            $sms_date_time = explode(" ", $sd);
            $not_signed .= '<td><div class="export_last_date_sms"><span class="export_pic_sms">' .$send_pic.'</span>'. $sms_date_time[0].' '.$sms_date_time[1] . '</div></td><td width="20px" align="center">' . $send_cnt . '</td>
                    </tr>
                        ';
        } elseif($last_date_mail['sd'] != "" && $last_date_mail['sd'] != NULL){
            $mail_date_time = explode(" ", $last_date_mail['sd']);
            $send_pic = '<img src="'.$smarty->url.'/images/mail_sms.jpg">';
            $not_signed .= '<td><div class="export_last_date_email"><span class="export_pic_email">' .$send_pic.'</span>'.$mail_date_time[0].' '.$mail_date_time[1]  . '</div></td><td width="20px" align="center">' . $send_count_mail['count_send'] . '</td>
                    </tr>
                        ';
        }else {
            $not_signed .= '<td>&nbsp;</td><td>&nbsp;</td></tr>';
        }
     }
}


$users_to_export = exportExists($_POST['month'], $_POST['year'], $salary_format, $employees_signed);

$num_signed = 0;
foreach ($users_to_export as $key=> $user_to_export){
    $num_signed += count($user_to_export);
}
//echo "<pre>\n".print_r($users_to_export , 1)."</pre>";
$query = $sql->prepare("SELECT e.first_name,e.last_name,employee_exported,customers FROM exports_lon INNER JOIN employee e ON employee_exported LIKE e.username WHERE year=? AND month=? AND app=?");
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
$smarty->assign('num_signed', $num_signed);
$smarty->assign('num_exported', $num_exported);
$smarty->assign('num_not_signed', $num_not_signed);
$smarty->assign('not_signed', $not_signed);
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
$smarty->display('extends:layouts/dashboard.tpl|export_lon.tpl');