<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/dona.php');
require_once('class/user.php');
require_once('plugins/pagination.class.php');
require_once('plugins/message.class.php');

$dona = new dona();
$obj_user = new user();
$pagination = new pagination();
$messages = new message();

if($_POST['mark_read']){
    $leave_list = $dona->get_all_employee_leave(NULL, NULL, NULL, $sel_search_text,NULL,'NO_LIMIT');
    $unread_leave = $dona->get_unread_leave();
    $updated_list = $dona->get_all_unread_leaves($leave_list,$unread_leave);
    $dona->set_as_read_leaves($updated_list);
}
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","notes.xml", 'gdschema.xml'));

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
$privileges_mc = $obj_user->get_privileges($_SESSION['user_id'], 3);
$smarty->assign('privileges_mc' , $privileges_mc);
$smarty->assign('user_role', $_SESSION['user_role']);
$smarty->assign('user_id', $_SESSION['user_id']);
// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$params                              = explode('&', $_SERVER['QUERY_STRING']);
$this_month                          = $params[0];
$this_year                           = $params[1];
$this_emp                            = $params[2];
$this_search_text                    = urldecode(trim($params[3]));
$this_show_untreated_leave_only_flag = $params[4];
$dona->employee                      = $_SESSION['user_id'];


$pro = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http');
$current_url =  $pro."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$smarty->assign("current_url", $current_url);

/* this block for finding month values  */
global $month,$leave_type;
$month_num=array();
$month_name=array();

//print_r($leave_type);
foreach ($month as $m_id){
    $month_num[]=$m_id['id'];
    $month_name[]=$smarty->translate[$m_id['month']];
}

$_SESSION['from_page'] = '';
$_SESSION['report_return_url'] = '';
unset($_SESSION['from_page']);
unset($_SESSION['report_return_url']);

$smarty->assign('today_date', date('Y-m-d'));
$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output", $month_name);
$smarty->assign("leave_type", $leave_type);  // take leave type from config.inc.php
/* end-- block for finding month values  */

/* this block for finding year values  */
$years_combo= $dona->distinct_leave_years();
$smarty->assign("year_option_values", $years_combo);
/* end-- block for finding year values  */

$sel_emp = (($this_emp != "" && $this_emp != "NULL") ? $this_emp : NULL);
$smarty->assign('sel_emp', $sel_emp);
if($sel_emp != NULL){
    $sel_emp_details = $dona->get_employee_details($sel_emp);
    $smarty->assign('sel_emp_label', $sel_emp_details[0]['fullname'].'('.$sel_emp.')');
}

/* this for advanced search with search word */
$sel_search_text = (($this_search_text != "" && $this_search_text != "NULL") ? $this_search_text : NULL);
$smarty->assign('sel_search_text', $sel_search_text);

/* this block for set current value of combo box  */
$sel_year=($this_year != "" && $this_year != "NULL" ? $this_year : NULL );
$sel_month=($this_month != "" && $this_month != "NULL" ? (int)$this_month : NULL);
/* end-- block for set current value of combo box  */

$this_show_untreated_leave_only_flag = (trim($this_show_untreated_leave_only_flag) == 'Y' ? 0 : NULL);
$this_show_untreated_leave_only_flag_check_label_val = ($this_show_untreated_leave_only_flag === 0 ? 'Y' : 'N');
$smarty->assign('this_show_untreated_leave_only_flag_check_label_val', $this_show_untreated_leave_only_flag_check_label_val);


$per_page = 10;
$org_post=TRUE;    //used for check original post
$label=true;    //used instead of goto
$untreated_leaves = FALSE;
while($label){
    $label=false;
    if($sel_year != NULL && $sel_month != NULL){
        /* this block for set table body  */
        $leave_list = $dona->get_all_employee_leave($sel_year,$sel_month, $sel_emp, $sel_search_text, $this_show_untreated_leave_only_flag);
        //        echo "leave_list<pre>".print_r($leave_list, 1)."</pre>"; exit();

        // check if any untreated leaves 
        if ($privileges_mc['approve_all_leave'] == 1 && !empty($leave_list)){
            foreach($leave_list as $l){
                if($l['status'] == 0){
                    $untreated_leaves = TRUE;
                    break;
                }
            }
        }

        $url_employee = ($sel_emp != NULL) ? $sel_emp : 'NULL';
        $url_year = ($sel_year != '') ? $sel_year : 'NULL';
        $url_month = ($sel_month != '') ? (int)$sel_month : 'NULL';
        $url_search_text = ($sel_search_text != '') ? $sel_search_text : 'NULL';
        $leave_list = $pagination->generate($leave_list, $per_page);
        
        $smarty->assign('pagination', $pagination->links($smarty->url . 'message/center/leave/'.$url_month.'/'.$url_year.'/'.$url_employee.'/'.$url_search_text.'/'.$this_show_untreated_leave_only_flag_check_label_val.'/'));
        
        $temp_leave_list = $dona->get_all_employee_leave($sel_year,$sel_month);     // this for advanced search with employees
        /* end-- block for set table body  */
        //echo "<pre>".print_r($leave_list,1)."</pre>";
        $leave_list = $dona->get_leave_customer_formation($leave_list);
        $search_emp_array = unique_leave_employee_array($temp_leave_list);        // this for advanced search with employees
        // echo "condition_values<pre>".print_r($leave_list, 1)."</pre>";
        // exit();
        $smarty->assign('search_emp_array', $search_emp_array);
        $smarty->assign('leave_list', $leave_list);
        $smarty->assign('report_month', $sel_month);
        $smarty->assign('report_year', $sel_year);
        $flag=0;
        $smarty->assign('flag', $flag);
        
    }elseif($sel_year == NULL && $sel_month == NULL) {
        //        echo '22';
        $smarty->assign('report_month', '');
        $smarty->assign('report_year', '');

        $leave_list = $dona->get_all_employee_leave(NULL, NULL, NULL, $sel_search_text, $this_show_untreated_leave_only_flag, "SHOW_ALL");
        $unread_leave = $dona->get_unread_leave();
        $updated_list = $dona->get_all_unread_leaves($leave_list,$unread_leave);
        
        $url_employee = ($sel_emp != NULL) ? $sel_emp : 'NULL';
        $url_search_text = ($sel_search_text != '') ? $sel_search_text : 'NULL';
        $updated_list = $pagination->generate($updated_list, $per_page);
        $smarty->assign('pagination', $pagination->links($smarty->url . 'message/center/leave/NULL/NULL/'.$url_employee.'/'.$url_search_text.'/'.$this_show_untreated_leave_only_flag_check_label_val.'/'));
        
        $search_emp_array = unique_leave_employee_array($updated_list);       // this for advanced search with employees
        $smarty->assign('search_emp_array', $search_emp_array);
        $updated_list = $dona->get_leave_customer_formation($updated_list);
        $smarty->assign('leave_list', $updated_list);
        $dona->set_as_read_leaves($updated_list);
        $flag=1;
        $smarty->assign('flag', $flag);
        if (empty($updated_list)){
            $sel_year=date('Y');
            $sel_month=sprintf("%1d", date('m'));
            $smarty->assign('report_month', $sel_month);
            $smarty->assign('report_year', $sel_year);
            $org_post=FALSE;
            $label=true;
        }
    }
}

// echo $_SESSION['user_role'];
// exit();
$tl_accessible_customers = $dona->get_customer_for_algl_with_role();
// print_r($tl_accessible_customers);
// exit();

$smarty->assign('tl_accessible_customers', $tl_accessible_customers);
$smarty->assign('has_untreated_leaves', $untreated_leaves);
$smarty->assign('this_page_no', $pagination->page - 1);
$smarty->assign('per_page', $per_page);
$smarty->assign('message', $messages->show_message());

$smarty->display('extends:layouts/dashboard.tpl|message_center_leave.tpl');


function unique_leave_employee_array($leave_array){
    $emp_array = array();
    $emp_det_array = array();
    if(!empty($leave_array)){
        $i = 0;
        foreach ($leave_array as $leave_slot){
            if(!in_array($leave_slot['employee'], $emp_array)){
                $emp_array[] = $leave_slot['employee'];
                $emp_det_array[$i]['eID'] = $leave_slot['employee'];
                if($_SESSION['company_sort_by'] == 1)
                    $emp_det_array[$i]['eName'] = $leave_slot['empname'];
                elseif($_SESSION['company_sort_by'] == 2)
                    $emp_det_array[$i]['eName'] = $leave_slot['empname_lf'];
                
                $i++;
            }
        }
//        echo "<pre>".print_r($emp_array, 1)."</pre>";
//        echo "<pre>".print_r($emp_det_array, 1)."</pre>";
    }
    return $emp_det_array;
}
?>