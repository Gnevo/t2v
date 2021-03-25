<?php 
require_once('class/setup.php');
$smarty = new smartySetup(array("messages.xml","button.xml","notes.xml", "customer.xml", "reports.xml"));
require_once('class/notes.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('plugins/message.class.php');
$notes = new notes();
//require_once('class/user.php');
$customer = new customer();
$employee = new employee();
$message = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>5));
//$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

$customer_list = $customer->customer_list();
$smarty->assign('combo_customers', $customer_list);
$msg ='';
$params = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign("back_url", $_SERVER['HTTP_REFERER']);

//if(empty($_FILES) && empty($_POST) && isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) == 'post'){ //catch file overload error...
//        $postMax = ini_get('post_max_size'); //grab the size limits...
//        echo "<p style=\"color: #F00;\">\nPlease note files larger than {$postMax} will result in this error!<br>Please be advised this is not a limitation in the CMS, This is a limitation of the hosting server.<br>For various reasons they limit the max size of uploaded files, if you have access to the php ini file you can fix this by changing the post_max_size setting.<br> If you can't then please ask your host to increase the size limits, or use the FTP uploaded form</p>"; // echo out error and solutions...
//}


if($_POST['title'] && $_POST['description']){
        
        $notes->customer    = isset($_POST['cmb_customer']) && trim($_POST['cmb_customer']) != '' ? trim($_POST['cmb_customer']) : NULL;
        $notes->title       = trim($_POST['title']);
        $notes->description = trim($_POST['description']);
        //$notes->note_date = date('Y-m-d H:i:s');
        $notes->login_user  = $_SESSION['user_id'];
        if($_SESSION['user_role'] == '3')
            $notes->visibility = 2;     //set as private note
        else
            $notes->visibility = trim($_POST['type']);
        
        $notes->status=$_POST['status'];
        if($_SESSION['user_role'] != '1' &&  $_SESSION['user_role'] != '6')
            $notes->status=($_POST['type'] == 1 ? 0 : 1);
        
        $notes->attachment  = isset($_FILES['attachment']) ? $_FILES['attachment'] : array();
        
        
        $update_flag = 0;
        if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "" && $_SESSION['user_role'] == 1){
            $note_id = $params[0];
            $notes_detail = $notes->get_note_detail($note_id);
            if((int) $note_id > 0 && empty($notes_detail)){
                $update_flag = 0;
            }else{
                $update_flag = 1;
                if ($notes->update_note($note_id, trim($notes_detail[0]['attachment'])))
                        $message->set_message('success', 'note_updated_success');
                else
                        $message->set_message('fail', 'note_updated_fail');
            }
        }
        
        if($update_flag == 0 && false){
            if ($notes->insert_note())
                $message->set_message('success', 'note_adding_success');
            else
                $message->set_message('fail', 'note_adding_fail');
            $msg = 1;
        }
}

$permission = 0; 
if($_SESSION['user_role'] == 3){
        $permission_arr = $employee->get_privileges($_SESSION['user_id'], 3);
        $permission = $permission_arr['notes_attchment'];
}
$smarty->assign('msg',$msg);
$smarty->assign('permission',$permission);

$note_delet_permission = 'FALSE';
if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "" && $_SESSION['user_role'] == 1){  //for admin edit
    $note_id = (int) $params[0];
    if($note_id > 0){
        $notes_detail = $notes->get_note_detail($note_id);
        if(empty($notes_detail)){
            header("Location: " . $smarty->url . "notes/add/");exit;
        }else{
            $smarty->assign("notes_detail",$notes_detail[0]);
            $note_delet_permission = 'TRUE';
        }
    }else{
        header("Location: " . $smarty->url . "notes/add/");exit;
    }
}
$smarty->assign("note_delet_permission",$note_delet_permission);
$smarty->assign('message', $message->show_message());
$smarty->display('extends:layouts/dashboard.tpl|notes_add.tpl');
?>