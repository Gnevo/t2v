<?php
	// System magic.
	require_once('class/setup.php');
	require_once('class/inconvenient_timing.php');

	$smarty = new smartySetup(array('export-config.xml'));

	// We want to know what's going on.
	error_reporting(E_ALL);
	ini_set('display_errors',true);

	global $db;
	if($_SESSION['db_name']){
		$db['database'] = $_SESSION['db_name'];
	}
	$sql = new PDO($db['driver'] . ':host=' . $db['host'] . ';dbname=' . $db['database'],$db['username'],$db['password']);
	$sql->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	$sql->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

	if (array_key_exists('config',$_POST)) {
		$insert = $sql->prepare("REPLACE INTO export_lon_config (internal,external) VALUES (?,?)");
		$delete = $sql->prepare("DELETE FROM export_lon_config WHERE internal=?");

		foreach ($_POST['config'] as $id => $entry)
		{
			if (!empty($entry['external'])) {
				$insert->execute(array($id, $entry['external']));
			} else {
				$delete->execute(array($id));
			}
		}
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
	$list = $inc_timing->inconvenient_timing_list();
	$holi_list = $inc_timing->holiday_timing_list();

	if (!empty($holi_list)) {
	    
	    for ($i = 0; $i < count($holi_list); $i++) {   // this loop is used to find year of upperlimit of 'days' field in the table
	        
	        $count = $inc_timing->holidays_count($holi_list[$i]['id']);
	        $start = strtotime(date('Y') . '-' . $holi_list[$i]['date_from']);
	        $holi_list[$i]['calc_year_to'] = date('Y', strtotime("+$count[0] day", $start));
	    }
	}

	// internal ones - small process
	foreach($list as $key=>$entry)
	{
		$out[$entry['id']]['internal_title'] = $entry['name'];
		$out[$entry['id']]['external'] = '';

		// update the key from array
		unset($list[$key]);
		$list['id_'.$entry['id']] = $entry;
	}
	foreach($holi_list as $key=>$entry)
	{
		$out[1000+$entry['id']]['internal_title'] = $entry['name'];
		$out[1000+$entry['id']]['external'] = '';

		// update the key from array
		unset($list[$key]);
		$list['id_'.(1000+$entry['id'])] = $entry;
	}
	// karens
	$out[2000] = array('internal_title' => 'Karens', 'external' => '');
        //echo "<pre>\n".print_r($smarty->leave_type, 1)."</pre>";
	foreach($smarty->leave_type as $key => $entry)
	{
		$out[2000+$key]['internal_title'] = utf8_decode($entry);
		$out[2000+$key]['external'] = '';

		// add the sick combinations
		if($key==1)
		{
			$out['2001.0']['internal_title'] = utf8_decode($entry).' 15to90days';
			$out['2001.0']['external'] = '';

			foreach($list as $entryTmp)
			{
				$out['2001'.'.'.$entryTmp['id']]['internal_title'] = utf8_decode($entry).' '.$entryTmp['name'];
				$out['2001'.'.'.$entryTmp['id']]['external'] = '';
			}

			foreach($holi_list as $entryTmp)
			{
				$out['2001'.'.'.(1000+$entryTmp['id'])]['internal_title'] = utf8_decode($entry).' '.$entryTmp['name'];
				$out['2001'.'.'.(1000+$entryTmp['id'])]['external'] = '';
			}
		}
	}

	// status codes from "timetable"
	$out[3000] = array('internal_title' => 'Normal', 'external' => '');
	$out[3001] = array('internal_title' => 'Travel', 'external' => '');
	$out[3002] = array('internal_title' => 'Break', 'external' => '');
	//$out[3003] = array('internal_title' => 'On call', 'external' => '');
	$out[3004] = array('internal_title' => 'Overtime', 'external' => '');
	$out[3005] = array('internal_title' => 'Qality overtime', 'external' => '');
	$out[3006] = array('internal_title' => 'More time', 'external' => '');
	//$out[3007] = array('internal_title' => 'Some other time', 'external' => '');
	$out[3008] = array('internal_title' => 'Intro', 'external' => '');

	// external ones	
	foreach ($sql->query("SELECT * FROM export_lon_config") as $entry)
	{
		// do not show 3003, 3007 values
		if(!in_array($entry['internal'], array(3003, 3007)))
		{
			$out[$entry['internal']]['external'] = $entry['external'];
			$out[$entry['internal']]['internal_title'] = isset($out[$entry['internal']]['internal_title']) ? $out[$entry['internal']]['internal_title'] : '';
		}
	}


	$groupTitle = 0;
	$rows = array();
	foreach ($out as $id => $entry) {
		// utf8 encode
		//$entry['internal_title'] = utf8_encode($entry['internal_title']);

		if($id>=3000 && $groupTitle==3)
		{
			$rows[] = '<td colspan="2"><br/><h3>'.$smarty->translate['lc_label_types'].'</h3></td>';
			$groupTitle++;
		}
		else if($id>=2000 && $groupTitle==2)
		{
			$rows[] = '<td colspan="2"><br/><h3>'.$smarty->translate['lc_label_leave_types'].'</h3></td>';
			$groupTitle++;
		}
		else if($id>=1000 && $groupTitle==1)
		{
			$rows[] = '<td colspan="2"><br/><h3>'.$smarty->translate['lc_label_inconvenient_timing_hollidays'].'</h3></td>';
			$groupTitle++;
		}
		else if($groupTitle==0)
		{
			$rows[] = '<td colspan="2"><br/><h3>'.$smarty->translate['lc_label_inconvenient_timing'].'</h3></td>';
			$groupTitle++;
		}

		if($id<1000)
		{
			$labelName = isset($list['id_'.$id]['name']) ? utf8_encode($list['id_'.$id]['name']) : $smarty->translate['lc_label_undefined'];
		}
		else
		{
			$labelName = isset($smarty->translate['lc_label_'.$id]) ? $smarty->translate['lc_label_'.$id] : $smarty->translate['lc_label_undefined'];
		}
		
		$rows[] = '
			<td>[' . $id . '] ' . $labelName . '</td>
			<td><input type="text" name="config[' . $id . '][external]" value="' . $entry['external'] . '"></td>
		';
	}

	$smarty->assign('menu',array(
		'mainmenu' => 1,
		'submenu' => 9
	));

	$smarty->assign('rows','<tr class="m">' . implode('</tr><tr class="m">',$rows) . '</tr>');

	$smarty->display('extends:layouts/dashboard.tpl|export_lon-config.tpl');
?>