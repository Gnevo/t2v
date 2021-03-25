<?php
	// System magic.
    	require_once('class/setup.php');
    	require_once('class/inconvenient_timing.php');
        require_once('class/employee.php');
        require_once('class/customer.php');
        require_once ('plugins/message.class.php');
        require_once ('class/company.php');
        $obj_msg = new message();
	$smarty = new smartySetup(array('export-config.xml', 'export.xml'));
        $obj_emp = new employee();
        $obj_cust = new customer();
        $salary_code = $obj_cust->get_salary_code($_SESSION['company_id']);
        $flag_monthly_salary = $obj_emp->check_monthly_salary();
        $obj_company = new company();
	// We want to know what's going on.
//	error_reporting(E_ALL);
//	ini_set('display_errors',true);
        
        $smarty->assign('message',' ');
	global $db;
	if($_SESSION['db_name']){
		$db['database'] = $_SESSION['db_name'];
	}
    
    $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
	$sql = new PDO($db['driver'] . ':host=' . $db['host'] . ';dbname=' . $db['database'],$db['username'],$db['password']);
	$sql->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	$sql->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        //echo "<pre>\n".print_r($_POST['config'] , 1)."</pre>";
	if (array_key_exists('config',$_POST)) {
        
        if($company_details['fkkn_split'] == 1){
            
    		$insert = $sql->prepare("REPLACE INTO export_lon_config (internal, vacation_saving, vacation_saving_fk, vacation_saving_kn, vacation_saving_tu, vacation_paid, vacation_paid_fk, vacation_paid_kn, vacation_paid_tu, monthly, monthly_fk, monthly_kn, monthly_tu, monthly_office, monthly_office_fk, monthly_office_kn, monthly_office_tu, monthly_office_hour, monthly_office_hour_fk, monthly_office_hour_kn, monthly_office_hour_tu, no_name, no_name_fk, no_name_kn, no_name_tu) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    		$delete = $sql->prepare("DELETE FROM export_lon_config WHERE internal=?");
            foreach ($_POST['config'] as $id => $entry)
            {
                if (trim($entry['external_vacation_saving']) != '' || trim($entry['external_vacation_saving_fk']) != '' || trim($entry['external_vacation_saving_kn']) != '' || trim($entry['external_vacation_saving_tu']) != '' || trim($entry['external_vacation_paid']) != '' || trim($entry['external_vacation_paid_fk']) != '' || trim($entry['external_vacation_paid_kn']) != '' || trim($entry['external_vacation_paid_tu']) != '' || trim($entry['external_monthly']) != ''  || trim($entry['external_monthly_fk']) != ''  || trim($entry['external_monthly_kn']) != ''  || trim($entry['external_monthly_tu']) != '' || trim($entry['external_monthly_office']) != '' || trim($entry['external_monthly_office_fk']) != '' || trim($entry['external_monthly_office_kn']) != '' || trim($entry['external_monthly_office_tu']) != '' || trim($entry['external_monthly_office_hour']) != '' || trim($entry['external_monthly_office_hour_fk']) != '' || trim($entry['external_monthly_office_hour_kn']) != '' || trim($entry['external_monthly_office_hour_tu']) != '' || trim($entry['no_name']) != '' || trim($entry['no_name_fk']) != '' || trim($entry['no_name_kn']) != '' || trim($entry['no_name_tu']) != '') {
                        if($entry['external_vacation_saving'] == ""){
                            $entry['external_vacation_saving'] = NULL;
                        }
                        if(!isset($entry['external_vacation_saving_fk']) || $entry['external_vacation_saving_fk'] == ""){
                            $entry['external_vacation_saving_fk'] = NULL;
                        }
                        if(!isset($entry['external_vacation_saving_kn']) || $entry['external_vacation_saving_kn'] == ""){
                            $entry['external_vacation_saving_kn'] = NULL;
                        }
                        if(!isset($entry['external_vacation_saving_tu']) || $entry['external_vacation_saving_tu'] == ""){
                            $entry['external_vacation_saving_tu'] = NULL;
                        }
                        if(!isset($entry['external_vacation_paid']) || $entry['external_vacation_paid'] == ""){
                            $entry['external_vacation_paid'] = NULL;
                        }
                        if(!isset($entry['external_vacation_paid_fk']) || $entry['external_vacation_paid_fk'] == ""){
                            $entry['external_vacation_paid_fk'] = NULL;
                        }
                        if(!isset($entry['external_vacation_paid_kn']) || $entry['external_vacation_paid_kn'] == ""){
                            $entry['external_vacation_paid_kn'] = NULL;
                        }
                        if(!isset($entry['external_vacation_paid_tu']) || $entry['external_vacation_paid_tu'] == ""){
                            $entry['external_vacation_paid_tu'] = NULL;
                        }
                        if(!isset($entry['external_monthly']) || $entry['external_monthly'] == ""){
                            $entry['external_monthly'] = NULL;
                        }
                        if(!isset($entry['external_monthly_fk']) || $entry['external_monthly_fk'] == ""){
                            $entry['external_monthly_fk'] = NULL;
                        }
                        if(!isset($entry['external_monthly_kn']) || $entry['external_monthly_kn'] == ""){
                            $entry['external_monthly_kn'] = NULL;
                        }
                        if(!isset($entry['external_monthly_tu']) || $entry['external_monthly_tu'] == ""){
                            $entry['external_monthly_tu'] = NULL;
                        }
                        if(!isset($entry['external_monthly_office']) ||  $entry['external_monthly_office'] == ""){
                            $entry['external_monthly_office'] = NULL;
                        }
                        if(!isset($entry['external_monthly_office_fk']) ||  $entry['external_monthly_office_fk'] == ""){
                            $entry['external_monthly_office_fk'] = NULL;
                        }
                        if(!isset($entry['external_monthly_office_kn']) ||  $entry['external_monthly_office_kn'] == ""){
                            $entry['external_monthly_office_kn'] = NULL;
                        }
                        if(!isset($entry['external_monthly_office_tu']) ||  $entry['external_monthly_office_tu'] == ""){
                            $entry['external_monthly_office_tu'] = NULL;
                        }
                        if(!isset($entry['external_monthly_office_hour']) ||  $entry['external_monthly_office_hour'] == ""){
                            $entry['external_monthly_office_hour'] = NULL;
                        }
                        if(!isset($entry['external_monthly_office_hour_fk']) ||  $entry['external_monthly_office_hour_fk'] == ""){
                            $entry['external_monthly_office_hour_fk'] = NULL;
                        }
                        if(!isset($entry['external_monthly_office_hour_kn']) ||  $entry['external_monthly_office_hour_kn'] == ""){
                            $entry['external_monthly_office_hour_kn'] = NULL;
                        }
                        if(!isset($entry['external_monthly_office_hour_tu']) ||  $entry['external_monthly_office_hour_tu'] == ""){
                            $entry['external_monthly_office_hour_tu'] = NULL;
                        }
                        if(!isset($entry['no_name']) ||  $entry['no_name'] == ""){
                            $entry['no_name'] = NULL;
                        }
                        if(!isset($entry['no_name_fk']) ||  $entry['no_name_fk'] == ""){
                            $entry['no_name_fk'] = NULL;
                        }
                        if(!isset($entry['no_name_kn']) ||  $entry['no_name_kn'] == ""){
                            $entry['no_name_kn'] = NULL;
                        }
                        if(!isset($entry['no_name_tu']) ||  $entry['no_name_tu'] == ""){
                            $entry['no_name_tu'] = NULL;
                        }
                        $insert->execute(array($id, $entry['external_vacation_saving'], $entry['external_vacation_saving_fk'], $entry['external_vacation_saving_kn'], $entry['external_vacation_saving_tu'], $entry['external_vacation_paid'], $entry['external_vacation_paid_fk'], $entry['external_vacation_paid_kn'], $entry['external_vacation_paid_tu'], $entry['external_monthly'], $entry['external_monthly_fk'], $entry['external_monthly_kn'], $entry['external_monthly_tu'], $entry['external_monthly_office'], $entry['external_monthly_office_fk'], $entry['external_monthly_office_kn'], $entry['external_monthly_office_tu'], $entry['external_monthly_office_hour'], $entry['external_monthly_office_hour_fk'], $entry['external_monthly_office_hour_kn'], $entry['external_monthly_office_hour_tu'],$entry['no_name'],$entry['no_name_fk'],$entry['no_name_kn'],$entry['no_name_tu']));
                }else{
                    $delete->execute(array($id));
                } 
            }
        }else{
            
            $insert = $sql->prepare("REPLACE INTO export_lon_config (internal, vacation_saving, vacation_paid, monthly, monthly_office, monthly_office_hour, no_name) VALUES (?,?,?,?,?,?,?)");
            $delete = $sql->prepare("DELETE FROM export_lon_config WHERE internal=?");
            foreach ($_POST['config'] as $id => $entry)
            {
                if (trim($entry['external_vacation_saving']) != '' || trim($entry['external_vacation_paid']) != '' || trim($entry['external_monthly']) != ''  || trim($entry['external_monthly_office']) != '' || trim($entry['external_monthly_office_hour']) != ''  || trim($entry['no_name']) != '' ) {

                        if($entry['external_vacation_saving'] == ""){
                            $entry['external_vacation_saving'] = NULL;
                        }
                        if(!isset($entry['external_vacation_paid']) || $entry['external_vacation_paid'] == ""){
                            $entry['external_vacation_paid'] = NULL;
                        }
                        if(!isset($entry['external_monthly']) || $entry['external_monthly'] == ""){
                            $entry['external_monthly'] = NULL;
                        }
                        if(!isset($entry['external_monthly_office']) ||  $entry['external_monthly_office'] == ""){
                            $entry['external_monthly_office'] = NULL;
                        }
                        if(!isset($entry['external_monthly_office_hour']) ||  $entry['external_monthly_office_hour'] == ""){
                            $entry['external_monthly_office_hour'] = NULL;
                        }
                        if(!isset($entry['no_name']) ||  $entry['no_name'] == ""){
                            $entry['no_name'] = NULL;
                        }
                        //echo "sas".$id;
                        $insert->execute(array($id, $entry['external_vacation_saving'], $entry['external_vacation_paid'], $entry['external_monthly'], $entry['external_monthly_office'], $entry['external_monthly_office_hour'], $entry['no_name']));
                } else{
                    $delete->execute(array($id));
                } 
            }
        }
            $obj_msg->set_message('success', 'salary_codes_saved');
            $smarty->assign('message',$obj_msg->show_message());
	}

	$out = array();

	/*
	// internal ones
	foreach ($sql->query("SELECT * FROM inconvenient_timing") as $entry)
	{
		$out[$entry['id']]['internal_title'] = $entry['name'];
		$out[$entry['id']]['internal_root_id'] = $entry['root_id'];
		$out[$entry['id']]['external'] = '';
	}
	 */

	// internal ones - get the data
	$inc_timing = new inconvenient_timing();
//	$list = $inc_timing->inconvenient_timing_list();
	$list = $inc_timing->inconvenient_timing_list_copy();
	$holi_list = $inc_timing->holiday_timing_list();
        
	if (!empty($holi_list)) {
	    
	    for ($i = 0; $i < count($holi_list); $i++) {   // this loop is used to find year of upperlimit of 'days' field in the table
			if((int) $holi_list[$i]['year_to'])	        
			{
	        	$holi_list[$i]['name'] .= ' - '.$holi_list[$i]['year_to'];
				//unset($holi_list[$i]);
				//continue;
			}

			/*
	        $count = $inc_timing->holidays_count($holi_list[$i]['id']);
	        $start = strtotime(date('Y') . '-' . $holi_list[$i]['date_from']);
	        $holi_list[$i]['calc_year_to'] = date('Y', strtotime("+$count[0] day", $start));
	        */
	    }
	}
	// internal ones - small process
    //echo "<pre>\n".print_r($list, 1)."</pre>";exit();
	foreach($list as $key=>$entry)
	{
        $tmp_name = $entry['name'];                
		$out[$entry['group_id']]['internal_title'] = $entry['name'];
        $out[$entry['group_id']]['external_vacation_saving'] = '';
        $out[$entry['group_id']]['external_vacation_saving_fk'] = '';
        $out[$entry['group_id']]['external_vacation_saving_kn'] = '';
		$out[$entry['group_id']]['external_vacation_saving_tu'] = '';
        $out[$entry['group_id']]['external_vacation_paid'] = '';
        $out[$entry['group_id']]['external_vacation_paid_fk'] = '';
        $out[$entry['group_id']]['external_vacation_paid_kn'] = '';
        $out[$entry['group_id']]['external_vacation_paid_tu'] = '';
        $out[$entry['group_id']]['external_monthly'] = '';
        $out[$entry['group_id']]['external_monthly_fk'] = '';
        $out[$entry['group_id']]['external_monthly_kn'] = '';
		$out[$entry['group_id']]['external_monthly_tu'] = '';
        $out[$entry['group_id']]['external_monthly_office'] = '';
        $out[$entry['group_id']]['external_monthly_office_fk'] = '';
        $out[$entry['group_id']]['external_monthly_office_kn'] = '';
		$out[$entry['group_id']]['external_monthly_office_tu'] = '';
        $out[$entry['group_id']]['external_monthly_office_hour'] = '';
        $out[$entry['group_id']]['external_monthly_office_hour_fk'] = '';
        $out[$entry['group_id']]['external_monthly_office_hour_kn'] = '';
		$out[$entry['group_id']]['external_monthly_office_hour_tu'] = '';
        $out[$entry['group_id']]['no_name'] = '';
        $out[$entry['group_id']]['no_name_fk'] = '';
        $out[$entry['group_id']]['no_name_kn'] = '';
        $out[$entry['group_id']]['no_name_tu'] = '';
                
                $out[$entry['group_id'].'.1']['internal_title'] = $entry['name'].' intro';
                $out[$entry['group_id'].'.1']['external_vacation_saving'] = '';
                $out[$entry['group_id'].'.1']['external_vacation_saving_fk'] = '';
                $out[$entry['group_id'].'.1']['external_vacation_saving_kn'] = '';
                $out[$entry['group_id'].'.1']['external_vacation_saving_tu'] = '';
                $out[$entry['group_id'].'.1']['external_vacation_paid'] = '';
                $out[$entry['group_id'].'.1']['external_vacation_paid_fk'] = '';
                $out[$entry['group_id'].'.1']['external_vacation_paid_kn'] = '';
                $out[$entry['group_id'].'.1']['external_vacation_paid_tu'] = '';
                $out[$entry['group_id'].'.1']['external_monthly'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_fk'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_kn'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_tu'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_office'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_office_fk'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_office_kn'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_office_tu'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_office_hour'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_office_hour_fk'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_office_hour_kn'] = '';
                $out[$entry['group_id'].'.1']['external_monthly_office_hour_tu'] = '';
                $out[$entry['group_id'].'.1']['no_name'] = '';
                $out[$entry['group_id'].'.1']['no_name_fk'] = '';
                $out[$entry['group_id'].'.1']['no_name_kn'] = '';
                $out[$entry['group_id'].'.1']['no_name_tu'] = '';
                
                $out[$entry['group_id'].'.2']['internal_title'] = $entry['name'].' komp';
                $out[$entry['group_id'].'.2']['external_vacation_saving'] = '';
                $out[$entry['group_id'].'.2']['external_vacation_saving_fk'] = '';
                $out[$entry['group_id'].'.2']['external_vacation_saving_kn'] = '';
                $out[$entry['group_id'].'.2']['external_vacation_saving_tu'] = '';
                $out[$entry['group_id'].'.2']['external_vacation_paid'] = '';
                $out[$entry['group_id'].'.2']['external_vacation_paid_fk'] = '';
                $out[$entry['group_id'].'.2']['external_vacation_paid_kn'] = '';
                $out[$entry['group_id'].'.2']['external_vacation_paid_tu'] = '';
                $out[$entry['group_id'].'.2']['external_monthly'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_fk'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_kn'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_tu'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_office'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_office_fk'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_office_kn'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_office_tu'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_office_hour'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_office_hour_fk'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_office_hour_kn'] = '';
                $out[$entry['group_id'].'.2']['external_monthly_office_hour_tu'] = '';
                $out[$entry['group_id'].'.2']['no_name'] = '';
                $out[$entry['group_id'].'.2']['no_name_fk'] = '';
                $out[$entry['group_id'].'.2']['no_name_kn'] = '';
                $out[$entry['group_id'].'.2']['no_name_tu'] = '';
                if($entry['type'] == 3){
                    $out[$entry['group_id'].'.3']['internal_title'] = $entry['name'].' mertid';
                    $out[$entry['group_id'].'.3']['external_vacation_saving'] = '';
                    $out[$entry['group_id'].'.3']['external_vacation_saving_fk'] = '';
                    $out[$entry['group_id'].'.3']['external_vacation_saving_kn'] = '';
                    $out[$entry['group_id'].'.3']['external_vacation_saving_tu'] = '';
                    $out[$entry['group_id'].'.3']['external_vacation_paid'] = '';
                    $out[$entry['group_id'].'.3']['external_vacation_paid_fk'] = '';
                    $out[$entry['group_id'].'.3']['external_vacation_paid_kn'] = '';
                    $out[$entry['group_id'].'.3']['external_vacation_paid_tu'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_fk'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_kn'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_tu'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_office'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_office_fk'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_office_kn'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_office_tu'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_office_hour'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_office_hour_fk'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_office_hour_kn'] = '';
                    $out[$entry['group_id'].'.3']['external_monthly_office_hour_tu'] = '';
                    $out[$entry['group_id'].'.3']['no_name'] = '';
                    $out[$entry['group_id'].'.3']['no_name_fk'] = '';
                    $out[$entry['group_id'].'.3']['no_name_kn'] = '';
                    $out[$entry['group_id'].'.3']['no_name_tu'] = '';
                }
                $out[$entry['group_id'].'.4']['internal_title'] = $entry['name'].' '.$smarty->translate['lc_label_3015'];
                $out[$entry['group_id'].'.4']['external_vacation_saving'] = '';
                $out[$entry['group_id'].'.4']['external_vacation_saving_fk'] = '';
                $out[$entry['group_id'].'.4']['external_vacation_saving_kn'] = '';
                $out[$entry['group_id'].'.4']['external_vacation_saving_tu'] = '';
                $out[$entry['group_id'].'.4']['external_vacation_paid'] = '';
                $out[$entry['group_id'].'.4']['external_vacation_paid_fk'] = '';
                $out[$entry['group_id'].'.4']['external_vacation_paid_kn'] = '';
                $out[$entry['group_id'].'.4']['external_vacation_paid_tu'] = '';
                $out[$entry['group_id'].'.4']['external_monthly'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_fk'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_kn'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_tu'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_office'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_office_fk'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_office_kn'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_office_tu'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_office_hour'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_office_hour_fk'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_office_hour_kn'] = '';
                $out[$entry['group_id'].'.4']['external_monthly_office_hour_tu'] = '';
                $out[$entry['group_id'].'.4']['no_name'] = '';
                $out[$entry['group_id'].'.4']['no_name_fk'] = '';
                $out[$entry['group_id'].'.4']['no_name_kn'] = '';
                $out[$entry['group_id'].'.4']['no_name_tu'] = '';

		// update the key from array
		
		unset($list[$key]);
		$list['id_'.$entry['group_id']] = $entry;
                $group_id_temp = $entry['group_id'];
                
                $entry['group_id'] = $group_id_temp . '.1';
                $entry['name'] = $tmp_name.' intro';
                $list['id_'.$entry['group_id']] = $entry;
                
                $entry['group_id'] = $group_id_temp . '.2';
                $entry['name'] = $tmp_name.' komp';
                $list['id_'.$entry['group_id']] = $entry;
                
                if($entry['type'] == 3){
                    $entry['group_id'] = $group_id_temp . '.3';
                    $entry['name'] = $tmp_name.' mertid';
                    $list['id_'.$entry['group_id']] = $entry;
                }

                $entry['group_id'] = $group_id_temp . '.4';
                $entry['name'] = $tmp_name.' '.$smarty->translate['lc_label_3015'];
                $list['id_'.$entry['group_id']] = $entry;
                
	}
	asort($holi_list);
        //echo "<pre>\n".print_r($holi_list, 1)."</pre>";exit();
	foreach($holi_list as $entryTmp)
	{
		$out['1000'.'.'.(1000+$entryTmp['group_id'])]['internal_title'] = 'Jour '.$entryTmp['name'];
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_saving'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_saving_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_saving_kn'] = '';
		$out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_saving_tu'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_paid'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_paid_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_paid_kn'] = '';
		$out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_paid_tu'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_kn'] = '';
		$out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_tu'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_kn'] = '';
		$out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_tu'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour_kn'] = '';
		$out['1000'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour_tu'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['no_name'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['no_name_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['no_name_kn'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id'])]['no_name_tu'] = '';


        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['internal_title'] = 'Jour '.$entryTmp['name'].' '.$smarty->translate['red_day'];
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving_kn'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving_tu'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid_kn'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid_tu'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_kn'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_tu'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_kn'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_tu'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour_kn'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour_tu'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['no_name'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['no_name_fk'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['no_name_kn'] = '';
        $out['1000'.'.'.(1000+$entryTmp['group_id']).'.1']['no_name_tu'] = '';
	}
	foreach($holi_list as $key=>$entry)
	{
		$out[1000+$entry['group_id']]['internal_title'] = $entry['name'];
        $out[1000+$entry['group_id']]['external_vacation_saving'] = '';
        $out[1000+$entry['group_id']]['external_vacation_saving_fk'] = '';
        $out[1000+$entry['group_id']]['external_vacation_saving_kn'] = '';
		$out[1000+$entry['group_id']]['external_vacation_saving_tu'] = '';
        $out[1000+$entry['group_id']]['external_vacation_paid'] = '';
        $out[1000+$entry['group_id']]['external_vacation_paid_fk'] = '';
        $out[1000+$entry['group_id']]['external_vacation_paid_kn'] = '';
		$out[1000+$entry['group_id']]['external_vacation_paid_tu'] = '';
        $out[1000+$entry['group_id']]['external_monthly'] = '';
        $out[1000+$entry['group_id']]['external_monthly_fk'] = '';
        $out[1000+$entry['group_id']]['external_monthly_kn'] = '';
		$out[1000+$entry['group_id']]['external_monthly_tu'] = '';
        $out[1000+$entry['group_id']]['external_monthly_office'] = '';
        $out[1000+$entry['group_id']]['external_monthly_office_fk'] = '';
        $out[1000+$entry['group_id']]['external_monthly_office_kn'] = '';
		$out[1000+$entry['group_id']]['external_monthly_office_tu'] = '';
        $out[1000+$entry['group_id']]['external_monthly_office_hour'] = '';
        $out[1000+$entry['group_id']]['external_monthly_office_hour_fk'] = '';
        $out[1000+$entry['group_id']]['external_monthly_office_hour_kn'] = '';
		$out[1000+$entry['group_id']]['external_monthly_office_hour_tu'] = '';
        $out[1000+$entry['group_id']]['no_name'] = '';
        $out[1000+$entry['group_id']]['no_name_fk'] = '';
        $out[1000+$entry['group_id']]['no_name_kn'] = '';
        $out[1000+$entry['group_id']]['no_name_tu'] = '';


        $out[(1000+$entry['group_id']).'.1']['internal_title'] = $entry['name'].' '.$smarty->translate['red_day'];
        $out[(1000+$entry['group_id']).'.1']['external_vacation_saving'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_vacation_saving_fk'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_vacation_saving_kn'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_vacation_saving_tu'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_vacation_paid'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_vacation_paid_fk'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_vacation_paid_kn'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_vacation_paid_tu'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_fk'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_kn'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_tu'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_office'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_office_fk'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_office_kn'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_office_tu'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_office_hour'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_office_hour_fk'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_office_hour_kn'] = '';
        $out[(1000+$entry['group_id']).'.1']['external_monthly_office_hour_tu'] = '';
        $out[(1000+$entry['group_id']).'.1']['no_name'] = '';
        $out[(1000+$entry['group_id']).'.1']['no_name_fk'] = '';
        $out[(1000+$entry['group_id']).'.1']['no_name_kn'] = '';
        $out[(1000+$entry['group_id']).'.1']['no_name_tu'] = '';

		// update the key from array
		unset($holi_list[$key]);
		$holi_list['id_'.(1000+$entry['group_id'])] = $entry;
	}

        
//echo "<pre>\n".print_r($list, 1)."</pre>";
	// karens
	$out[2000] = array(
            'internal_title' => $smarty->translate['lc_label_2000'], 
            'external_vacation_saving' => '', 
            'external_vacation_saving_fk' => '', 
            'external_vacation_saving_kn' => '', 
            'external_vacation_saving_tu' => '', 
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
	foreach($smarty->leave_type as $key => $entry)
	{
                
        if($key == 10 || $key == 11)
            continue;
            
		$out[2000+$key]['internal_title'] = $key == 1 ? $smarty->translate['lc_label_2001']: $entry;  ///$entry; before
        $out[2000+$key]['external_vacation_saving'] = '';
        $out[2000+$key]['external_vacation_saving_fk'] = '';
        $out[2000+$key]['external_vacation_saving_kn'] = '';
		$out[2000+$key]['external_vacation_saving_tu'] = '';
        $out[2000+$key]['external_vacation_paid'] = '';
        $out[2000+$key]['external_vacation_paid_fk'] = '';
        $out[2000+$key]['external_vacation_paid_kn'] = '';
		$out[2000+$key]['external_vacation_paid_tu'] = '';
        $out[2000+$key]['external_monthly'] = '';
        $out[2000+$key]['external_monthly_fk'] = '';
        $out[2000+$key]['external_monthly_kn'] = '';
		$out[2000+$key]['external_monthly_tu'] = '';
        $out[2000+$key]['external_monthly_office'] = '';
        $out[2000+$key]['external_monthly_office_fk'] = '';
        $out[2000+$key]['external_monthly_office_kn'] = '';
        $out[2000+$key]['external_monthly_office_tu'] = '';
        $out[2000+$key]['external_monthly_office_hour'] = '';
        $out[2000+$key]['external_monthly_office_hour_fk'] = '';
        $out[2000+$key]['external_monthly_office_hour_kn'] = '';
        $out[2000+$key]['external_monthly_office_hour_tu'] = '';
        $out[2000+$key]['no_name'] = '';
        $out[2000+$key]['no_name_fk'] = '';
        $out[2000+$key]['no_name_kn'] = '';
        $out[2000+$key]['no_name_tu'] = '';

		// add the sick combinations
		if($key==1)
		{
			$out['2001.0']['internal_title'] = $smarty->translate['lc_label_2001.0'];
            $out['2001.0']['external_vacation_saving'] = '';
            $out['2001.0']['external_vacation_saving_fk'] = '';
            $out['2001.0']['external_vacation_saving_kn'] = '';
			$out['2001.0']['external_vacation_saving_tu'] = '';
            $out['2001.0']['external_vacation_paid'] = '';
            $out['2001.0']['external_vacation_paid_fk'] = '';
            $out['2001.0']['external_vacation_paid_kn'] = '';
			$out['2001.0']['external_vacation_paid_tu'] = '';
            $out['2001.0']['external_monthly'] = '';
            $out['2001.0']['external_monthly_fk'] = '';
            $out['2001.0']['external_monthly_kn'] = '';
			$out['2001.0']['external_monthly_tu'] = '';
            $out['2001.0']['external_monthly_office'] = '';
            $out['2001.0']['external_monthly_office_fk'] = '';
            $out['2001.0']['external_monthly_office_kn'] = '';
			$out['2001.0']['external_monthly_office_tu'] = '';
            $out['2001.0']['external_monthly_office_hour'] = '';
            $out['2001.0']['external_monthly_office_hour_fk'] = '';
            $out['2001.0']['external_monthly_office_hour_kn'] = '';
			$out['2001.0']['no_name'] = '';
            $out['2001.0']['no_name_fk'] = '';
            $out['2001.0']['no_name_kn'] = '';
            $out['2001.0']['no_name_tu'] = '';

            if($company_details['sick_15_90_oncall']){
                $out['2001.0.1']['internal_title'] = $smarty->translate['lc_label_2001.0.1'];
                $out['2001.0.1']['external_vacation_saving'] = '';
                $out['2001.0.1']['external_vacation_saving_fk'] = '';
                $out['2001.0.1']['external_vacation_saving_kn'] = '';
                $out['2001.0.1']['external_vacation_saving_tu'] = '';
                $out['2001.0.1']['external_vacation_paid'] = '';
                $out['2001.0.1']['external_vacation_paid_fk'] = '';
                $out['2001.0.1']['external_vacation_paid_kn'] = '';
                $out['2001.0.1']['external_vacation_paid_tu'] = '';
                $out['2001.0.1']['external_monthly'] = '';
                $out['2001.0.1']['external_monthly_fk'] = '';
                $out['2001.0.1']['external_monthly_kn'] = '';
                $out['2001.0.1']['external_monthly_tu'] = '';
                $out['2001.0.1']['external_monthly_office'] = '';
                $out['2001.0.1']['external_monthly_office_fk'] = '';
                $out['2001.0.1']['external_monthly_office_kn'] = '';
                $out['2001.0.1']['external_monthly_office_tu'] = '';
                $out['2001.0.1']['external_monthly_office_hour'] = '';
                $out['2001.0.1']['external_monthly_office_hour_fk'] = '';
                $out['2001.0.1']['external_monthly_office_hour_kn'] = '';
                $out['2001.0.1']['external_monthly_office_hour_tu'] = '';
                $out['2001.0.1']['no_name'] = '';
                $out['2001.0.1']['no_name_fk'] = '';
                $out['2001.0.1']['no_name_kn'] = '';
                $out['2001.0.1']['no_name_tu'] = '';
            }

            $out['2001.0.2']['internal_title'] = $smarty->translate['lc_label_2001.0.2'];
            $out['2001.0.2']['external_vacation_saving'] = '';
            $out['2001.0.2']['external_vacation_saving_fk'] = '';
            $out['2001.0.2']['external_vacation_saving_kn'] = '';
            $out['2001.0.2']['external_vacation_saving_tu'] = '';
            $out['2001.0.2']['external_vacation_paid'] = '';
            $out['2001.0.2']['external_vacation_paid_fk'] = '';
            $out['2001.0.2']['external_vacation_paid_kn'] = '';
            $out['2001.0.2']['external_vacation_paid_tu'] = '';
            $out['2001.0.2']['external_monthly'] = '';
            $out['2001.0.2']['external_monthly_fk'] = '';
            $out['2001.0.2']['external_monthly_kn'] = '';
            $out['2001.0.2']['external_monthly_tu'] = '';
            $out['2001.0.2']['external_monthly_office'] = '';
            $out['2001.0.2']['external_monthly_office_fk'] = '';
            $out['2001.0.2']['external_monthly_office_kn'] = '';
            $out['2001.0.2']['external_monthly_office_tu'] = '';
            $out['2001.0.2']['external_monthly_office_hour'] = '';
            $out['2001.0.2']['external_monthly_office_hour_fk'] = '';
            $out['2001.0.2']['external_monthly_office_hour_kn'] = '';
            $out['2001.0.2']['external_monthly_office_hour_tu'] = '';
            $out['2001.0.2']['no_name'] = '';
            $out['2001.0.2']['no_name_fk'] = '';
            $out['2001.0.2']['no_name_kn'] = '';
            $out['2001.0.2']['no_name_tu'] = '';

          
			foreach($list as $entryTmp)
			{    
                                //echo $entryTmp['name']."<bre>";
                                //if(!preg_match('/komp/',$entryTmp['name']) && !preg_match('/'.$translate['lc_label_3015'].'/',$entryTmp['name'])){
                                    if(strpos($entryTmp['group_id'], '.') === false){
                                    $out['2001'.'.'.$entryTmp['group_id']]['internal_title'] = $entry.' '.$entryTmp['name'].$smarty->translate['lc_label_2_14_gen'];
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_vacation_saving'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_vacation_saving_fk'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_vacation_saving_kn'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_vacation_saving_tu'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_vacation_paid'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_vacation_paid_fk'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_vacation_paid_kn'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_vacation_paid_tu'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_fk'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_kn'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_tu'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_office'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_office_fk'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_office_kn'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_office_tu'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['no_name'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['no_name_fk'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['no_name_kn'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['no_name_tu'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_office_hour'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_office_hour_fk'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_office_hour_kn'] = '';
                                    $out['2001'.'.'.$entryTmp['group_id']]['external_monthly_office_hour_tu'] = '';
                                }
			}
            
            foreach($holi_list as $entryTmp)
			{
				$out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['internal_title'] = $entry.' Jour '.$entryTmp['name'].$smarty->translate['lc_label_2_14_gen'];
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_vacation_saving'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_vacation_saving_fk'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_vacation_saving_kn'] = '';
				$out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_vacation_saving_tu'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_vacation_paid'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_vacation_paid_fk'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_vacation_paid_kn'] = '';
				$out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_vacation_paid_tu'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_fk'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_kn'] = '';
				$out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_tu'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_office'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_office_fk'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_office_kn'] = '';
				$out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_office_tu'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour_fk'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour_kn'] = '';
				$out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour_tu'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['no_name'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['no_name_fk'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['no_name_kn'] = '';
                $out['2001'.'.1000.'.(1000+$entryTmp['group_id'])]['no_name_tu'] = '';

                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['internal_title'] = $entry.' Jour '.$entryTmp['name'].$smarty->translate['lc_label_2_14_gen'].' '.$smarty->translate['red_day'];
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving_fk'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving_kn'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving_tu'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid_fk'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid_kn'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid_tu'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_fk'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_kn'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_tu'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_fk'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_kn'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_tu'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour_fk'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour_kn'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour_tu'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['no_name'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['no_name_fk'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['no_name_kn'] = '';
                    $out['2001'.'.1000.'.(1000+$entryTmp['group_id']).'.1']['no_name_tu'] = '';
			}
                 
			foreach($holi_list as $entryTmp)
			{
				$out['2001'.'.'.(1000+$entryTmp['group_id'])]['internal_title'] = $entry.' '.$entryTmp['name'].$smarty->translate['lc_label_2_14_gen'];
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_saving'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_saving_fk'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_saving_kn'] = '';
				$out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_saving_tu'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_paid'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_paid_fk'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_paid_kn'] = '';
				$out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_vacation_paid_tu'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_fk'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_kn'] = '';
				$out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_tu'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_fk'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_kn'] = '';
				$out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_tu'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour_fk'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour_kn'] = '';
				$out['2001'.'.'.(1000+$entryTmp['group_id'])]['external_monthly_office_hour_tu'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['no_name'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['no_name_fk'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['no_name_kn'] = '';
                $out['2001'.'.'.(1000+$entryTmp['group_id'])]['no_name_tu'] = '';


                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['internal_title'] = $entry.' '.$entryTmp['name'].$smarty->translate['lc_label_2_14_gen'].' '.$smarty->translate['red_day'];
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving_fk'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving_kn'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_saving_tu'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid_fk'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid_kn'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_vacation_paid_tu'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_fk'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_kn'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_tu'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_fk'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_kn'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_tu'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour_fk'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour_kn'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['external_monthly_office_hour_tu'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['no_name'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['no_name_fk'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['no_name_kn'] = '';
                    $out['2001'.'.'.(1000+$entryTmp['group_id']).'.1']['no_name_tu'] = '';
			}
		}
                elseif($key == 2){
                    $out['2002.1']['internal_title'] = $key == 2 ? $smarty->translate['lc_label_2002'].' Jour': $entry.' Jour';  ///$entry; before
                    $out['2002.1']['external_vacation_saving'] = '';
                    $out['2002.1']['external_vacation_saving_fk'] = '';
                    $out['2002.1']['external_vacation_saving_kn'] = '';
                    $out['2002.1']['external_vacation_saving_tu'] = '';
                    $out['2002.1']['external_vacation_paid'] = '';
                    $out['2002.1']['external_vacation_paid_fk'] = '';
                    $out['2002.1']['external_vacation_paid_kn'] = '';
                    $out['2002.1']['external_vacation_paid_tu'] = '';
                    $out['2002.1']['external_monthly'] = '';
                    $out['2002.1']['external_monthly_fk'] = '';
                    $out['2002.1']['external_monthly_kn'] = '';
                    $out['2002.1']['external_monthly_tu'] = '';
                    $out['2002.1']['external_monthly_office'] = '';
                    $out['2002.1']['external_monthly_office_fk'] = '';
                    $out['2002.1']['external_monthly_office_kn'] = '';
                    $out['2002.1']['external_monthly_office_tu'] = '';
                    $out['2002.1']['external_monthly_office_hour'] = '';
                    $out['2002.1']['external_monthly_office_hour_fk'] = '';
                    $out['2002.1']['external_monthly_office_hour_kn'] = '';
                    $out['2002.1']['external_monthly_office_hour_tu'] = '';
                    $out['2002.1']['no_name'] = '';
                    $out['2002.1']['no_name_fk'] = '';
                    $out['2002.1']['no_name_kn'] = '';
                    $out['2002.1']['no_name_tu'] = '';
                    
                    $out['2002.2']['internal_title'] = $key == 2 ? $smarty->translate['vacation_taken']: $entry;  ///$entry; before
                    $out['2002.2']['external_vacation_saving'] = '';
                    $out['2002.2']['external_vacation_saving_fk'] = '';
                    $out['2002.2']['external_vacation_saving_kn'] = '';
                    $out['2002.2']['external_vacation_saving_tu'] = '';
                    $out['2002.2']['external_monthly'] = '';
                    $out['2002.2']['external_monthly_fk'] = '';
                    $out['2002.2']['external_monthly_kn'] = '';
                    $out['2002.2']['external_monthly_tu'] = '';
                    $out['2002.2']['external_monthly_office'] = '';
                    $out['2002.2']['external_monthly_office_fk'] = '';
                    $out['2002.2']['external_monthly_office_kn'] = '';
                    $out['2002.2']['external_monthly_office_tu'] = '';
                    $out['2002.2']['external_monthly_office_hour'] = '';
                    $out['2002.2']['external_monthly_office_hour_fk'] = '';
                    $out['2002.2']['external_monthly_office_hour_kn'] = '';
                    $out['2002.2']['external_monthly_office_hour_tu'] = '';
                    $out['2002.2']['no_name'] = '';
                    $out['2002.2']['no_name_fk'] = '';
                    $out['2002.2']['no_name_kn'] = '';
                    $out['2002.2']['no_name_tu'] = '';
                    
                    $out['2002.3']['internal_title'] = $key == 2 ? $smarty->translate['vacation_saving']: $entry;  ///$entry; before
                    $out['2002.3']['external_vacation_saving'] = '';
                    $out['2002.3']['external_vacation_saving_fk'] = '';
                    $out['2002.3']['external_vacation_saving_kn'] = '';
                    $out['2002.3']['external_vacation_saving_tu'] = '';
                    $out['2002.3']['external_monthly'] = '';
                    $out['2002.3']['external_monthly_fk'] = '';
                    $out['2002.3']['external_monthly_kn'] = '';
                    $out['2002.3']['external_monthly_tu'] = '';
                    $out['2002.3']['external_monthly_office'] = '';
                    $out['2002.3']['external_monthly_office_fk'] = '';
                    $out['2002.3']['external_monthly_office_kn'] = '';
                    $out['2002.3']['external_monthly_office_tu'] = '';
                    $out['2002.3']['external_monthly_office_hour'] = '';
                    $out['2002.3']['external_monthly_office_hour_fk'] = '';
                    $out['2002.3']['external_monthly_office_hour_kn'] = '';
                    $out['2002.3']['external_monthly_office_hour_tu'] = '';
                    $out['2002.3']['no_name'] = '';
                    $out['2002.3']['no_name_fk'] = '';
                    $out['2002.3']['no_name_kn'] = '';
                    $out['2002.3']['no_name_tu'] = '';
                }
                if($key==3 && array_key_exists("11", $smarty->leave_type)){
         
			        $out['2003.2013']['internal_title'] = $smarty->translate['lc_label_2003.2013'];
                    $out['2003.2013']['external_vacation_saving'] = '';
                    $out['2003.2013']['external_vacation_saving_fk'] = '';
                    $out['2003.2013']['external_vacation_saving_kn'] = '';
			        $out['2003.2013']['external_vacation_saving_tu'] = '';
                    $out['2003.2013']['external_vacation_paid'] = '';
                    $out['2003.2013']['external_vacation_paid_fk'] = '';
                    $out['2003.2013']['external_vacation_paid_kn'] = '';
			        $out['2003.2013']['external_vacation_paid_tu'] = '';
                    $out['2003.2013']['external_monthly'] = '';
                    $out['2003.2013']['external_monthly_fk'] = '';
                    $out['2003.2013']['external_monthly_kn'] = '';
			        $out['2003.2013']['external_monthly_tu'] = '';
                    $out['2003.2013']['external_monthly_office'] = '';
                    $out['2003.2013']['external_monthly_office_fk'] = '';
                    $out['2003.2013']['external_monthly_office_kn'] = '';
			        $out['2003.2013']['external_monthly_office_tu'] = '';
                    $out['2003.2013']['external_monthly_office_hour'] = '';
                    $out['2003.2013']['external_monthly_office_hour_fk'] = '';
                    $out['2003.2013']['external_monthly_office_hour_kn'] = '';
			        $out['2003.2013']['no_name'] = '';
                    $out['2003.2013']['no_name_fk'] = '';
                    $out['2003.2013']['no_name_kn'] = '';
                    $out['2003.2013']['no_name_tu'] = '';
                }           
                
                if($key==4 && array_key_exists("10", $smarty->leave_type)){
         
			        $out['2004.2010']['internal_title'] = $smarty->translate['lc_label_2004.2010'];
                    $out['2004.2010']['external_vacation_saving'] = '';
                    $out['2004.2010']['external_vacation_saving_fk'] = '';
                    $out['2004.2010']['external_vacation_saving_kn'] = '';
			        $out['2004.2010']['external_vacation_saving_tu'] = '';
                    $out['2004.2010']['external_vacation_paid'] = '';
                    $out['2004.2010']['external_vacation_paid_fk'] = '';
                    $out['2004.2010']['external_vacation_paid_kn'] = '';
			        $out['2004.2010']['external_vacation_paid_tu'] = '';
                    $out['2004.2010']['external_monthly'] = '';
                    $out['2004.2010']['external_monthly_fk'] = '';
                    $out['2004.2010']['external_monthly_kn'] = '';
			        $out['2004.2010']['external_monthly_tu'] = '';
                    $out['2004.2010']['external_monthly_office'] = '';
                    $out['2004.2010']['external_monthly_office_fk'] = '';
                    $out['2004.2010']['external_monthly_office_kn'] = '';
			        $out['2004.2010']['external_monthly_office_tu'] = '';
                    $out['2004.2010']['external_monthly_office_hour'] = '';
                    $out['2004.2010']['external_monthly_office_hour_fk'] = '';
                    $out['2004.2010']['external_monthly_office_hour_kn'] = '';
			        $out['2004.2010']['no_name'] = '';
                    $out['2004.2010']['no_name_fk'] = '';
                    $out['2004.2010']['no_name_kn'] = '';
                    $out['2004.2010']['no_name_tu'] = '';
                }           
                
	}
        //echo "<pre>\n".print_r($out , 1)."</pre>";
	// take out the 2008 code
	unset($out[2008]);

	// status codes from "timetable"
	$out[3000] = array(
            'internal_title' => $smarty->translate['lc_label_3000'],
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
	$out[3001] = array(
            'internal_title' => $smarty->translate['lc_label_3001'],
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''

            );
        
	$out[3002] = array(
            'internal_title' => $smarty->translate['lc_label_3002'], 
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
        if($salary_code == 3){
            $out[3003] = array(
                'internal_title' => $smarty->translate['lc_label_3003'], 
                'external_vacation_saving' => '',
                'external_vacation_saving_fk' => '',
                'external_vacation_saving_kn' => '',
                'external_vacation_saving_tu' => '',
                'external_vacation_paid' => '',
                'external_vacation_paid_fk' => '',
                'external_vacation_paid_kn' => '',
                'external_vacation_paid_tu' => '',
                'external_monthly' => '',
                'external_monthly_fk' => '',
                'external_monthly_kn' => '',
                'external_monthly_tu' => '',
                'external_monthly_office' => '',
                'external_monthly_office_fk' => '',
                'external_monthly_office_kn' => '',
                'external_monthly_office_tu' => '',
                'external_monthly_office_hour' => '',
                'external_monthly_office_hour_fk' => '',
                'external_monthly_office_hour_kn' => '',
                'external_monthly_office_hour_tu' => '',
                'no_name' => '',
                'no_name_fk' => '',
                'no_name_kn' => '',
                'no_name_tu' => ''
                );
        }
        
	$out[3004] = array(
            'internal_title' => $smarty->translate['lc_label_3004'],
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
	$out[3005] = array(
            'internal_title' => $smarty->translate['lc_label_3005'], 
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
	$out[3006] = array(
            'internal_title' => $smarty->translate['lc_label_3006'], 
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
	$out[3007] = array(
            'internal_title' => $smarty->translate['lc_label_3007'], 
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
	$out[3008] = array(
            'internal_title' => $smarty->translate['lc_label_3008'], 
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
        $out[3009] = array(
            'internal_title' => $smarty->translate['lc_label_3009'], 
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
        $out[3010] = array(
            'internal_title' => $smarty->translate['lc_label_3010'], 
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
        $out[3011] = array(
            'internal_title' => $smarty->translate['lc_label_3011'], 
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
        if($salary_code == 3){
            $out[3012] = array(
                'internal_title' => $smarty->translate['lc_label_3012'],
                'external_vacation_saving' => '',
                'external_vacation_saving_fk' => '',
                'external_vacation_saving_kn' => '',
                'external_vacation_saving_tu' => '',
                'external_vacation_paid' => '',
                'external_vacation_paid_fk' => '',
                'external_vacation_paid_kn' => '',
                'external_vacation_paid_tu' => '',
                'external_monthly' => '',
                'external_monthly_fk' => '',
                'external_monthly_kn' => '',
                'external_monthly_tu' => '',
                'external_monthly_office' => '',
                'external_monthly_office_fk' => '',
                'external_monthly_office_kn' => '',
                'external_monthly_office_tu' => '',
                'external_monthly_office_hour' => '',
                'external_monthly_office_hour_fk' => '',
                'external_monthly_office_hour_kn' => '',
                'external_monthly_office_hour_tu' => '',
                'no_name' => '',
                'no_name_fk' => '',
                'no_name_kn' => '',
                'no_name_tu' => ''
                );
            
            $out[3013] = array(
                'internal_title' => $smarty->translate['lc_label_3013'], 
                'external_vacation_saving' => '',
                'external_vacation_saving_fk' => '',
                'external_vacation_saving_kn' => '',
                'external_vacation_saving_tu' => '',
                'external_vacation_paid' => '',
                'external_vacation_paid_fk' => '',
                'external_vacation_paid_kn' => '',
                'external_vacation_paid_tu' => '',
                'external_monthly' => '',
                'external_monthly_fk' => '',
                'external_monthly_kn' => '',
                'external_monthly_tu' => '',
                'external_monthly_office' => '',
                'external_monthly_office_fk' => '',
                'external_monthly_office_kn' => '',
                'external_monthly_office_tu' => '',
                'external_monthly_office_hour' => '',
                'external_monthly_office_hour_fk' => '',
                'external_monthly_office_hour_kn' => '',
                'external_monthly_office_hour_tu' => '',
                'no_name' => '',
                'no_name_fk' => '',
                'no_name_kn' => '',
                'no_name_tu' => ''
                );
        }
        
        $out[3014] = array(
            'internal_title' => $smarty->translate['lc_label_3014'],
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
        $out[3015] = array(
            'internal_title' => $smarty->translate['lc_label_3015'], 
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
        if($salary_code == 3){
            $out[3016] = array(
                'internal_title' => $smarty->translate['lc_label_3016'], 
                'external_vacation_saving' => '',
                'external_vacation_saving_fk' => '',
                'external_vacation_saving_kn' => '',
                'external_vacation_saving_tu' => '',
                'external_vacation_paid' => '',
                'external_vacation_paid_fk' => '',
                'external_vacation_paid_kn' => '',
                'external_vacation_paid_tu' => '',
                'external_monthly' => '',
                'external_monthly_fk' => '',
                'external_monthly_kn' => '',
                'external_monthly_tu' => '',
                'external_monthly_office' => '',
                'external_monthly_office_fk' => '',
                'external_monthly_office_kn' => '',
                'external_monthly_office_tu' => '',
                'external_monthly_office_hour' => '',
                'external_monthly_office_hour_fk' => '',
                'external_monthly_office_hour_kn' => '',
                'external_monthly_office_hour_tu' => '',
                'no_name' => '',
                'no_name_fk' => '',
                'no_name_kn' => '',
                'no_name_tu' => ''
                );
        }
        $out[4000] = array(
            'internal_title' => $smarty->translate['lc_label_4000'], 
            'external_vacation_saving' => '',
            'external_vacation_saving_fk' => '',
            'external_vacation_saving_kn' => '',
            'external_vacation_saving_tu' => '',
            'external_vacation_paid' => '',
            'external_vacation_paid_fk' => '',
            'external_vacation_paid_kn' => '',
            'external_vacation_paid_tu' => '',
            'external_monthly' => '',
            'external_monthly_fk' => '',
            'external_monthly_kn' => '',
            'external_monthly_tu' => '',
            'external_monthly_office' => '',
            'external_monthly_office_fk' => '',
            'external_monthly_office_kn' => '',
            'external_monthly_office_tu' => '',
            'external_monthly_office_hour' => '',
            'external_monthly_office_hour_fk' => '',
            'external_monthly_office_hour_kn' => '',
            'external_monthly_office_hour_tu' => '',
            'no_name' => '',
            'no_name_fk' => '',
            'no_name_kn' => '',
            'no_name_tu' => ''
            );
        
	// external ones	
	foreach ($sql->query("SELECT * FROM export_lon_config") as $entry)
	{   
		// do not show 3003, 3007 values
		if(!in_array($entry['internal'], array(2008)) && isset($out[$entry['internal']]))
		{
            $out[$entry['internal']]['external_vacation_saving'] = $entry['vacation_saving'];
            $out[$entry['internal']]['external_vacation_saving_fk'] = $entry['vacation_saving_fk'];
            $out[$entry['internal']]['external_vacation_saving_kn'] = $entry['vacation_saving_kn'];
			$out[$entry['internal']]['external_vacation_saving_tu'] = $entry['vacation_saving_tu'];
            $out[$entry['internal']]['external_vacation_paid'] = $entry['vacation_paid'];
            $out[$entry['internal']]['external_vacation_paid_fk'] = $entry['vacation_paid_fk'];
            $out[$entry['internal']]['external_vacation_paid_kn'] = $entry['vacation_paid_kn'];
			$out[$entry['internal']]['external_vacation_paid_tu'] = $entry['vacation_paid_tu'];
            $out[$entry['internal']]['external_monthly'] = $entry['monthly'];
            $out[$entry['internal']]['external_monthly_fk'] = $entry['monthly_fk'];
            $out[$entry['internal']]['external_monthly_kn'] = $entry['monthly_kn'];
			$out[$entry['internal']]['external_monthly_tu'] = $entry['monthly_tu'];
            $out[$entry['internal']]['external_monthly_office'] = $entry['monthly_office'];
            $out[$entry['internal']]['external_monthly_office_fk'] = $entry['monthly_office_fk'];
            $out[$entry['internal']]['external_monthly_office_kn'] = $entry['monthly_office_kn'];
			$out[$entry['internal']]['external_monthly_office_tu'] = $entry['monthly_office_tu'];
            $out[$entry['internal']]['external_monthly_office_hour'] = $entry['monthly_office_hour'];
            $out[$entry['internal']]['external_monthly_office_hour_fk'] = $entry['monthly_office_hour_fk'];
            $out[$entry['internal']]['external_monthly_office_hour_kn'] = $entry['monthly_office_hour_kn'];
			$out[$entry['internal']]['external_monthly_office_hour_tu'] = $entry['monthly_office_hour_tu'];
            $out[$entry['internal']]['no_name'] = $entry['no_name'];
            $out[$entry['internal']]['no_name_fk'] = $entry['no_name_fk'];
            $out[$entry['internal']]['no_name_kn'] = $entry['no_name_kn'];
            $out[$entry['internal']]['no_name_tu'] = $entry['no_name_tu'];
			$out[$entry['internal']]['internal_title'] = isset($out[$entry['internal']]['internal_title']) ? $out[$entry['internal']]['internal_title'] : '';
		}
	}

	//ksort($out);

	$groupTitle = 0;
	$rows = array();
        //echo "<pre>\n".print_r($out, 1)."</pre>";
        //exit();
	foreach ($out as $id => $entry) {
		// utf8 encode
		//$entry['internal_title'] = utf8_encode($entry['internal_title']);
              
		if($id>=3000 && $groupTitle==3)
		{
			//$rows[] = '<td colspan="21" ><h4>'.$smarty->translate['lc_label_types'].'</h4></td>';
            $rows[] = '<td >'.$smarty->translate['lc_label_types'].'</td>
                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>
            ';
			$groupTitle++;
		}
		else if($id>=2000 && $groupTitle==2)
		{
            //$rows[] = '<td colspan="21" ><h4>'.$smarty->translate['lc_label_leave_types'].'</h4></td>';
		    $rows[] = '<td >'.$smarty->translate['lc_label_leave_types'].'</td>
                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>
            ';
		    $groupTitle++;
                        
		}
		else if($id>=1000 && $groupTitle==1)
		{
            //$rows[] = '<td colspan="21" ><h4>'.$smarty->translate['lc_label_inconvenient_timing_hollidays'].'</h4></td>';
			$rows[] = '<td >'.$smarty->translate['lc_label_inconvenient_timing_hollidays'].'</td>
                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>
            ';
			$groupTitle++;
		}
		else if($groupTitle==0)
		{
			$rows[] = '<td>'.$smarty->translate['lc_label_inconvenient_timing'].'</td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>

                       <td ></td>
                       <td ></td>
                       <td ></td>
                       <td ></td>
            ';
            
			$groupTitle++;
		}

		if($id<1000)
		{
                                                
			$labelName = isset($list['id_'.$id]['name']) ? $list['id_'.$id]['name'] : $smarty->translate['lc_label_undefined'];
		}
		else
		{
			//$labelName = isset($smarty->translate['lc_label_'.$id]) ? $smarty->translate['lc_label_'.$id] : utf8_encode($entry['internal_title']);
			$labelName = isset($entry['internal_title']) ? $entry['internal_title'] : (isset($smarty->translate['lc_label_'.$id]) ? $smarty->translate['lc_label_'.$id] : $smarty->translate['lc_label_undefined']);
		}
		if($id === '2002.2'  || $id === '2002.3'){
                    
            $rows[] = '
			<td >[' . $id . '] ' . $labelName . '</td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving]" value="' . $entry['external_vacation_saving'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving_fk]" value="' . $entry['external_vacation_saving_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving_kn]" value="' . $entry['external_vacation_saving_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving_tu]" value="' . $entry['external_vacation_saving_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="hidden" name="config[' . $id . '][external_vacation_paid]" value=""></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="hidden" name="config[' . $id . '][external_vacation_paid_fk]" value=""></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="hidden" name="config[' . $id . '][external_vacation_paid_kn]" value=""></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="hidden" name="config[' . $id . '][external_vacation_paid_tu]" value=""></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly]" value="' . $entry['external_monthly'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_fk]" value="' . $entry['external_monthly_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_kn]" value="' . $entry['external_monthly_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_tu]" value="' . $entry['external_monthly_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office]" value="' . $entry['external_monthly_office'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_fk]" value="' . $entry['external_monthly_office_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_kn]" value="' . $entry['external_monthly_office_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_tu]" value="' . $entry['external_monthly_office_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour]" value="' . $entry['external_monthly_office_hour'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour_fk]" value="' . $entry['external_monthly_office_hour_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour_kn]" value="' . $entry['external_monthly_office_hour_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour_tu]" value="' . $entry['external_monthly_office_hour_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name]" value="' . $entry['no_name'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name_fk]" value="' . $entry['no_name_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name_kn]" value="' . $entry['no_name_kn'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name_tu]" value="' . $entry['no_name_tu'] . '"></td>
			
		';
        }elseif($id >= 2000){ 
            $rows[] = '
			<td >[' . $id . '] ' . $labelName . '</td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving]" value="' . $entry['external_vacation_saving'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving_fk]" value="' . $entry['external_vacation_saving_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving_kn]" value="' . $entry['external_vacation_saving_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving_tu]" value="' . $entry['external_vacation_saving_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_paid]" value="' . $entry['external_vacation_paid'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_paid_fk]" value="' . $entry['external_vacation_paid_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_paid_kn]" value="' . $entry['external_vacation_paid_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_paid_tu]" value="' . $entry['external_vacation_paid_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly]" value="' . $entry['external_monthly'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_fk]" value="' . $entry['external_monthly_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_kn]" value="' . $entry['external_monthly_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_tu]" value="' . $entry['external_monthly_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office]" value="' . $entry['external_monthly_office'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_fk]" value="' . $entry['external_monthly_office_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_kn]" value="' . $entry['external_monthly_office_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_tu]" value="' . $entry['external_monthly_office_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour]" value="' . $entry['external_monthly_office_hour'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour_fk]" value="' . $entry['external_monthly_office_hour_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour_kn]" value="' . $entry['external_monthly_office_hour_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour_tu]" value="' . $entry['external_monthly_office_hour_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name]" value="' . $entry['no_name'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name_fk]" value="' . $entry['no_name_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name_kn]" value="' . $entry['no_name_kn'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name_tu]" value="' . $entry['no_name_tu'] . '"></td>
			
		';
        }
        else{

		    $rows[] = '
			<td>[' . $id . '] ' . $labelName . '</td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving]" value="' . $entry['external_vacation_saving'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving_fk]" value="' . $entry['external_vacation_saving_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving_kn]" value="' . $entry['external_vacation_saving_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_saving_tu]" value="' . $entry['external_vacation_saving_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_paid]" value="' . $entry['external_vacation_paid'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_paid_fk]" value="' . $entry['external_vacation_paid_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_paid_kn]" value="' . $entry['external_vacation_paid_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_vacation_paid_tu]" value="' . $entry['external_vacation_paid_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly]" value="' . $entry['external_monthly'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_fk]" value="' . $entry['external_monthly_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_kn]" value="' . $entry['external_monthly_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_tu]" value="' . $entry['external_monthly_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office]" value="'.$entry['external_monthly_office'].'"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_fk]" value="'.$entry['external_monthly_office_fk'].'"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_kn]" value="'.$entry['external_monthly_office_kn'].'"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_tu]" value="'.$entry['external_monthly_office_tu'].'"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour]" value="' . $entry['external_monthly_office_hour'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour_fk]" value="' . $entry['external_monthly_office_hour_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour_kn]" value="' . $entry['external_monthly_office_hour_kn'] . '"></td>
			<td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][external_monthly_office_hour_tu]" value="' . $entry['external_monthly_office_hour_tu'] . '"></td>

            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name]" value="' . $entry['no_name'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name_fk]" value="' . $entry['no_name_fk'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name_kn]" value="' . $entry['no_name_kn'] . '"></td>
            <td ><input class="extern_code" style = "width:60px; margin-bottom:0px;" type="text" name="config[' . $id . '][no_name_tu]" value="' . $entry['no_name_tu'] . '"></td>
			
		';
                }
	    }

	$smarty->assign('menu',array(
		'mainmenu' => 1,
		'submenu' => 9
	));
        $print_table = "";
        $class_count = 1;
        for($i=0;$i<count($rows);$i++){
            $check_th_td = substr($rows[$i],0,3);
            if($check_th_td == "<th"){
               $print_table = $print_table."<tr>".$rows[$i]."</tr>"; 
            }else{
                if($class_count % 2 == 0){
                    $class_tr = "odd";
                    $class_count++;
                }else{
                    $class_tr = "even";
                    $class_count++;
                }
                $print_table = $print_table."<tr >".$rows[$i]."</tr>";
            }
        }
    //echo     htmlentities($print_table);
	$smarty->assign('rows',$print_table);
    $smarty->assign('fkkn_split', $company_details['fkkn_split']);
        
	$smarty->display('extends:layouts/dashboard.tpl|export_lon-config.tpl');
	//$smarty->display('extends:layouts/dashboard.tpl|temp.tpl');
?>
