<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"));
require_once('class/employee.php');
$contract = new employee();
require_once('plugins/message.class.php');
$messages = new message();
$smarty->assign('user_id', $_SESSION['user_id']);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2));
$user = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign('username',$user[0]);
//print_r($user);
//$_SESSION['user'] = $user[0];

//echo "action = " . $_POST['action'];
//$smarty->assign('user_id',$user_id);
//$query_string = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],basename($_SERVER['PHP_SELF'],".php"))+strlen(basename($_SERVER['PHP_SELF'],".php")));
//$users = explode('/', $query_string);

if ($_POST['reset'] == 'reset') {
    $id = explode('&', $_SERVER['QUERY_STRING']);
    if ($id[0] != "") {
        $datas = $contract->contract_employee_edit_get($id[1]);
        $smarty->assign('data', $datas[0]);
        $smarty->assign('string', $id[0]);
        $smarty->assign('user_id', $id[1]);
    } else {
        $smarty->assign('data', "");
        $smarty->assign('string', "");
        $smarty->assign('user_id', "");
    }
} else if ($_POST['action'] == 'edit') {

    //echo " Edithig !!!!!";

    $contract->user = $_POST['user'];
    $contract->hours = $_POST['hours'];
    $contract->date_from = $_POST['date_from'];
    $contract->date_to = $_POST['date_to'];
    $contract->contract_employee_edit($user[1]);
    header("location:".$smarty->url."contract/employee/list/".$user[0]."/");
}


//$query_string = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],basename($_SERVER['PHP_SELF'],".php"))+strlen(basename($_SERVER['PHP_SELF'],".php")));
else if ($_POST['action'] == 'add') {
    //echo "adding";
    $contract->user = $_POST['user'];
    $contract->hours = $_POST['hours'];
    $contract->date_from = $_POST['date_from'];
    $contract->date_to = $_POST['date_to'];
    $contract->contract_employee_add();
    header("location:".$smarty->url."contract/employee/list/".$user[0]."/");
} else {
    // echo "at else part";
    $id = explode('&', $_SERVER['QUERY_STRING']);
    $check = $contract->contract_add_edit_employee_check($id);
    //echo " ".$check;
    if ($check == "edit") {
        $datas = $contract->contract_employee_edit_get($id[1]);
        $smarty->assign('data', $datas[0]);
        $smarty->assign('string', $id[0]);
        $smarty->assign('user_id', $id[1]);
    }
}

/* if(!empty($query_string))
  {
  $str = explode('/',$query_string);
  }//print_r($str);

  if(!empty($_POST['submit']) && $str[1] == "add")
  {
  $contract->user = $_POST['user'];
  $contract->hours = $_POST['hours'];
  $contract->date_from = $_POST['date_from'];
  $contract->date_to = $_POST['date_to'];
  $contract->contract_employee_add();
  } */
$smarty->display('extends:layouts/dashboard.tpl|contract_employee_add.tpl');
?>