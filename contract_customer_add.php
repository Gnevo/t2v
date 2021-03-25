<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","messages.xml","button.xml"));
require_once('class/customer.php');
$contract = new customer();
require_once('plugins/message.class.php');
$messages = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>3));
$smarty->assign('string',$_SERVER['QUERY_STRING']);
$user = explode('&',$_SERVER['QUERY_STRING']);
$smarty->assign('username',$user[0]);
$smarty->assign('user_id', $_SESSION['user_id']);
$smarty->assign('string',$_SERVER['QUERY_STRING']);
//echo $_SERVER['QUERY_STRING'];
if($_POST['reset']=='reset')
{
    $id=  explode('&', $_SERVER['QUERY_STRING']);
    if($id[0] != "")
    {
        $datas = $contract->contract_customer_edit_get($id[1]);
        $smarty->assign('data',$datas[0]);
        $smarty->assign('string',$id[0]);
        $smarty->assign('user_id',$id[1]);
    }
    else
    {
        $smarty->assign('data',"");
        $smarty->assign('string',"");
        $smarty->assign('user_id',"");
    }
}
else if($_POST['action']=='edit')
{
    
    //echo " Edithig !!!!!";
    //$user = explode('&',$_SERVER['QUERY_STRING']);
    $contract->user = $_POST['user'];
    $contract->hours = $_POST['hours'];
    $contract->date_from = $_POST['date_from'];
    $contract->date_to = $_POST['date_to'];
    $contract->contract_customer_edit($user[1]);
    header("location:".$smarty->url."contract/customer/list/".$user[0]."/");
}


    //$query_string = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],basename($_SERVER['PHP_SELF'],".php"))+strlen(basename($_SERVER['PHP_SELF'],".php")));

else if($_POST['action']=='add')
{
    //echo "adding";
    //echo $user = explode('&',$_SERVER['QUERY_STRING']);
    $contract->user = $_POST['user'];
    $contract->hours = $_POST['hours'];
    $contract->date_from = $_POST['date_from'];
    $contract->date_to = $_POST['date_to'];
    $contract->contract_customer_add();
    header("location:".$smarty->url."contract/customer/list/".$user[0]."/");
}
else
{
   // echo "at else part";
    $id=  explode('&', $_SERVER['QUERY_STRING']);
    $check = $contract->contract_add_edit_customer_check($id);
    //echo " ".$check;
    if($check == "edit")
    {
        $datas = $contract->contract_customer_edit_get($id[1]);
        $smarty->assign('data',$datas[0]);
        $smarty->assign('string',$id[0]);
        $smarty->assign('user_id',$id[1]);
    }
}

/*$query_string = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],basename($_SERVER['PHP_SELF'],".php"))+strlen(basename($_SERVER['PHP_SELF'],".php")));
if(!empty($query_string))
{
	$str = explode('/',$query_string);
}//print_r($str);

if(!empty($_POST['submit']) && $str[1] == "add")
{
	$contr->user = $_POST['user'];
	$contr->hours = $_POST['hours'];
	$contr->date_from = $_POST['date_from'];
	$contr->date_to = $_POST['date_to'];
	$contr->contract_customer_add();
}
 
 */
$smarty->display('extends:layouts/dashboard.tpl|contract_customer_add.tpl');

?>