<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer_ai.php');
require_once('plugins/message.class.php');
//$obj_user = new user();
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));
$obj_equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$obj_customer = new customer_ai();
$messages = new message();

if($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 6){
    header('location: ' . $smarty->url.'reports/');
    exit();
}

$search_data = NULL;
$transaction_flag = TRUE;
$available_users_count = 0;
$result = array();
if(isset($_POST["go"]) && $_POST["go"] != ""){
    $search_data   = trim($_POST['search_data']) != '' ? trim($_POST['search_data']) : NULL;

    if($search_data == ''){
        $messages->set_message('fail', 'search_content_should_not_be_empty');
        $transaction_flag = FALSE;
    }
    
    if($transaction_flag){
        $smarty->assign("is_generate", TRUE);
        
		$customer_data = $obj_customer->get_customers_for_search();
		// echo '<pre>'.print_r($customer_data, 1).'</pre>'; exit();
		$columns = array();
		$result = search_value($search_data, $customer_data, $columns);
		// echo '<pre>'.print_r($columns, 1).'</pre>';
		// echo '<pre>'.print_r($result, 1).'</pre>'; exit();

        $available_users_count = count($result);
        $smarty->assign("columns", $columns);
        $smarty->assign("max_columns", count($columns));
    }
    
}


// $column_heading_convert_from_label = array('cc_username', 'cc_code', 'cc_first_name', 'cc_last_name');
// $column_heading_convert_to_label = array();
/*$string = 'blah blarh bleh bleh blarh';
$trans = array("blah" => "blerh", "bleh" => "blerh");
$result = strtr($string,$trans);*/


$smarty->assign("search_data", $search_data);
$smarty->assign("result", $result);
$smarty->assign("available_users_count", $available_users_count);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('message', $messages->show_message());

$smarty->display('extends:layouts/dashboard.tpl|rpt_customer_search.tpl');

function search_value($val, $datas, &$columns){
	$table_summary = array(
		'cc' => array('table_name' => 'customer', 'multi_rows' => FALSE),
		'cg' => array('table_name' => 'customer_guardian', 'multi_rows' => FALSE),
		'cr' => array('table_name' => 'customer_relative', 'multi_rows' => TRUE),
		'ch' => array('table_name' => 'customer_health', 'multi_rows' => FALSE)
	);
	// $table_summary = array(
	// 	'customer' => 'cc',
	// 	'customer_guardian' => 'cg',
	// 	'customer_relative' => 'cr',
	// 	'customer_health' => 'ch'
	// );
	$search_result = array();
	$i=0;
	foreach ($datas as $data){

		// $names = array_column($data, 'cr');
		// echo "array_column<pre>".print_r($names,1)."</pre>";

		$pattern = "/".$val."/i";
		$matches = preg_grep($pattern, $data);
		// if(!empty($matches)){
		// 	echo "<pre>".print_r($matches,1)."</pre>";
		// }
		$tmp_search_result = array();
		$tmp_match_indexes = array();
		$k = 0;
		foreach($matches as $filed_name => $match_value){
			// if($table_name = array_search(substr($filed_name, 0,2), $table_summary)){
			if($table_name = (isset($table_summary[substr($filed_name, 0,2)]) ? $table_summary[substr($filed_name, 0,2)]['table_name'] : NULL)){
				// echo $table_name.'<br>';
				$tmp_search_result[] = array(
					'field' => $filed_name, 
					'field_value' => $match_value, 
					'table' => $table_name);


				if(!in_array($filed_name, $columns)) $columns[] = $filed_name;
				$tmp_match_indexes[$filed_name] = $k;
				$k++;
			}
		}

		$search_result_ = array();
		foreach($table_summary as $tsKey => $ts){
			if($ts['multi_rows'] && isset($data[$tsKey]) && !empty($data[$tsKey])){
				// $search_result__ = array();
				foreach($data[$tsKey] as $multi_data){
					$matches_ = preg_grep($pattern, $multi_data);
					$tmp_search_result_ = array();
					$tmp_match_indexes_ = array();
					$k_ = 0;
					// echo 'matches_<pre>'.print_r($matches_, 1).'</pre>';
					foreach($matches_ as $filed_name_ => $match_value_){
						if($table_name_ = (isset($table_summary[substr($filed_name_, 0,2)]) ? $table_summary[substr($filed_name_, 0,2)]['table_name'] : NULL)){
							// echo $table_name_.'<br>';
							$tmp_search_result_[] = array(
								'field' => $filed_name_, 
								'field_value' => $match_value_, 
								'table' => $table_name_);


							if(!in_array($filed_name_, $columns)) $columns[] = $filed_name_;
							$tmp_match_indexes_[$filed_name_] = $k_;
							$k_++;
						}
					}
					if(!empty($tmp_search_result_)) {
						$search_result_[] = array(  
							'table_alias' 	=> $tsKey, 
							'match_content' => $tmp_search_result_,
							'match_indexes' => $tmp_match_indexes_);
					}
					// echo 'matches_<pre>'.print_r($search_result__, 1).'</pre>';
				}
				// if(!empty($search_result__))
				// 	$search_result_[] = $search_result__;
			}
		}

		if(!empty($tmp_search_result) || !empty($search_result_)) {
			$search_result[] = array( 
				'id' => $i, 
				'name' => $_SESSION['company_sort_by'] == 1 ? $data['cc_first_name'].' '.$data['cc_last_name'] : $data['cc_last_name'].' '.$data['cc_first_name'], 
				'mobile' => format_mobile($data['cc_mobile']),
				'match_content' => $tmp_search_result,
				'match_indexes' => $tmp_match_indexes,
				'match_multirows' => $search_result_
				);

			// if(count($tmp_search_result) > $max_columns) 
			// 	$max_columns = count($tmp_search_result);
		}

		$i++;	
	}
	$search_result = array_values($search_result);
	return $search_result;
}

function format_mobile($mobile){
	$formated_mobile = NULL;
	if ($mobile != "") {
        $length_mobile_display = (strlen($mobile) - 5) / 2;
        $temp_mobile = '';
        $pos = 5;
        for ($j = 0; $j < $length_mobile_display; $j++) {
            $temp_mobile = $temp_mobile . " " . substr($mobile, $pos, 2);
            $pos = $pos + 2;
        }
        $formated_mobile = "+46" . substr($mobile, 0, 3) . " " . substr($mobile, 3, 2) . " " . $temp_mobile;
    }
    return $formated_mobile;
}
?>