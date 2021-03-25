<?php
require_once('configs/config.inc.php');
require_once ('class/db.php');
/*require_once ('class/user.php');
require_once ('class/customer.php');
require_once ('class/mail.php');
require_once ('class/sms.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/inconvenient_timing.php');
require_once ('plugins/message.class.php');
require_once ('class/dona.php');
require_once('class/setup.php');
require_once('class/contract.php');
require_once('class/company.php');
require_once('class/equipment.php');*/

/**
    * employee_foreign class
    * 
    * This file created for seperating employee class functions
    * done by foreign companies.
    * @author Shamsudheen <shamsu@arioninfotech.com>
    * @version - 1.0
    * @package Cirrus
    * @since - 2013-05-25
*/
class employee_foreign extends db {
    
    /**
     * Contructor sets up db class integration
    */
    function __construct() {
        parent::__construct();
    }
    
    
    function per_of_employement_data($name, $fromdate, $todate) {
        require_once ('class/user.php');
        require_once ('class/employee.php');
        $obj_user = new user();
        $obj_employee = new employee();
        
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $obj_user->user_role($login_user);
        $name = strtolower(urldecode(str_replace('_', ' ', $name)));

        if ($name == '-') {
            switch ($login_user_role) {
                case 1:
                case 6:
                    $team_members = $obj_employee->team_members($login_user);
                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_from >= '" . $fromdate . "'
						AND employee.first_name != ''							
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date >= '" . $fromdate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_to <= '" . $todate . "'
						AND employee.first_name != ''	
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date <= '" . $todate . "'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate != '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE 
						((employee_contract.date_from >= '" . $fromdate . "' && employee_contract.date_from <= '" . $todate . "') 
						|| 
						(employee_contract.date_to >= '" . $fromdate . "' && employee_contract.date_to <= '" . $todate . "')
						||
						(employee_contract.date_from <= '" . $fromdate . "' && employee_contract.date_to >= '" . $todate . "'))
						AND employee.first_name != ''	
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date BETWEEN '" . $fromdate . "' AND '" . $todate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee.first_name != ''								
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    $this->query_generate_leftjoin();
                    $employee_data = $this->query_fetch();
                    break;

                case 2:
                case 7:
                    $team_members = $obj_employee->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_from >= '" . $fromdate . "'	
						AND employee_contract.employee IN ( " . $team_employee_data . " )
						AND employee.first_name != ''	
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date >= '" . $fromdate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )	
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_to <= '" . $todate . "'
						AND employee_contract.employee IN ( " . $team_employee_data . " )
						AND employee.first_name != ''	
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date <= '" . $todate . "'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )	
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate != '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE 

						((employee_contract.date_from >= '" . $fromdate . "' && employee_contract.date_from <= '" . $todate . "') 
						|| 
						(employee_contract.date_to >= '" . $fromdate . "' && employee_contract.date_to <= '" . $todate . "')
						||
						(employee_contract.date_from <= '" . $fromdate . "' && employee_contract.date_to >= '" . $todate . "'))
						AND employee_contract.employee IN ( " . $team_employee_data . " )
						AND employee.first_name != ''	
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date BETWEEN '" . $fromdate . "' AND '" . $todate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 	
						WHERE employee_contract.employee IN ( " . $team_employee_data . " )		
						AND employee.first_name != ''					
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    $this->query_generate_leftjoin();
                    $employee_data = $this->query_fetch();
                    break;

                case 3:
                case 4:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_from >= '" . $fromdate . "'	
						AND employee_contract.employee IN ( " . $team_employee_data . " )
						AND employee.first_name != ''							
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date >= '" . $fromdate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )	
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_to <= '" . $todate . "'
						AND employee_contract.employee IN ( " . $team_employee_data . " )
						AND employee.first_name != ''	
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date <= '" . $todate . "'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )	
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate != '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE 
						((employee_contract.date_from >= '" . $fromdate . "' && employee_contract.date_from <= '" . $todate . "') 
						|| 
						(employee_contract.date_to >= '" . $fromdate . "' && employee_contract.date_to <= '" . $todate . "')
						||
						(employee_contract.date_from <= '" . $fromdate . "' && employee_contract.date_to >= '" . $todate . "'))
						AND employee_contract.employee IN ( " . $team_employee_data . " )
						AND employee.first_name != ''	
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date BETWEEN '" . $fromdate . "' AND '" . $todate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 	
						WHERE employee_contract.employee IN ( " . $team_employee_data . " )
						AND employee.first_name != ''							
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    $this->query_generate_leftjoin();
                    $employee_data = $this->query_fetch();
                    break;
            }
        } else {

            if (strlen($name) == 2 || strlen($name) == 1) {
                $flag = 2;
            } else {
                $flag = 1;
            }

            if ($flag == 1) {
                $condition = "LCASE(employee.username) = '" . $name . "'";
            } else {
                $condition = "(LCASE(employee.last_name) LIKE '" . $name . "%' OR LCASE(employee.last_name) LIKE '" . mb_strtolower($name) . "%')";
            }

            switch ($login_user_role) {
                case 1:
                case 6:
                    $team_members = $obj_employee->team_members($login_user);
                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE " . $condition . "
						AND employee.first_name != ''							
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date >= '" . $fromdate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_to <= '" . $todate . "'
						AND " . $condition . "
						AND employee.first_name != ''	
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date <= '" . $todate . "'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate != '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE 
						((employee_contract.date_from >= '" . $fromdate . "' && employee_contract.date_from <= '" . $todate . "') 
						|| 
						(employee_contract.date_to >= '" . $fromdate . "' && employee_contract.date_to <= '" . $todate . "')
						||
						(employee_contract.date_from <= '" . $fromdate . "' && employee_contract.date_to >= '" . $todate . "')
						)
						AND " . $condition . "
						AND employee.first_name != ''	
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date BETWEEN '" . $fromdate . "' AND '" . $todate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE " . $condition . "	
						AND employee.first_name != ''							
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    $this->query_generate_leftjoin();
                    $employee_data = $this->query_fetch();
                    break;

                case 2:
                case 7:
                    $team_members = $obj_employee->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_from >= '" . $fromdate . "'	
						AND employee_contract.employee IN ( " . $team_employee_data . " )	
						AND " . $condition . "
						AND employee.first_name != ''							
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date >= '" . $fromdate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )
						AND " . $condition . "	
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_to <= '" . $todate . "'
						AND employee_contract.employee IN ( " . $team_employee_data . " )
						AND " . $condition . "
						AND employee.first_name != ''		
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date <= '" . $todate . "'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate != '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE 
						((employee_contract.date_from >= '" . $fromdate . "' && employee_contract.date_from <= '" . $todate . "') 
						|| 
						(employee_contract.date_to >= '" . $fromdate . "' && employee_contract.date_to <= '" . $todate . "')
						||
						(employee_contract.date_from <= '" . $fromdate . "' && employee_contract.date_to >= '" . $todate . "'))
						AND employee_contract.employee IN ( " . $team_employee_data . " )
						AND " . $condition . "
						AND employee.first_name != ''		
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date BETWEEN '" . $fromdate . "' AND '" . $todate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 	
						WHERE employee_contract.employee IN ( " . $team_employee_data . " )		
						AND " . $condition . "	
						AND employee.first_name != ''				
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    $this->query_generate_leftjoin();
                    $employee_data = $this->query_fetch();
                    break;

                case 3:
                case 4:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    if ($fromdate != '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_from >= '" . $fromdate . "'	
						AND employee_contract.employee IN ( " . $team_employee_data . " )	
						AND " . $condition . "
						AND employee.first_name != ''							
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date >= '" . $fromdate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )	
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE employee_contract.date_to <= '" . $todate . "'
						AND employee_contract.employee IN ( " . $team_employee_data . " )
						AND " . $condition . "
						AND employee.first_name != ''		
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date <= '" . $todate . "'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )	
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate != '0000-00-00' && $todate != '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 
						WHERE 
						((employee_contract.date_from >= '" . $fromdate . "' && employee_contract.date_from <= '" . $todate . "') 
						|| 
						(employee_contract.date_to >= '" . $fromdate . "' && employee_contract.date_to <= '" . $todate . "')
						||
						(employee_contract.date_from <= '" . $fromdate . "' && employee_contract.date_to >= '" . $todate . "'))
						AND employee_contract.employee IN ( " . $team_employee_data . " )
						AND " . $condition . "
						AND employee.first_name != ''	
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE 
						timetable.date BETWEEN '" . $fromdate . "' AND '" . $todate . "' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    if ($fromdate == '0000-00-00' && $todate == '0000-00-00') {
                        $this->tables = array("SELECT 
						employee_contract.employee AS empusername,
						employee_contract.hour AS `tothrs`,
						employee_contract.fulltime AS fulltime, 
						employee_contract.part_time AS part_time,
						employee_contract.date_from AS date_from, 
						employee_contract.date_to AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						COALESCE(TIMESTAMPDIFF(WEEK,employee_contract.date_from,employee_contract.date_to),0) as contract_weeks
						FROM employee_contract
						LEFT JOIN employee ON employee.username = employee_contract.employee 	
						WHERE employee_contract.employee IN ( " . $team_employee_data . " )	
						AND " . $condition . "
						AND employee.first_name != ''							
						UNION
						SELECT 
						timetable.employee  AS empusername,
						SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `tothrs`,
						NULL AS fulltime, 
						NULL AS part_time,
						'0000-00-00' AS date_from, 
						'0000-00-00' AS date_to,
						employee.first_name AS first_name,
						employee.last_name AS last_name,
						0 as contract_weeks
						FROM 
						timetable 
						LEFT JOIN employee ON employee.username = timetable.employee 
						WHERE timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( " . $team_employee_data . " )
						AND " . $condition . "
						GROUP BY timetable.employee
						ORDER BY last_name collate utf8_bin,first_name collate utf8_bin");
                    }
                    $this->query_generate_leftjoin();
                    $employee_data = $this->query_fetch();
                    break;
            }
        }

        if (!empty($employee_data)) {

            return $employee_data;
        }
        else
            return array();
    }
}

?>