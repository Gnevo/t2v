<?php
	// System magic.
	require_once('class/setup.php');

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
		$insert = $sql->prepare("REPLACE INTO export_config (internal,external,method,price) VALUES (?,?,?,?)");
		$delete = $sql->prepare("DELETE FROM export_config WHERE internal=?");

		foreach ($_POST['config'] as $id => $entry) {
			if (($id <= 0 && !empty($entry['external'])) || (!empty($entry['external']) && !empty($entry['method']) && !empty($entry['price']))) {
				if ($id <= 0) {
					// The default entry should not use these, so we standardize them to avoid confusion.
					$entry['method'] = '';
					$entry['price'] = '0.00';
				}

				$insert->execute(array($id,$entry['external'],$entry['method'],$entry['price']));
			} else {
				$delete->execute(array($id));
			}
		}
	}

	// Start out with the default entry on top.
	$out = array(
		0 => array(
			'id' => 0,
			'name' => 'Default',
			'external' => '',
			'method' => '',
			'price' => '0.00'
		),
		-1 => array(
			'id' => -1,
			'name' => 'Travel',
			'external' => '',
			'method' => '',
			'price' => '0.00'
		),
		-2 => array(
			'id' => -2,
			'name' => 'Break',
			'external' => '',
			'method' => '',
			'price' => '0.00'
		),
		-3 => array(
			'id' => -3,
			'name' => 'On call',
			'external' => '',
			'method' => '',
			'price' => '0.00'
		)
	);
	foreach ($sql->query("SELECT * FROM export_config") as $entry) {
		if (!array_key_exists($entry['internal'],$out)) {
			$out[$entry['internal']] = $entry;
		} else {
			$out[$entry['internal']] = array_merge($out[$entry['internal']],$entry);
		}
	}
	foreach ($sql->query("SELECT * FROM inconvenient_timing") as $entry) {
		if (!array_key_exists($entry['id'],$out)) {
			$entry['external'] = '';
			$entry['method'] = '';
			$entry['price'] = '0.00';

			$out[$entry['id']] = $entry;
		} else {
			$out[$entry['id']] = array_merge($out[$entry['id']],$entry);
		}
	}

	$rows = array();
	foreach ($out as $id => $entry) {
		$rows[] = '
			<td>&nbsp;</td>
			<td><input type="text" name="config[' . $id . '][external]" value="' . $entry['external'] . '"></td>
			<td>
				<select name="config[' . $id . '][method]">
					<option value="">IGNORE</option>
					<option ' . ($entry['method'] == 'REPLACE' ? ' selected="selected"' : '') . '>REPLACE</option>
					<option ' . ($entry['method'] == 'ADD' ? ' selected="selected"' : '') . '>ADD</option>
				</select>
			</td>
			<td><input type="text" name="config[' . $id . '][price]" value="' . $entry['price'] . '"></td>
		';
	}

	$smarty = new smartySetup(array('export-config.xml'));

	$smarty->assign('menu',array(
		'mainmenu' => 1,
		'submenu' => 4
	));

	$smarty->assign('rows','<tr class="m">' . implode('</tr><tr class="m">',$rows) . '</tr>');

	$smarty->display('extends:layouts/dashboard.tpl|export-config.tpl');
?>
