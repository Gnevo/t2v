<?php
require_once('class/setup.php');
require_once('class/support_new.php');
$support = new support();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","tooltip.xml", "support.xml"), FALSE);

$category_type = $_REQUEST['category_type'];
$company_id = $_REQUEST['company_id'];
$selected_category = ((int)$_REQUEST['category_id'] > 0) ? $_REQUEST['category_id'] : 0;
$categories = $support->get_support_category_options($category_type, $company_id);
$smarty->assign('selected_category', $selected_category);
$smarty->assign('support_categories', $categories);
$smarty->display('ajax_support_ticket_category.tpl');