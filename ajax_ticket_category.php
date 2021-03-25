<?php
require_once('class/setup.php');
require_once('class/support.php');
$support = new support();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","tooltip.xml", "support.xml"), FALSE);
$category_type = ($_REQUEST['cat_type'] == 2) ? 'External' : 'Internal';
$selected_category = ((int)$_REQUEST['category_id'] > 0) ? $_REQUEST['category_id'] : 0;
$categories = $support->get_support_category_options($category_type);
$smarty->assign('selected_category', $selected_category);
$smarty->assign('support_categories', $categories);
$smarty->display('ajax_ticket_category.tpl');