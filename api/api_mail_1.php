<?php

session_start();
$app_dir = dirname(dirname(realpath(__FILE__)));
chdir($app_dir);
require_once('class/setup.php');
require_once('class/notes.php');
require_once('class/equipment.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$mail = new mail();
$obj_equip = new equipment();
$obj = array();

if (trim($_REQUEST['type_view']) == 1) {
    $req_year = trim($_REQUEST['year']);
    $req_month = trim($_REQUEST['month']);
    $req_category = trim($_REQUEST['category']);
    $sel_year = ($req_year != "" && $req_year != "NULL" ? $req_year : 0 );
    $sel_month = ($req_month != "" && $req_month != "NULL" ? $req_month : 0);
    $i = 0;

    //if($sel_year != NULL && $sel_month != NULL){
    $data = $mail->get_all_mail($req_category, $sel_year, $sel_month);
    if (!empty($data)) {
        foreach ($data as $mails) {
            $obj[$i] = $mails;
            $obj[$i]['catg_mail'] = $req_category;
            $i++;
        }
    }
    //echo "<pre>". print_r($data, 1)."</pre>";
} 
else if (trim($_REQUEST['type_view']) == 2) {
    $user = trim($_REQUEST['user']);
    $_SESSION['user_role'] = trim($_REQUEST['role']);
    $exact_employees = $obj_equip->employee_mailable($user);
    $i = 0;
//    echo "<pre>". print_r($exact_employees, 1)."</pre>";
    if (!empty($exact_employees)) {
        foreach ($exact_employees as $emp) {
            $obj[$i] = $emp;
            $i++;
        }
    }
} 
else if (trim($_REQUEST['type_view']) == 3) {
    $user = trim($_REQUEST['user']);
    $_SESSION['user_role'] = trim($_REQUEST['role']);
    $mail_id = $_REQUEST['mail_id'];
    $category = $_REQUEST['category'];
    if ($category == 1) {
        $mail->set_as_read_mail($mail_id);
    }
    $mail_detail = $mail->get_mail($mail_id, $category);
    $i = 0;
    $obj[0] = $mail_detail;
    $obj[0]['action'] = $_REQUEST['action'];
    $obj[0]['category'] = $_REQUEST['category'];
//    echo "<pre>". print_r($mail_detail, 1)."</pre>";
//    echo "<pre>". print_r($exact_employees, 1)."</pre>";
//    if(!empty($mail_detail)){
//            foreach($mail_detail as $detail) {
//                    $obj[$i] = $detail;
//                    $i++;
//            }
//        }
} 
else if (trim($_REQUEST['type_view']) == 4) {
    $_SESSION['user_id'] = trim($_REQUEST['user']);
    $unread_mail = $mail->get_all_unread_mail();
    $obj['count'] = count($unread_mail);
//    $obj['my_session'] = $_SESSION;
//    echo "<pre>".print_r($_SESSION, 1)."</pre>";
}
//header("content-type: text/javascript");
echo json_encode($obj);
?>