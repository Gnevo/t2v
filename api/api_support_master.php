<?php

session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname(realpath(__FILE__)));
chdir($app_dir);

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/support_new.php');
$smarty = new smartySetup(array("user.xml", "support.xml"), FALSE);
$support = new support();
$company_id = $_SESSION['company_id'];

switch ($_REQUEST['data']) {
    case 'priority':
        $data = $support_priority;
        break;
    case 'status':
        $data = $support_status;
        break;
    case 'ticket_type':
        $data = $support_ticket_type;
        break;
    case 'category_type':
        $data = $support_category_type;
        break;
    case 'cirrus_user':
        $data = $cirrus_admins;
        break;
    case 'company':
        $data = $support->get_companies();
        break;
    case 'category':
        $category_type = $_REQUEST['category_type'];
        $data = $support->get_support_category_options($category_type, $company_id);
        break;
    case 'admins':
        $data = $support->get_support_admin_users_options($company_id);
        break;
    case 'users':
        $data = $support->get_all_users($company_id);
        break;
    case 'upload_dir':
        $data = $support->get_companies($company_id);
        $upload_dir = $preference['url'] . $data[0]['upload_dir'] . "/tickets/attachment/";
        $data = array('upload_dir'=> $upload_dir);
        break;
    default :
        $data = array();
}
echo json_encode($data);