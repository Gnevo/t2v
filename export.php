<?php
	// System magic.
	require_once('class/setup.php');

	// We want to know what's going on.
	error_reporting(E_ALL);
	ini_set('display_errors',true);

	// Autoload export classes.
	spl_autoload_register('export_autoload');

	global $db;
	if($_SESSION['db_name']){
		$db['database'] = $_SESSION['db_name'];
	}
	$sql = new PDO($db['driver'] . ':host=' . $db['host'] . ';dbname=' . $db['database'],$db['username'],$db['password']);
	$sql->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	$sql->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

	if (!array_key_exists('month',$_POST) || empty($_POST['month'])) {
		$_POST['month'] = date('n');
	}

	if (!array_key_exists('year',$_POST) || empty($_POST['year'])) {
		$_POST['year'] = date('Y');
	}

	if (array_key_exists('export',$_POST)) {
		// TODO: Match the shifts against hollidays and inconvenient times to apply extra payment.

		// Cast to int to avoid SQL injection and other nasty things.
		$_POST['year'] = (int) $_POST['year'];
		$_POST['month'] = (int) $_POST['month'];

		global $company;
		$export = new $company['export_format'](
			$_POST['year'],
			$_POST['month']
		);

		$query = $sql->query(
			"INSERT INTO exports (year,month,timestamp,employee,filename,data) VALUES (" .
			$_POST['year'] . "," .
			$_POST['month'] . "," .
			time() . "," .
			$sql->quote($_SESSION['user_name']) . "," .
			$sql->quote('time2view_' . $company['export_format'] . '_' . $_POST['year'] . '_' . $_POST['month'] . '.' . $export->extension) . "," .
			$sql->quote($export) .
			")"
		);
	}

	$query = $sql->prepare("SELECT timestamp,employee,filename,data FROM exports WHERE year=? AND month=?");
	$query->execute(array(
		$_POST['year'],
		$_POST['month']
	));
	$existing = false;
	if ($query->rowCount()) {
		$existing = $query->fetch(PDO::FETCH_ASSOC);
	}

	if (array_key_exists('download',$_POST) && $existing !== false) {
		header('Content-Disposition: attachment; filename="' . $existing['filename'] . '"');

		echo $existing['data'];
	} else {
		$smarty = new smartySetup(array('export.xml'));

		$smarty->assign('menu',array(
			'mainmenu' => 1,
			'submenu' => 4
		));

		global $month;
		$months = array();
		foreach ($month as $m) {
			$months[] = $m['id'] . ' ' . ucfirst($m['month']);
		}

		$smarty->assign('months',range(1,12));
		$smarty->assign('monthsn',$months);

		
		$pst_year = date('Y');
		$pst_month = date('m');
		if(isset($_POST['month']))
			$pst_month = $_POST['month'];
		if(isset($_POST['month']))
			$pst_year = $_POST['year'];
	
		$smarty->assign('year',$pst_year);
		$smarty->assign('month',$pst_month);

		$dummy = new dummy(
			$pst_year,
			$pst_month
		);
		
		$num_employees = $dummy->numEmployees();
		$num_signed = $dummy->numSigned();

		$not_signed = '';
		$query = $sql->prepare("SELECT first_name,last_name,phone,mobile FROM employee WHERE username=?");
		foreach ($dummy->getNotSigned() as $employee) {
			$query->execute(array($employee));
			$personalia = $query->fetch();

			$not_signed .= '
				<tr class="m">
					<td>' . $personalia['last_name'] . ', ' . $personalia['first_name'] . '</td>
					<td>' . $personalia['phone'] . '</td>
					<td>' . $personalia['mobile'] . '</td>
					<td><input type="checkbox" name="sms[]" value="' . $personalia['mobile'] . '"></td>
				</tr>
			';
		}

		$smarty->assign('num_employees',$num_employees);
		$smarty->assign('num_signed',$num_signed);
		$smarty->assign('num_not_signed',$num_employees - $num_signed);
		$smarty->assign('not_signed',$not_signed);

		if ($existing === false) {
			$smarty->assign('done',false);
		} else {
			$smarty->assign('done',true);
			$smarty->assign('employee',$existing['employee']);
			$smarty->assign('timestamp',date('Y-m-d H:m',$existing['timestamp']));
		}

		$smarty->display('extends:layouts/dashboard.tpl|export.tpl');
	}

	// Nothing fancy.
	function export_autoload($class) {
		include('./export_formats/' . $class . '.php');
	}
?>
