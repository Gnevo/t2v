<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of employe
 *
 * @author dona
 */
 require_once('configs/config.inc.php');
require_once ('class/user.php');
require_once ('class/customer.php');
require_once ('class/mail.php');
require_once ('class/sms.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/db.php');
require_once ('class/inconvenient_timing.php');
require_once ('plugins/message.class.php');
require_once ('class/dona.php');
require_once('class/setup.php');

class employee extends db {

    //variable diclaration
    var $username = '';
    var $password = '';
    var $role = '';
    var $login = 0;
    var $code = '';
    var $social_security = '';
    var $first_name = '';
    var $last_name = '';
    var $address = '';
    var $city = '';
    var $post = '';
    var $phone = '';
    var $mobile = '';
    var $email = '';
    var $date = '';
    var $works = array();
    var $color_code = '';
    var $status = '';
    var $team_id = '';
    var $team_members = '';
    var $tl = '';
    var $user = '';
    var $date_from = '';
    var $date_to = '';
    var $hours = '';
    var $key = '';
    var $works_id = '';
    var $signing_report_date = '';
    var $signing_employee = '';
    var $signing_employee_date = '';
    var $signing_TL_date = '';
    var $signing_TL_employee = '';
    var $signing_suTL_date = '';
    var $signing_suTL_employee = '';
    var $inconvient_slots = array();
    var $leave_id = '';
    var $leave_status = '';
    var $century = '';

    function __construct() {

        parent::__construct();
    }

    function per_of_employement_data($name,$fromdate,$todate)
	{	
		$user = new user();
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);
		$name = str_replace('_',' ',$name);
		
		if($name == '-')		
		{
			switch ($login_user_role) 
			{
				case 1:
				case 6:
					$team_members = $this->team_members($login_user);					
					if($fromdate != '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_from >= '".$fromdate."'
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
						timetable.date >= '".$fromdate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_to <= '".$todate."'
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
						timetable.date <= '".$todate."'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername"); 
					}
					if($fromdate != '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						((employee_contract.date_from >= '".$fromdate."' && employee_contract.date_from <= '".$todate."') 
						|| 
						(employee_contract.date_to >= '".$fromdate."' && employee_contract.date_to <= '".$todate."'))
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
						timetable.date BETWEEN '".$fromdate."' AND '".$todate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						ORDER BY last_name,first_name,empusername");
					}	
					$this->query_generate_leftjoin();
					$employee_data = $this->query_fetch();
					break;
									
				case 2:
				case 7:
					$team_members = $this->team_members($login_user);
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';	
					if($fromdate != '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_from >= '".$fromdate."'	
						AND employee_contract.employee IN ( ".$team_employee_data." )
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
						timetable.date >= '".$fromdate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )	
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_to <= '".$todate."'
						AND employee_contract.employee IN ( ".$team_employee_data." )
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
						timetable.date <= '".$todate."'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )	
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername"); 
					}
					if($fromdate != '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						((employee_contract.date_from >= '".$fromdate."' && employee_contract.date_from <= '".$todate."') 
						|| 
						(employee_contract.date_to >= '".$fromdate."' && employee_contract.date_to <= '".$todate."'))
						AND employee_contract.employee IN ( ".$team_employee_data." )
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
						timetable.date BETWEEN '".$fromdate."' AND '".$todate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.employee IN ( ".$team_employee_data." )		
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
						AND timetable.employee IN ( ".$team_employee_data." )
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}	
					$this->query_generate_leftjoin();
					$employee_data = $this->query_fetch();
					break;					
				
				case 3:
				case 4:
				case 5:
					$team_employee_data = '\'' . $login_user . '\'';
					if($fromdate != '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_from >= '".$fromdate."'	
						AND employee_contract.employee IN ( ".$team_employee_data." )
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
						timetable.date >= '".$fromdate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )	
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_to <= '".$todate."'
						AND employee_contract.employee IN ( ".$team_employee_data." )
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
						timetable.date <= '".$todate."'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )	
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername"); 
					}
					if($fromdate != '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						((employee_contract.date_from >= '".$fromdate."' && employee_contract.date_from <= '".$todate."') 
						|| 
						(employee_contract.date_to >= '".$fromdate."' && employee_contract.date_to <= '".$todate."'))
						AND employee_contract.employee IN ( ".$team_employee_data." )
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
						timetable.date BETWEEN '".$fromdate."' AND '".$todate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.employee IN ( ".$team_employee_data." )
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
						AND timetable.employee IN ( ".$team_employee_data." )
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}	
					$this->query_generate_leftjoin();
					$employee_data = $this->query_fetch();						
					break;
			}
		}
		else
		{
			switch ($login_user_role) 
			{
				case 1:
				case 6:
					$team_members = $this->team_members($login_user);
					if($fromdate != '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_from >= '".$fromdate."'	
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
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
						timetable.date >= '".$fromdate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_to <= '".$todate."'
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
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
						timetable.date <= '".$todate."'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername"); 
					}
					if($fromdate != '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						((employee_contract.date_from >= '".$fromdate."' && employee_contract.date_from <= '".$todate."') 
						|| 
						(employee_contract.date_to >= '".$fromdate."' && employee_contract.date_to <= '".$todate."'))
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
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
						timetable.date BETWEEN '".$fromdate."' AND '".$todate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");												
					}
					if($fromdate == '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')	
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
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}	
					$this->query_generate_leftjoin();
					$employee_data = $this->query_fetch();
					break;
									
				case 2:
				case 7:
					$team_members = $this->team_members($login_user);
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';	
					if($fromdate != '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_from >= '".$fromdate."'	
						AND employee_contract.employee IN ( ".$team_employee_data." )	
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
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
						timetable.date >= '".$fromdate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')	
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_to <= '".$todate."'
						AND employee_contract.employee IN ( ".$team_employee_data." )
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
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
						timetable.date <= '".$todate."'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')	
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername"); 
					}
					if($fromdate != '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						((employee_contract.date_from >= '".$fromdate."' && employee_contract.date_from <= '".$todate."') 
						|| 
						(employee_contract.date_to >= '".$fromdate."' && employee_contract.date_to <= '".$todate."'))
						AND employee_contract.employee IN ( ".$team_employee_data." )
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
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
						timetable.date BETWEEN '".$fromdate."' AND '".$todate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.employee IN ( ".$team_employee_data." )		
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')	
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
						AND timetable.employee IN ( ".$team_employee_data." )
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}	
					$this->query_generate_leftjoin();
					$employee_data = $this->query_fetch();
					break;					
				
				case 3:
				case 4:
				case 5:
					$team_employee_data = '\'' . $login_user . '\'';
					if($fromdate != '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_from >= '".$fromdate."'	
						AND employee_contract.employee IN ( ".$team_employee_data." )	
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
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
						timetable.date >= '".$fromdate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )	
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.date_to <= '".$todate."'
						AND employee_contract.employee IN ( ".$team_employee_data." )
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
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
						timetable.date <= '".$todate."'
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )	
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername"); 
					}
					if($fromdate != '0000-00-00' && $todate != '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						((employee_contract.date_from >= '".$fromdate."' && employee_contract.date_from <= '".$todate."') 
						|| 
						(employee_contract.date_to >= '".$fromdate."' && employee_contract.date_to <= '".$todate."'))
						AND employee_contract.employee IN ( ".$team_employee_data." )
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')	
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
						timetable.date BETWEEN '".$fromdate."' AND '".$todate."' 
						AND timetable.employee <> '' 
						AND timetable.date <> '0000-00-00' 
						AND timetable.employee 
						NOT IN (SELECT employee_contract.employee FROM employee_contract GROUP BY employee_contract.employee) 
						AND timetable.employee IN ( ".$team_employee_data." )
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
					}
					if($fromdate == '0000-00-00' && $todate == '0000-00-00')
					{
						$this->tables = array ("SELECT 
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
						WHERE employee_contract.employee IN ( ".$team_employee_data." )	
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
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
						AND timetable.employee IN ( ".$team_employee_data." )
						AND (LCASE(employee.first_name) LIKE '".strtolower($name)."%' OR LCASE(employee.last_name) LIKE '".strtolower($name)."%' OR 
						CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) LIKE '".strtolower($name)."%')
						GROUP BY timetable.employee
						ORDER BY last_name,first_name,empusername");
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
	
	//Employee to customer data 
	function employee_emptocust_data($year,$key)
	{
		$user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
		$team_members = $this->team_members($login_user);	
			
		if ($key == '-') 
		{	
			switch ($login_user_role) 
			{
				case 1:
				case 6:				
					$this->tables = array('employee','customer','timetable');
					$this->fields = array('timetable.customer as custid','employee.first_name AS empfname', 'employee.last_name AS emplname', 'customer.first_name AS custfname', 'customer.last_name AS custlname','customer.social_security AS custssn','employee.username', 'employee.phone','employee.status','customer.status','timetable.status');					
					if($year != '-' && $year != 0)
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1','YEAR(timetable.date) = '.$year.'');		
					}
					else
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1');
					}
					$this->group_by = array('timetable.employee','timetable.customer');
					$this->order_by = array('LOWER(customer.last_name)','LOWER(customer.first_name)','LOWER(employee.last_name)','LOWER(employee.first_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();					
					break;		
				
				case 2:
				case 7:		
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';					
					$this->tables = array('employee','customer','timetable');
					$this->fields = array('timetable.customer as custid','employee.first_name AS empfname', 'employee.last_name AS emplname', 'customer.first_name AS custfname', 'customer.last_name AS custlname','customer.social_security AS custssn','employee.username', 'employee.phone','employee.status','customer.status','timetable.status');					
					if($year != '-' && $year != 0)
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1','YEAR(timetable.date) = '.$year.'', array('IN', 'username', $team_employee_data));
					}
					else
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1', array('IN', 'username', $team_employee_data));
					}
					$this->group_by = array('timetable.employee','timetable.customer');
					$this->order_by = array('LOWER(customer.last_name)','LOWER(customer.first_name)','LOWER(employee.last_name)','LOWER(employee.first_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;		
				
				case 3:
				case 5:
					$team_employee_data = '\'' . $login_user . '\'';
					$this->tables = array('employee','customer','timetable');
					$this->fields = array('timetable.customer as custid','employee.first_name AS empfname', 'employee.last_name AS emplname', 'customer.first_name AS custfname', 'customer.last_name AS custlname','customer.social_security AS custssn','employee.username', 'employee.phone','employee.status','customer.status','timetable.status');
					if($year != '-' && $year != 0)
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1','YEAR(timetable.date) = '.$year.'', array('IN', 'username', $team_employee_data));					
					}
					else
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1', array('IN', 'username', $team_employee_data));
					}
					$this->group_by = array('timetable.employee','timetable.customer');
					$this->order_by = array('LOWER(customer.last_name)','LOWER(customer.first_name)','LOWER(employee.last_name)','LOWER(employee.first_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;		
				
				case 4:
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
					$this->tables = array('employee','customer','timetable');
					$this->fields = array('timetable.customer as custid','employee.first_name AS empfname', 'employee.last_name AS emplname', 'customer.first_name AS custfname', 'customer.last_name AS custlname','customer.social_security AS custssn','employee.username', 'employee.phone','employee.status','customer.status','timetable.status');					
					if($year != '-' && $year != 0)
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1','YEAR(timetable.date) = '.$year.'', array('IN', 'username', $team_employee_data));					
					}
					else
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1', array('IN', 'username', $team_employee_data));
					}
					$this->group_by = array('timetable.employee','timetable.customer');
					$this->order_by = array('LOWER(customer.last_name)','LOWER(customer.first_name)','LOWER(employee.last_name)','LOWER(employee.first_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;		
			}
		}
		else
		{
		
			switch ($login_user_role) 
			{
				case 1:
				case 6:
					$this->tables = array('employee','customer','timetable');
					$this->fields = array('timetable.customer as custid','employee.first_name AS empfname', 'employee.last_name AS emplname', 'customer.first_name AS custfname', 'customer.last_name AS custlname','customer.social_security AS custssn','employee.username', 'employee.phone','employee.status','customer.status','timetable.status');		
					if($year != '-' && $year != 0)
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1','YEAR(timetable.date) = '.$year.'',array('OR', 'LCASE(customer.first_name) LIKE ?', 'LCASE(customer.last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'));				
					}
					else
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1',array('OR', 'LCASE(customer.first_name) LIKE ?', 'LCASE(customer.last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'));
					}					
					$this->condition_values = array(strtolower($key)."%",strtolower($key)."%",strtolower($key)."%");
					$this->group_by = array('timetable.employee','timetable.customer');
					$this->order_by = array('LOWER(customer.last_name)','LOWER(customer.first_name)','LOWER(employee.last_name)','LOWER(employee.first_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();					
					break;		
				
				case 2:
				case 7:
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
					$this->tables = array('employee','customer','timetable');
					$this->fields = array('timetable.customer as custid','employee.first_name AS empfname', 'employee.last_name AS emplname', 'customer.first_name AS custfname', 'customer.last_name AS custlname','customer.social_security AS custssn','employee.username', 'employee.phone','employee.status','customer.status','timetable.status');					
					if($year != '-' && $year != 0)
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1','YEAR(timetable.date) = '.$year.'',array('OR', 'LCASE(customer.first_name) LIKE ?', 'LCASE(customer.last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'), array('IN', 'username', $team_employee_data));				
					}
					else
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1',array('OR', 'LCASE(customer.first_name) LIKE ?', 'LCASE(customer.last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'), array('IN', 'username', $team_employee_data));
					}
					$this->condition_values = array(strtolower($key)."%",strtolower($key)."%",strtolower($key)."%");
					$this->group_by = array('timetable.employee','timetable.customer');
					$this->order_by = array('LOWER(customer.last_name)','LOWER(customer.first_name)','LOWER(employee.last_name)','LOWER(employee.first_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();	
					break;		
				
				case 3:
				case 5:
					$team_employee_data = '\'' . $login_user . '\'';
					$this->tables = array('employee','customer','timetable');
					$this->fields = array('timetable.customer as custid','employee.first_name AS empfname', 'employee.last_name AS emplname', 'customer.first_name AS custfname', 'customer.last_name AS custlname','customer.social_security AS custssn','employee.username', 'employee.phone','employee.status','customer.status','timetable.status');					
					if($year != '-' && $year != 0)
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1','YEAR(timetable.date) = '.$year.'',array('OR', 'LCASE(customer.first_name) LIKE ?', 'LCASE(customer.last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'), array('IN', 'username', $team_employee_data));				
					}
					else
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1',array('OR', 'LCASE(customer.first_name) LIKE ?', 'LCASE(customer.last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'), array('IN', 'username', $team_employee_data));
					}					
					$this->condition_values = array(strtolower($key)."%",strtolower($key)."%",strtolower($key)."%");
					$this->group_by = array('timetable.employee','timetable.customer');
					$this->order_by = array('LOWER(customer.last_name)','LOWER(customer.first_name)','LOWER(employee.last_name)','LOWER(employee.first_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;		
				
				case 4:
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
					$this->tables = array('employee','customer','timetable');
					$this->fields = array('timetable.customer as custid','employee.first_name AS empfname', 'employee.last_name AS emplname', 'customer.first_name AS custfname', 'customer.last_name AS custlname','customer.social_security AS custssn','employee.username', 'employee.phone','employee.status','customer.status','timetable.status');
					if($year != '-' && $year != 0)
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1','YEAR(timetable.date) = '.$year.'',array('OR', 'LCASE(customer.first_name) LIKE ?', 'LCASE(customer.last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'), array('IN', 'username', $team_employee_data));				
					}
					else
					{
						$this->conditions = array('AND', 'employee.username = timetable.employee','customer.username = timetable.customer','customer.status = 1','employee.status = 1','timetable.status = 1',array('OR', 'LCASE(customer.first_name) LIKE ?', 'LCASE(customer.last_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?'), array('IN', 'username', $team_employee_data));
					}
					$this->condition_values = array(strtolower($key)."%",strtolower($key)."%",strtolower($key)."%");
					$this->group_by = array('timetable.employee','timetable.customer');
					$this->order_by = array('LOWER(customer.last_name)','LOWER(customer.first_name)','LOWER(employee.last_name)','LOWER(employee.first_name)');
					$this->query_generate();
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
	
	//Employee active in active data
	function employee_activeinactive_data($key = NULL,$status,$order) {
		
        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
		
		if($order == '-')
		{
			$order	= 'ascname';
		}
						
        if ($key == '-') {
			
            switch ($login_user_role) {
                case 1:
                case 6:
                    $team_members = $this->team_members($login_user);
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', 'status = '.$status.'');
					}
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code');							
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
					
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = '.$status.'');
					}
					else
					{	
						 $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
					}
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = '.$status.'');
					}
					else
					{	
						 $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
					}
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = '.$status.'');
					}
					else
					{	
						 $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
					}
					//$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
            }
        } else {
				
		$fullname = str_replace('_',' ',$key);
		$key = $fullname;
						
			//check for name parameter it's full name or it's character
            switch ($login_user_role) {

                case 1:
                case 6:
                    $team_members = $this->team_members($login_user);

                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', 'status = '.$status.'',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
						$this->condition_values = array(strtolower($key)."%",strtolower($key)."%",strtolower($key)."%");
					}
					else
					{	
						$this->conditions = array('AND',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
						$this->condition_values = array(strtolower($key)."%",strtolower($key)."%",strtolower($key)."%");
					}					
                    
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\''; 														           
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						 $this->conditions = array('AND', 'status = '.$status.'',array('IN', 'username', $team_employee_data),array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));						
					}
					else
					{	
						 $this->conditions = array('AND',array('IN', 'username', $team_employee_data),array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					}
					$this->condition_values = array(strtolower($key)."%",strtolower($key)."%",strtolower($key)."%");
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = '.$status.'',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					}
					else
					{	
						 $this->conditions = array('AND', array('IN', 'username', $team_employee_data), array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					}
					$this->condition_values = array(strtolower($key)."%",strtolower($key)."%",strtolower($key)."%");
					
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
					if($status != '-')
					{
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = '.$status.'',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					}
					else
					{	
						$this->conditions = array('AND', array('IN', 'username', $team_employee_data),array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					}                   
					$this->condition_values = array(strtolower($key)."%",strtolower($key)."%",strtolower($key)."%");
					
                    //$this->order_by = array('LOWER(last_name)');
					if($order == 'ascnum')
					{		
						$this->order_by = array('code ASC');		
					}
					else if($order == 'descnum')
					{		
						$this->order_by = array('code DESC');		
					}
					else if($order == 'ascssn')
					{		
						$this->order_by = array('social_security ASC');	
					}
					else if($order == 'descssn')
					{			
						$this->order_by = array('social_security DESC');	
					}
					else if($order == 'ascname')
					{		
						$this->order_by = array('LOWER(last_name) ASC');	
					}
					else if($order == 'descname')
					{			
						$this->order_by = array('LOWER(last_name) DESC');
					}
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
            }
        }

        if (!empty($employee_data)) {

            return $employee_data;
        }
        else
		{
            return array();
		}
    }
	
	function empgriddata($name,$fromdate,$todate)
	{
		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);
		
		//check for name parameter it's full name or it's character
		$fullname = str_replace('_',' ',$name);
		$name = $fullname;				

				
		switch ($login_user_role) 
		{	
			case 1:
			case 6:
			
				$team_members = $this->team_members($login_user);
				$this->tables = array('employee','customer','timetable');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',
				"SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY))) AS totalMinutes",
				"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");		
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				
				}				
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer');
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'"');
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"');
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
				}

				$this->group_by = array('timetable.employee','timetable.customer');
				$this->order_by = array('employee.last_name','employee.first_name','customer.first_name','customer.last_name');
				$this->query_generate();
				$employee_data = $this->query_fetch();
	
				if (!empty($employee_data) && !empty($employee_data[0]['username'])) 
				{	
					return $employee_data;
				}
				else
				{
					return array();
				}
				break;
				
		case 2:
		case 7:
				$team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
	
				$this->tables = array('employee','customer','timetable');
								$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");						
				}		
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date >= "'.$fromdate.'" ');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date <= "'.$todate.'" ');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				}
				$this->group_by = array('timetable.employee','timetable.customer');
				$this->order_by = array('employee.last_name','employee.first_name','customer.first_name','customer.last_name');
				$this->query_generate();
				$employee_data = $this->query_fetch();
				
				if (!empty($employee_data)) 
				{				
					return $employee_data;
				}
				else 
				{
					return array();
				}	
				break;
				
			case 3:
			
			case 5:
				$team_employee_data = '\'' . $login_user . '\'';
				$this->tables = array('employee','customer','timetable');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}			
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date >= "'.$fromdate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date <= "'.$todate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				}
				$this->group_by = array('timetable.employee','timetable.customer'); 
				$this->order_by = array('employee.last_name','employee.first_name','customer.first_name','customer.last_name');
				$this->query_generate();
				$employee_data = $this->query_fetch();
				
				if (!empty($employee_data)) 
				{				
					return $employee_data;
				}
				else 
				{
					return array();
				}	
				break;
			case 4:		
				$team_members = $this->team_members($login_user);				
				$team_employee_data = '\'' . $login_user . '\'';
				$this->tables = array('employee','customer','timetable');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}			
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date >= "'.$fromdate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date <= "'.$todate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status != 0','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status != 0','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
				}
				$this->group_by = array('timetable.employee','timetable.customer'); 
				$this->order_by = array('employee.last_name','employee.first_name','customer.first_name','customer.last_name');
				$this->query_generate();
				$employee_data = $this->query_fetch();
				
				if (!empty($employee_data)) 
				{				
					return $employee_data;
				}
				else 
				{
					return array();
				}	
				break;	
		}
	}
	
	function getemptothrs($empunm,$fromdate,$todate)
	{
		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);		
		$team_members = $this->team_members($login_user);
		$this->tables = array('timetable');	
		$this->fields = array("FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))/60) AS hours","(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))%60) AS minutes","CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(`DATE`,' ',time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(`DATE`,' ',time_to),'%Y-%m-%d %H.%i'),DATE + INTERVAL 1 DAY)))%60)) AS hrsmins");			
			
		if($fromdate != '0000-00-00' && $todate == '0000-00-00')
		{			
			$this->conditions = array('AND','timetable.status != 0','timetable.employee = "'.$empunm.'"','timetable.date >= "'.$fromdate.'" ');				
		}	
		if($fromdate == '0000-00-00' && $todate != '0000-00-00')
		{			
			$this->conditions = array('AND','timetable.status != 0','timetable.employee = "'.$empunm.'"','timetable.date <= "'.$todate.'" ');				
		}			
		if($fromdate != '0000-00-00' && $todate != '0000-00-00')
		{			
				$this->conditions = array('AND','timetable.status != 0','timetable.employee = "'.$empunm.'"','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');	
							
		}
		if($fromdate == '0000-00-00' && $todate == '0000-00-00')
		{	
			$this->conditions = array('AND','timetable.status != 0','timetable.employee = "'.$empunm.'"');	
		}
		$employee_data = $this->query_fetch();
		
		if (!empty($employee_data)) 
		{				
			return $employee_data;
		}
		else 
		{
			return array();
		}	
	}
	
	//calculateemployee leaves (Hors are calculated on base of leave hours in shcedule time)
	function getempleave_exclude_some($empunm,$fromdate,$todate)
	{
		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);

		$team_members = $this->team_members($login_user);
		$this->tables = array('leave','timetable');	
		$this->fields = array('timetable.employee','timetable.customer','timetable.time_from AS schfrom','timetable.time_to AS schto','leave.time_from AS leafrom','leave.time_to AS leato','leave.type','leave.date As leavedate','timetable.date AS schduledate');
			
		if($fromdate != '0000-00-00' && $todate == '0000-00-00')
		{			
			$this->conditions = array('AND','timetable.status != 0','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date >= "'.$fromdate.'" ',array('OR','leave.type = 2','leave.type = 3','leave.type = 4','leave.type = 7'));				
		}	
		if($fromdate == '0000-00-00' && $todate != '0000-00-00')
		{			
			$this->conditions = array('AND','timetable.status != 0','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date <= "'.$todate.'" ',array('OR','leave.type = 2','leave.type = 3','leave.type = 4','leave.type = 7'));				
		}			
		if($fromdate != '0000-00-00' && $todate != '0000-00-00')
		{			
				$this->conditions = array('AND','timetable.status != 0','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"','leave.date = timetable.date',array('OR','leave.type = 2','leave.type = 3','leave.type = 4','leave.type = 7'));	
							
		}
		if($fromdate == '0000-00-00' && $todate == '0000-00-00')
		{	
			$this->conditions = array('AND','timetable.status != 0','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"', 'timetable.date = leave.date',array('OR','leave.type = 2','leave.type = 3','leave.type = 4','leave.type = 7'));	
		}
	
		$employee_data = $this->query_fetch();		

		$totemp = count($employee_data);
		$leavearr = array();
		if($totemp > 0)
		{
			for($w=0;$w<$totemp;$w++)	
			{
					$empuname = $employee_data[$w]['employee'];
					$custuname = $employee_data[$w]['customer'];
					$schdulefrom = $employee_data[$w]['schfrom'];
					$schduleto = $employee_data[$w]['schto'];
					$leavefrom = $employee_data[$w]['leafrom'];
					$leaveto = $employee_data[$w]['leato'];
					$leavetype = $employee_data[$w]['type'];
					$leavedate = $employee_data[$w]['leavedate'];
					
					$ltype1 = number_format($schdulefrom, 2, '.', '');
					$divi1 = substr(strstr($ltype1,'.'),1);
					$base1 = substr($ltype1,0,-3);
					$schdulefrom = ($base1*60)+$divi1;
					
					$ltype2 = number_format($schduleto, 2, '.', '');
					$divi2 = substr(strstr($ltype2,'.'),1);
					$base2 = substr($ltype2,0,-3);
					$schduleto = ($base2*60)+$divi2;
					
					$ltype3 = number_format($leavefrom, 2, '.', '');
					$divi3 = substr(strstr($ltype3,'.'),1);
					$base3 = substr($ltype3,0,-3);
					$leavefrom = ($base3*60)+$divi3;
					
					$ltype4 = number_format($leaveto, 2, '.', '');
					$divi4 = substr(strstr($ltype4,'.'),1);
					$base4 = substr($ltype4,0,-3);
					$leaveto = ($base4*60)+$divi4;
					
					if($schdulefrom <= $leavefrom && $schduleto >= $leaveto)
					{
						$total_leave = $leaveto - $leavefrom;
					}
					elseif($schdulefrom >= $leavefrom && $schduleto >= $leaveto)
					{
						$total_leave = $leaveto - $leavefrom - ($schdulefrom - $leavefrom);
					}
					elseif($schdulefrom <= $leavefrom && $schduleto <= $leaveto)
					{
						$total_leave = $leaveto - $leavefrom - ($leaveto - $schduleto);
					}
					elseif($schdulefrom >= $leavefrom && $schduleto <= $leaveto)
					{
						$total_leave = $leaveto - $leavefrom - (($schdulefrom - $leavefrom) + ($leaveto - $schduleto));
					}
					if($leavearr[$empuname][$custuname][$leavetype] != '')
					{
											
						$leavearr[$empuname][$custuname][$leavetype] += $total_leave;
					}
					else
					{
						$leavearr[$empuname][$custuname][$leavetype] = $total_leave;
					}
			}
		}
		
		if (!empty($leavearr)) 
		{				
			return $leavearr;
		}
		else 
		{
			return array();
		}	
		exit;
	}
	
	//calculateemployee leaves (Hors are calculated on base of leave hours in shcedule time)
	function getempleave($empunm,$fromdate,$todate)
	{
		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);

		$team_members = $this->team_members($login_user);
		$this->tables = array('leave','timetable');	
		$this->fields = array('timetable.employee','timetable.customer','timetable.time_from AS schfrom','timetable.time_to AS schto','leave.time_from AS leafrom','leave.time_to AS leato','leave.type','leave.date As leavedate','timetable.date AS schduledate');
			
		if($fromdate != '0000-00-00' && $todate == '0000-00-00')
		{			
			$this->conditions = array('AND','timetable.status != 0','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date >= "'.$fromdate.'" ');				
		}	
		if($fromdate == '0000-00-00' && $todate != '0000-00-00')
		{			
			$this->conditions = array('AND','timetable.status != 0','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date <= "'.$todate.'" ');				
		}			
		if($fromdate != '0000-00-00' && $todate != '0000-00-00')
		{			
				$this->conditions = array('AND','timetable.status != 0','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"','leave.date = timetable.date');	
							
		}
		if($fromdate == '0000-00-00' && $todate == '0000-00-00')
		{	
			$this->conditions = array('AND','timetable.status != 0','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"', 'timetable.date = leave.date');	
		}
	
		$employee_data = $this->query_fetch();

		$totemp = count($employee_data);
		$leavearr = array();
		if($totemp > 0)
		{
			for($w=0;$w<$totemp;$w++)	
			{
					$empuname = $employee_data[$w]['employee'];
					$custuname = $employee_data[$w]['customer'];
					$schdulefrom = $employee_data[$w]['schfrom'];
					$schduleto = $employee_data[$w]['schto'];
					$leavefrom = $employee_data[$w]['leafrom'];
					$leaveto = $employee_data[$w]['leato'];
					$leavetype = $employee_data[$w]['type'];
					$leavedate = $employee_data[$w]['leavedate'];
					
					$ltype1 = number_format($schdulefrom, 2, '.', '');
					$divi1 = substr(strstr($ltype1,'.'),1);
					$base1 = substr($ltype1,0,-3);
					$schdulefrom = ($base1*60)+$divi1;
					
					$ltype2 = number_format($schduleto, 2, '.', '');
					$divi2 = substr(strstr($ltype2,'.'),1);
					$base2 = substr($ltype2,0,-3);
					$schduleto = ($base2*60)+$divi2;
					
					$ltype3 = number_format($leavefrom, 2, '.', '');
					$divi3 = substr(strstr($ltype3,'.'),1);
					$base3 = substr($ltype3,0,-3);
					$leavefrom = ($base3*60)+$divi3;
					
					$ltype4 = number_format($leaveto, 2, '.', '');
					$divi4 = substr(strstr($ltype4,'.'),1);
					$base4 = substr($ltype4,0,-3);
					$leaveto = ($base4*60)+$divi4;
					
					if($schdulefrom <= $leavefrom && $schduleto >= $leaveto)
					{
						$total_leave = $leaveto - $leavefrom;
					}
					elseif($schdulefrom >= $leavefrom && $schduleto >= $leaveto)
					{
						//$total_leave = $leaveto - $leavefrom - ($schdulefrom - $leavefrom);
						$total_leave = $leaveto - $leavefrom;
					}
					elseif($schdulefrom <= $leavefrom && $schduleto <= $leaveto)
					{
						$total_leave = $leaveto - $leavefrom - ($leaveto - $schduleto);
					}
					elseif($schdulefrom >= $leavefrom && $schduleto <= $leaveto)
					{
						$total_leave = $leaveto - $leavefrom - (($schdulefrom - $leavefrom) + ($leaveto - $schduleto));
					}	
										
					if($leavearr[$empuname][$custuname][$leavetype] != '')
					{				
						$leavearr[$empuname][$custuname][$leavetype] += $total_leave;
					}
					else
					{
						$leavearr[$empuname][$custuname][$leavetype] = $total_leave;
					}
			}
		}
				
		if (!empty($leavearr)) 
		{				
			return $leavearr;
		}
		else 
		{
			return array();
		}	
		exit;
	}
	
	// This function is for show data of employee with auto suggest
	function getemployee($name)
	{		
		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);
		$name = str_replace('_',' ',$name);
		  if ($name != NULL) 
		  {
            switch ($login_user_role) {

                case 1:
				 	$team_members = $this->team_members($login_user);
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
					$this->conditions = array('AND', 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
				case 2:
					$team_members = $this->team_members($login_user);
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
					$this->tables = array('employee');
					$this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;	
				case 3:
					$team_employee_data =  '\'' . $_SESSION['user_id'] . '\'';
					$this->tables = array('employee');
					$this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
				$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;							
                case 6:	
                    $team_members = $this->team_members($login_user);
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
				$this->conditions = array('AND', 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
					//$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 7:				
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");				
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 5:				
					$team_employee_data = '\'' . $login_user . '\'';
					$this->tables = array('employee');
					$this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;
                case 4:				
					$team_members = $this->team_members($login_user);
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
					$this->tables = array('employee');
					$this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1',array('OR', 'LCASE(first_name) LIKE ?', 'LCASE(last_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
					$this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');				
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;
            }
        }
		if (!empty($employee_data)) 
		{				
			return $employee_data;
		}
		else 
		{
			return array();
		}
	}    
    
    // function used to list the contracts of a particular employee using employee id
    function contract_employee($username) {
        $this->tables = array('employee_contract', 'employee');
        $this->fields = array('employee_contract.id',
            'employee_contract.employee',
            'employee_contract.date_from',
            'employee_contract.date_to',
            'employee_contract.hour',
            'employee.username',
            'employee.first_name',
            'employee.last_name'
        );
        $this->conditions = array('AND',
            'employee_contract.employee = employee.username',
            'employee.username=?'
        );
        $this->condition_values = array($username);
        $this->order_by = array('employee_contract.date_from');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    // Function to check wheather to edit or add
    function contract_add_edit_employee_check($id) {
        if (!empty($id[1])) {

            return 'edit';
        } else {
            return 'add';
        }
    }

    //Function to edit the allotted contract 

    function contract_employee_edit($id) {
        //echo "my id at edit ".$id;
        $this->tables = array('employee_contract');
        $this->fields = array('date_from', 'date_to', 'hour');
        $this->field_values = array($this->date_from, $this->date_to, $this->hours);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        echo $this->sql_query;
        $data = $this->query_update();
        if ($data)
            return true;
        else
            return FALSE;
    }

    //Function to take the values from the table according to the particular table
    function contract_employee_edit_get($id) {

        $this->tables = array('employee_contract');
        $this->fields = array('id', 'employee', 'date_from', 'date_to', 'hour');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function contract_employee_add() {

        $this->tables = array('employee_contract');
        $this->fields = array('employee', 'date_from', 'date_to', 'hour');
        $this->field_values = array($this->user, $this->date_from, $this->date_to, $this->hours);
        $data = $this->query_insert();
        if ($data)
            return true;
        else
            return FALSE;
    }

    function contract_employee_check($val) {

        $this->tables = array('employee_contract');
        $this->fields = array('employee');

        $this->conditions = array('AND', array('OR', '? BETWEEN date_from AND date_to', '?  BETWEEN date_from AND date_to', 'date_from BETWEEN ? AND ?', 'date_to  BETWEEN ? AND ?'), 'employee = ?',);
        if ($val != "") {
            $this->conditions[] = 'id <>?';
        }
        $this->condition_values = array($this->date_from, $this->date_to, $this->date_from, $this->date_to, $this->date_from, $this->date_to, $this->user);
        if ($val != "") {
            $this->condition_values[] = $val;
        }

        $this->query_generate();
        $data = $this->query_fetch();
        if ($data)
            return $data;
        else
            return FALSE;
    }

    function generate_employee_code() {

        $this->tables = array('employee');
        $this->fields = array('MAX(SUBSTR(code,LOCATE(\'-\',code)+1)) as code', 'LENGTH(SUBSTR(code,LOCATE(\'-\',code)+1)) as code_size', 'SUBSTR(code,1, LOCATE(\'-\',code)+1) as code_start', 'count(*) as code_exists');
        $this->query_generate();
        $data = $this->query_fetch(1);
        if (!empty($data)) {
            $max_count_code = $data[0]['code'];
            $max_count = $max_count_code + 1;
            $count = sprintf('%0' . $data[0]['code_size'] . 'd', $max_count);
            $temp = $data[0]['code_start'];
            $code = $temp . $count;
        } else {
            $code = '001-000001';
        }

        return $code;
    }

    function date_difference($fdate, $ldate) {
        $diff = strtotime($ldate) - strtotime($fdate);
        return $diff;
    }

    
    
    function makeArray($datas = array()) {

        $data_array = array();
        foreach ($datas as $data) {

            $data_array[$data['id']] = $data['name'];
        }
        return $data_array;
    }
		
	
	
	
	
	
	
	
	
	

    function employee_list_begin($key = NULL) {

        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if ($key == NULL) {
            switch ($login_user_role) {

                case 1:
                case 6:
                    $team_members = $this->team_members($login_user);
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', 'status = 0');
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 0');
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 0');
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 0');
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
            }
        } else {
            switch ($login_user_role) {

                case 1:
                case 6:
                    $team_members = $this->team_members($login_user);
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'status = 0');
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'status = 0');
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'status = 0');
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'), 'status = 0');
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
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

    function employee_list($key = NULL) {

        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if ($key == NULL) {
            switch ($login_user_role) {

                case 1:
                case 6:
                    $team_members = $this->team_members($login_user);
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', 'status = 1');
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
            }
        } else {
            switch ($login_user_role) {

                case 1:
                case 6:
                    $team_members = $this->team_members($login_user);
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    $team_employee_data = '\'' . $login_user . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $team_members = $this->team_members($login_user);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
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

    function employee_list_exact($login_user = '', $key = NULL) {

        $user = new user();
        $employee_data = array();
        $team_employee_data = '';
        if ($login_user == '')
            $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if ($key == NULL) {
            switch ($login_user_role) {

                case 1:
                case 6:
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                    $this->conditions = array('AND', 'status = 1');
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 2:
                case 7:
                    $team_members = $this->team_members($login_user);
                    //print_r($team_members);
                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 3:
                case 5:
                    if($_SESSION['user_role'] == '3' || $_SESSION['user_role'] == '5'){
                        $team_employee_data = '\'' . $login_user . '\'';
                    }else{
                        $team_members = $this->team_members($login_user);
                        $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    }    
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 4:
                    $customer_query = '';
                    if($_SESSION['user_role'] == '3' || $_SESSION['user_role'] == '5'){
                        $customer_query = '\'' . $_SESSION['user_id'] . '\'';
                    }else{
                        $this->tables = array('team');
                        $this->fields = array('employee');
                        $this->conditions = array('customer = ?');
                        $this->query_generate();
                        $customer_query = $this->sql_query;
                    }
                    
                    //$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                    $this->conditions = array('AND', array('IN', 'username', $customer_query), 'status = 1');
                    if($_SESSION['user_role'] != '3' &&  $_SESSION['user_role'] != '5')
                        $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
            }
        }
        if (count($employee_data))
            return $employee_data;
        else
            return array();
    }

    function employee_list_limit($start, $limit, $key = NULL) {

        $user = new user();
        $start = $start * 5;
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        if ($key == NULL) {

            $this->tables = array('employee');
            $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
            $this->conditions = array('AND', 'status = 1');
            $this->order_by = array('LOWER(last_name)');
            $this->limit = $start . ',' . $limit;
            $this->query_generate();
            $employee_data = $this->query_fetch();
        } else {

            $this->tables = array('employee');
            $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
            $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
            $this->condition_values = array($key . "%", strtolower($key) . "%");
            $this->order_by = array('LOWER(last_name)');
            $this->query_generate();
            $employee_data = $this->query_fetch();
        }

        if (!empty($employee_data)) {

            return $employee_data;
        }
        else
            return array();
    }

    function employee_slots_week($employee, $year_week) {

        global $week;

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $datas = array();
        $i = 0;
        foreach ($week as $day) {

            $datas[$i]['day'] = $day;
            $date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
            $datas[$i]['date'] = $date;
            //cheking the slot is signed
            $date_array = explode('-', $date);
            $date_month = $date_array[1];
            $date_year = $date_array[0];
            $employee_username = $employee;
            $this->tables = array('report_signing');
            $this->fields = array('id');
            $this->conditions = array('AND', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?');
            $this->condition_values = array($employee_username, $date_month, $date_year);
            $this->query_generate();
//            echo $this->sql_query;
//                        print_r($this->condition_values);
//                        echo "<br>";
            $signin_data = $this->query_fetch();
            $signin_flag = 0;
            if (!empty($signin_data)) {
                $signin_flag = 1;
            }
            $datas[$i]['signed'] = $signin_flag;
            $slots = $this->employee_slots_day($employee, $date);
            $datas[$i]['slots'] = $slots;
            $i++;
        }
        return $datas;
    }

    function employee_slots_day($employee, $date) {

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'fkkn', 'time_from', 'time_to', 'status', 'type', 'alloc_emp', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name', '(SELECT color FROM employee where username = timetable.employee) AS emp_color');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '0,1,2'));
        $this->condition_values = array($employee, $date);
        $this->order_by = array('time_from');
        $this->query_generate();
        $slots = $this->query_fetch();
        $datas = array();
        //cheking the slot is signed
        $date_array = explode('-', $date);
        $date_month = $date_array[1];
        $date_year = $date_array[0];
        

        foreach ($slots as $slot) {
            $employee_username = $slot['employee'];
            $this->tables = array('report_signing');
            $this->fields = array('id');
            $this->conditions = array('AND', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?');
            $this->condition_values = array($employee_username, $date_month, $date_year);
            $this->query_generate();
            $signin_data = $this->query_fetch();
            $signin_flag = 0;
            if (!empty($signin_data)) {
                $signin_flag = 1;
            }

            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'fkkn' => $slot['fkkn'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_hour' => $this->time_difference($slot['time_from'], $slot['time_to']), 'status' => $slot['status'], 'type' => $slot['type'], 'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 'alloc_emp' => $slot['alloc_emp'], 'emp_color' => $slot['emp_color'], 'signed' => $signin_flag);
        }
        return $datas;
    }
    
    function chk_employee_rpt_signed($employee, $date) {

        
        //cheking the slot is signed
        $date_array = explode('-', $date);
        $date_month = $date_array[1];
        $date_year = $date_array[0];
        
        $this->tables = array('report_signing');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?');
        $this->condition_values = array($employee, $date_month, $date_year);
        $this->query_generate();
        $signin_data = $this->query_fetch();
        $signin_flag = 0;
        if (!empty($signin_data)) {
            $signin_flag = 1;
        }

           
        return $signin_flag;
    }

    function employee_add_leave($employee_username, $date_from, $date_to, $type, $comments) {
        $this->tables = array('leave');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'));
        $this->condition_values = array($employee_username, $date_from, $date_to);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['id'] == "" || $data[0]['id'] == NULL) {
            $leave_type = array(
                '1' => 'Sjuk',
                '2' => 'Sem',
                '3' => 'VAB',
                '4' => 'FP',
                '5' => 'P-möte',
                '6' => 'Utbild',
                '7' => 'Övrigt',
                '8' => 'Byte'
            );
            $user = new user();
            $date_calc = new datecalc();
            $alloc_employee = $_SESSION['user_id'];
            $enter_user_role = $user->user_role($alloc_employee);
            $appr_date = date('Y-m-d');
            $this->tables = array('timetable');
            $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment');
            $this->conditions = array('AND', 'status = 1', 'employee = ?', array('BETWEEN', 'date', '?', '?'));
            $this->condition_values = array($employee_username, $date_from, $date_to);
            $this->query_generate();
            $slot_datas = $this->query_fetch();
            if (!empty($slot_datas)) {
                $duplicate_slots = array();
                foreach ($slot_datas as $slot_data) {

                    $duplicate_slots[] = array($slot_data['customer'], $slot_data['date'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['type'], '0', $alloc_employee, $slot_data['id']);
                }
                $this->begin_transaction();
                $this->tables = array('timetable');
                $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'status', 'alloc_emp', 'relation_id');
                $this->field_values = $duplicate_slots;
                if ($this->query_insert()) {
                    $this->tables = array('timetable');
                    $this->fields = array('status');
                    $this->field_values = array('2');
                    $this->conditions = array('AND', 'status = 1', 'employee = ?', array('BETWEEN', 'date', '?', '?'));
                    $this->condition_values = array($employee_username, $date_from, $date_to);
                    if ($this->query_update()) {
                        $mail_message_days = 'Datum och pass: ';
                        $sms_message_days = '';
                        //getting group id
                        $this->tables = array('leave');
                        $this->fields = array('MAX(group_id) AS group_id');
                        $this->query_generate();
                        $data = $this->query_fetch(2);
                        $new_group_id = (int) ($data[0]) + 1;
                        $days = $date_calc->get_days($date_from, $date_to);
                        if (count($days) > 1) {
                            $leave_days = array();
                            foreach ($days as $day) {

                                $mail_message_days .= $day . ' : 00.00-24.00 (24h)<br/>';
                                $sms_message_days .= 'Datum: ' . $day . '%0APass: 00.00-24.00%0A';
                                /* if ($enter_user_role == 1) {

                                  $leave_days[] = array($new_group_id, $employee_username, $day, '00.00', '24.00', $type, $comments, $alloc_employee, $appr_date, '1');
                                  } else { */

                                $leave_days[] = array($new_group_id, $employee_username, $day, '00.00', '24.00', $type, $comments, $alloc_employee, '0');
                                //}
                            }
                        } else {
                            $mail_message_days .= $days[0] . ' : 00.00-24.00 (24h)<br/>';
                            $sms_message_days .= 'Datum: ' . $days[0] . '%0APass: 00.00-24.00%0A';
                            /* if ($enter_user_role == 1) {

                              $leave_days = array($new_group_id, $employee_username, $days[0], '00.00', '24.00', $type, $comments, $alloc_employee, $appr_date, '1');
                              } else { */

                            $leave_days = array($new_group_id, $employee_username, $days[0], '00.00', '24.00', $type, $comments, $alloc_employee, '0');
                            //}
                        }
                        $this->tables = array('leave');
                        /* if ($enter_user_role == 1) {

                          $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'appr_date', 'status');
                          } else { */

                        $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'status');
                        //}
                        $this->field_values = $leave_days;
                        if ($this->query_insert()) {
                            $this->commit_transaction();
                            $recipents = $this->employee_leave_recipients($employee_username, $type);

                            if (!empty($recipents)) {
                                //sending email
                                $employe_data = $this->get_employee_detail($employee_username);
                                $mail_message = 'Anställd: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'] . '<br/>';
                                $mail_message .= 'Frånvaro typ: ' . $leave_type[$type] . '<br/>';
                                $mail_message .= $mail_message_days;
                                $mail_subject = 'Frånvaro meddelande: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                                $mail = new SimpleMail($mail_subject, $mail_message);
                                $mail->addSender("Cirrus");
                                foreach ($recipents as $recipent) {

                                    if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {

                                        $mail->addRecipient($recipent['email']);
                                    }
                                }
                                //sending sms
                                $sms_message = '%0A' . $leave_type[$type] . ' : ' . $employe_data['first_name'] . '%20' . $employe_data['last_name'] . '%0A';
                                $sms_message .= $sms_message_days;
                                $sms = new sms($sms_message);
                                foreach ($recipents as $recipient) {
                                    if ($recipient['mobile'] != '' && $recipient['mobile_notification'] == 1) {
                                        $sms->addRecipient($recipient['mobile']);
                                    }
                                }
                                if ($sms->recipients && $mail->recipients) {
                                    if ($sms->send() && $mail->send()) {
                                        return TRUE;
                                    } else {
                                        return FALSE;
                                    }
                                } else {
                                    return TRUE;
                                }
                            } else {
                                return TRUE;
                            }
                        } else {
                            $this->rollback_transaction();
                            return FALSE;
                        }
                    } else {
                        $this->rollback_transaction();
                        return FALSE;
                    }
                } else {
                    $this->rollback_transaction();
                    return FALSE;
                }
            } else {
                $mail_message_days = 'Datum och pass: ';
                $sms_message_days = '';
                //getting group id
                $this->tables = array('leave');
                $this->fields = array('MAX(group_id) AS group_id');
                $this->query_generate();
                $data = $this->query_fetch(2);
                $new_group_id = (int) ($data[0]) + 1;
                $this->begin_transaction();
                $days = $date_calc->get_days($date_from, $date_to);
                if (count($days) > 1) {
                    $leave_days = array();
                    foreach ($days as $day) {

                        $mail_message_days .= $day . ' : 00.00-24.00 (24h)<br/>';
                        $sms_message_days .= 'Datum: ' . $day . '%0APass: 00.00-24.00%0A';
                        /* if ($enter_user_role == 1) {

                          $leave_days[] = array($new_group_id, $employee_username, $day, '00.00', '24.00', $type, $comments, $alloc_employee, $appr_date, '1');
                          } else { */

                        $leave_days[] = array($new_group_id, $employee_username, $day, '00.00', '24.00', $type, $comments, $alloc_employee, '0');
                        //}
                    }
                } else {
                    $mail_message_days .= $days[0] . ' : 00.00-24.00 (24h)<br/>';
                    $sms_message_days .= 'Datum: ' . $days[0] . '%0APass: 00.00-24.00%0A';
                    /* if ($enter_user_role == 1) {

                      $leave_days = array($new_group_id, $employee_username, $days[0], '00.00', '24.00', $type, $comments, $alloc_employee, $appr_date, '1');
                      } else { */

                    $leave_days = array($new_group_id, $employee_username, $days[0], '00.00', '24.00', $type, $comments, $alloc_employee, '0');
                    //}
                }
                $this->tables = array('leave');
                /* if ($enter_user_role == 1) {

                  $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'appr_date', 'status');
                  } else { */

                $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'status');
                //}
                $this->field_values = $leave_days;
                if ($this->query_insert()) {
                    $this->commit_transaction();
                    $recipents = $this->employee_leave_recipients($employee_username, $type);
                    if (!empty($recipents)) {
                        //sending email
                        $employe_data = $this->get_employee_detail($employee_username);
                        $mail_message = 'Anställd: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'] . '<br/>';
                        $mail_message .= 'Frånvaro typ: ' . $leave_type[$type] . '<br/>';
                        $mail_message .= $mail_message_days;
                        $mail_subject = 'Frånvaro meddelande: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                        $mail = new SimpleMail($mail_subject, $mail_message);
                        $mail->addSender("Cirrus");
                        foreach ($recipents as $recipent) {

                            if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {
                                $mail->addRecipient($recipent['email']);
                            }
                        }
                        //sending sms
                        $sms_message = '%0A' . $leave_type[$type] . ' : ' . $employe_data['first_name'] . '%20' . $employe_data['last_name'] . '%0A';
                        $sms_message .= $sms_message_days;
                        $sms = new sms($sms_message);
                        foreach ($recipents as $recipient) {
                            if ($recipient['mobile'] != '' && $recipient['mobile_notification'] == 1) {
                                $sms->addRecipient($recipient['mobile']);
                            }
                        }
                        if ($sms->recipients && $mail->recipients) {
                            if ($sms->send() && $mail->send()) {
                                return TRUE;
                            } else {
                                return FALSE;
                            }
                        } else {
                            return TRUE;
                        }
                    } else {
                        return TRUE;
                    }
                } else {
                    $this->rollback_transaction();
                    return FALSE;
                }
            }
        } else {
            return FALSE;
        }
    }

    function employee_leave_recipients($employee_username, $leave_type) {

        $recipients = array();
        //getting administrator role
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username');
        $this->conditions = array('role = 1');
        $this->query_generate();
        $sql_query_admin_in = $this->sql_query;


        $this->tables = array('employee');
        $this->fields = array('username', 'email', 'mobile');
        $this->conditions = array('AND', 'status = 1', array('IN', 'username', $sql_query_admin_in));
        $this->query_generate();
        $admin_datas = $this->query_fetch();

        //getting teamleader
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?');
        $this->query_generate();
        $sql_query_customer = $this->sql_query;

        $this->tables = array('team');
        $this->fields = array('employee');
        $this->conditions = array('AND', array('IN', 'customer', $sql_query_customer), array('OR', 'role = 2', 'role = 7'));
        $this->condition_values = array($employee_username);
        $this->query_generate();
        $sql_query_team_leader = $this->sql_query;

        $this->tables = array('employee');
        $this->fields = array('username', 'email', 'mobile');
        $this->conditions = array('AND', 'status = 1', array('IN', 'username', $sql_query_team_leader));
        $this->query_generate();
        $team_leader_datas = $this->query_fetch();

        $recipient_datas = array_merge($admin_datas, $team_leader_datas);

        //print_r($recipient_datas);
        if (!empty($recipient_datas)) {

            foreach ($recipient_datas as $recipient_data) {

                //getting notification privilege for email
                $this->tables = array('leave_notification');
                $this->fields = array('employee');
                $this->conditions = array('AND', 'employee = ?', 'email LIKE ?');
                $this->condition_values = array($recipient_data['username'], '%' . $leave_type . ',%');
                $this->query_generate(); //echo $this->sql_query;
                $data_notification = $this->query_fetch();
                $mail_notification = 0;
                if (!empty($data_notification)) {
                    $mail_notification = 1;
                }
                //getting notification privilege for mobile
                $this->tables = array('leave_notification');
                $this->fields = array('employee');
                $this->conditions = array('AND', 'employee = ?', 'mobile LIKE ?');
                $this->condition_values = array($recipient_data['username'], '%' . $leave_type . ',%');
                $this->query_generate(); //echo $this->sql_query;
                $data_notification = $this->query_fetch();
                $mobile_notification = 0;
                if (!empty($data_notification)) {
                    $mobile_notification = 1;
                }
                $recipients[] = array('username' => $recipient_data['username'], 'email' => $recipient_data['email'], 'mobile' => $recipient_data['mobile'], 'email_notification' => $mail_notification, 'mobile_notification' => $mobile_notification);
            }
            if (!empty($recipients))
                return $recipients;
            else
                return array();
        }else {
            return array();
        }

        //print_r($recipients);
    }

    function employee_add_leave_slot($employee_username, $date, $time_from, $time_to, $type, $comments = NULL) {
        if($time_to == 0)
            $time_to = 24.00;
        $this->tables = array('leave');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')));
        $this->condition_values = array($employee_username, $date, (float)$time_from, (float)$time_to, (float)$time_from, (float)$time_to, (float)$time_from, (float)$time_to);
        $this->query_generate();
        
        $data = $this->query_fetch();
        if ($data[0]['id'] == "" || $data[0]['id'] == NULL) {
            
            $leave_type = array(
                '1' => 'Sjuk',
                '2' => 'Sem',
                '3' => 'VAB',
                '4' => 'FP',
                '5' => 'P-möte',
                '6' => 'Utbild',
                '7' => 'Övrigt',
                '8' => 'Byte'
            );
            $alloc_employee = $_SESSION['user_id'];
            $user = new user();
            $enter_user_role = $user->user_role($alloc_employee);
            $appr_date = date('Y-m-d');
            $this->tables = array('timetable');
            $this->fields = array('id');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), 'employee = ?', 'date = ?', 'time_to >= ?');
            $this->query_generate();
            $query_inner = $this->sql_query;

            $this->tables = array('timetable');
            $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment');
            $this->conditions = array('AND', array('IN', 'status', '0,1'), 'employee = ?', 'date = ?', 'time_from <= ?', array('IN', 'id', $query_inner));
            $this->condition_values = array($employee_username, $date, (float) $time_to, $employee_username, $date, (float) $time_from);
            $this->order_by = array('time_from');
            $this->query_generate();
            $slot_datas = $this->query_fetch();
            //print_r($slot_datas);
            if (!empty($slot_datas)) {
                
                $flag = 0;
                $this->begin_transaction();
                foreach ($slot_datas as $slot_data) {

                    $slot_id = $slot_data['id'];
                    $slot_from_time = $slot_data['time_from'];
                    $slot_to_time = $slot_data['time_to'];
                    if ($slot_from_time >= $time_from) { //= is added by shaju
                        
                        if ($slot_to_time > $time_to) {
                            
                            //splitting slots
                            $this->tables = array('timetable');
                            $this->fields = array('time_to', 'status');
                            $this->field_values = array((float) $time_to, '2');
                            $this->conditions = array('id = ?');
                            $this->condition_values = array($slot_id);
                            if ($this->query_update()) {

                                //duplicatig leave entry
                                $this->tables = array('timetable');
                                $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp', 'relation_id');
                                $this->field_values = array($slot_data['customer'], $slot_data['date'], $slot_data['time_from'], (float) $time_to, $slot_data['type'], '0', $slot_data['comment'], $alloc_employee, $slot_id);
                                if ($this->query_insert()) {

                                    //insert remaining time slot
                                    $this->tables = array('timetable');
                                    $this->fields = array('employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp');
                                    $this->field_values = array($slot_data['employee'], $slot_data['customer'], $slot_data['date'], (float) $time_to, $slot_to_time, $slot_data['type'], $slot_data['status'], $slot_data['comment'], $alloc_employee);
                                    if (!$this->query_insert()) {

                                        $flag++;
                                    }
                                } else {

                                    $flag++;
                                }
                            } else {

                                $flag++;
                            }
                        } else {
                            
                            $this->tables = array('timetable');
                            $this->fields = array('status');
                            $this->field_values = array('2');
                            $this->conditions = array('id = ?');
                            $this->condition_values = array($slot_id);
                            if ($this->query_update()) {
                                
                                //duplicatig leave entry
                                $this->tables = array('timetable');
                                $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp', 'relation_id');
                                $this->field_values = array($slot_data['customer'], $slot_data['date'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['type'], '0', $slot_data['comment'], $alloc_employee, $slot_id);
                                if (!$this->query_insert()) {
                                    
                                    $flag++;
                                }
                            } else {
                                
                                $flag++;
                            }
                        }
                    } else {

                        if ($slot_to_time > $time_to) {

                            //splitting slots
                            $this->tables = array('timetable');
                            $this->fields = array('time_from', 'time_to', 'status');
                            $this->field_values = array((float) $time_from, (float) $time_to, '2');
                            $this->conditions = array('id = ?');
                            $this->condition_values = array($slot_id);
                            if ($this->query_update()) {

                                //duplicatig leave entry
                                $this->tables = array('timetable');
                                $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp', 'relation_id');
                                $this->field_values = array($slot_data['customer'], $slot_data['date'], (float) $time_from, (float) $time_to, $slot_data['type'], '0', $slot_data['comment'], $alloc_employee, $slot_id);
                                if ($this->query_insert()) {

                                    //insert remaining time slot
                                    $this->tables = array('timetable');
                                    $this->fields = array('employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp');
                                    $this->field_values = array($slot_data['employee'], $slot_data['customer'], $slot_data['date'], (float) $time_to, $slot_to_time, $slot_data['type'], $slot_data['status'], $slot_data['comment'], $alloc_employee);
                                    if (!$this->query_insert()) {

                                        $flag++;
                                    }
                                    if ($time_from > $slot_from_time) {

                                        //insert remaining time slot
                                        $this->tables = array('timetable');
                                        $this->fields = array('employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp');
                                        $this->field_values = array($slot_data['employee'], $slot_data['customer'], $slot_data['date'], $slot_from_time, (float) $time_from, $slot_data['type'], $slot_data['status'], $slot_data['comment'], $alloc_employee);
                                        if (!$this->query_insert()) {

                                            $flag++;
                                        }
                                    }
                                } else {

                                    $flag++;
                                }
                            } else {

                                $flag++;
                            }
                        } else {

                            $this->tables = array('timetable');
                            $this->fields = array('time_from','status'); //time from added by shaju
                            $this->field_values = array($time_from,'2');//time from added by shaju
                            $this->conditions = array('id = ?');
                            $this->condition_values = array($slot_id);
                            if ($this->query_update()) {

                                //duplicatig leave entry
                                $this->tables = array('timetable');
                                $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp', 'relation_id');
                                $this->field_values = array($slot_data['customer'], $slot_data['date'], $time_from, $slot_data['time_to'], $slot_data['type'], '0', $slot_data['comment'], $alloc_employee, $slot_id);//time_from added by shaju
                                if (!$this->query_insert()) {

                                    $flag++;
                                }
                                if ($time_from > $slot_from_time) {

                                    //insert remaining time slot
                                    $this->tables = array('timetable');
                                    $this->fields = array('employee', 'customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp');
                                    $this->field_values = array($slot_data['employee'], $slot_data['customer'], $slot_data['date'], $slot_from_time, (float) $time_from, $slot_data['type'], $slot_data['status'], $slot_data['comment'], $alloc_employee);
                                    if (!$this->query_insert()) {

                                        $flag++;
                                    }
                                }
                            } else {

                                $flag++;
                            }
                        }
                    }
                }

                if ($flag == 0) {

                    //entry on leave table
                    $mail_message_days = 'Datum och pass: ';
                    $sms_message_days = '';
                    //getting group id
                    $this->tables = array('leave');
                    $this->fields = array('MAX(group_id) AS group_id');
                    $this->query_generate();
                    $data = $this->query_fetch(2);
                    $new_group_id = (int) ($data[0]) + 1;
                    $this->tables = array('leave');
                    /* if ($enter_user_role == 1) {

                      $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'appr_date', 'status');
                      } else { */

                    $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'status');
                    //}
                    $mail_message_days .= $date . ' : ' . str_pad($time_from, 5, '0', STR_PAD_LEFT) . '-' . str_pad($time_to, 5, '0', STR_PAD_LEFT) . ' (' . ($time_to - $time_from) . 'h)' . '<br/>';
                    $sms_message_days .= 'Datum: ' . $date . '%0APass: ' . $time_from . '-' . $time_to . '%0A';
                    /* if ($enter_user_role == 1) {

                      $this->field_values = array($new_group_id, $employee_username, $date, (float) $time_from, (float) $time_to, $type, $comments, $alloc_employee, $appr_date, '1');
                      } else { */

                    $this->field_values = array($new_group_id, $employee_username, $date, (float) $time_from, (float) $time_to, $type, $comments, $alloc_employee, '0');
                    //}
                    if ($this->query_insert()) {

                        $this->commit_transaction();
                        $recipents = $this->employee_leave_recipients($employee_username, $type);
                        //print_r($recipents);

                        if (!empty($recipents)) {

                            //sending email
                            $employe_data = $this->get_employee_detail($employee_username);
                            $mail_message = 'Anställd: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'] . '<br/>';
                            $mail_message .= 'Frånvaro typ: ' . $leave_type[$type] . '<br/>';
                            $mail_message .= $mail_message_days;
                            $mail_subject = 'Datum och tid: ' . $employe_data['first_name'] . ' ' . $employe_data['last_name'];
                            $mail = new SimpleMail($mail_subject, $mail_message);
                            $mail->addSender("Cirrus");
                            foreach ($recipents as $recipent) {

                                if ($recipent['email'] != '' && $recipent['email_notification'] == 1) {

                                    $mail->addRecipient($recipent['email']);
                                }
                            }

                            //sending sms
                            $sms_message = '%0A' . $leave_type[$type] . ' : ' . $employe_data['first_name'] . '%20' . $employe_data['last_name'] . '%0A';
                            $sms_message .= $sms_message_days;
                            $sms = new sms($sms_message);
                            foreach ($recipents as $recipient) {
                                if ($recipient['mobile'] != '' && $recipient['mobile_notification'] == 1) {
                                    $sms->addRecipient($recipient['mobile']);
                                }
                            }
                            if ($sms->recipients && $mail->recipients) {
                                if ($sms->send() && $mail->send()) {
                                    return TRUE;
                                } else {
                                    return FALSE;
                                }
                            } else {
                                return TRUE;
                            }
                        } else {
                            return TRUE;
                        }
                    } else {

                        $this->rollback_transaction();
                        return FALSE;
                    }
                } else {

                    $this->rollback_transaction();
                    return FALSE;
                }
            } else {

                return FALSE;
            }
        } else {
            
            return FALSE;
        }
    }

    function team_members($username) {
        $user = new user();
        $user_role = $user->user_role($username);
        $cust_query = '';
        if($user_role == 4){
            $cust_query = "'".$username."'";
        }    
        else{
            $this->tables = array('team');
            $this->fields = array('DISTINCT customer AS customer');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($username);
            $this->query_generate();
            $cust_query = $this->sql_query;
            $data = $this->query_fetch();
        }    
        if (count($data) || $user_role == 4) {

            $this->tables = array('team');
            $this->fields = array('DISTINCT employee AS employee');
            $this->conditions = array('IN', 'customer', $cust_query);
            $this->condition_values = array($username);
            $this->query_generate();
            $data = $this->query_fetch(2);
        } else {

            $data = array('employee' => $username);
        }
        return $data;
        
    }

    function get_username($name) {

        $this->tables = array('login');
        $this->fields = array('MAX(username) as username');
        $this->conditions = array('username LIKE ?');
        $this->condition_values = array($name . '%');
        $this->query_generate();
        $data = $this->query_fetch(1);
        if (!empty($data)) {
            $max_count_user = substr($data[0]['username'], (strlen($data[0]['username']) - 3), 3);
            $max_count = $max_count_user + 1;
            $count = sprintf('%03d', $max_count);
            $username = $name . $count;
        } else {
            $count = '001';
            $username = $name . $count;
        }

        return $username;
    }

    function login_add() {

        global $preference, $db;
        $this->tables = array('' . $db['database_master'] . '.login');
        $this->fields = array('username');
        $this->conditions = array('social_security = ?');
        $this->condition_values = array($this->social_security);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['username'])
            return TRUE;

        if ($this->username != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array('' . $db['database_master'] . '.login');
            if ($this->password != NULL) {
                $this->fields = array('username', 'mobile', 'social_security', 'password', 'role', 'login', 'date', 'company_ids');
                $this->field_values = array($this->username, $this->mobile, $this->social_security, md5($this->hash . $this->password), $this->role, $this->login, date('Y-m-d'), $this->company_id . ',');
            } else {
                $this->fields = array('username', 'mobile', 'social_security', 'role', 'login', 'date', 'company_ids');
                $this->field_values = array($this->username, $this->mobile, $this->social_security, $this->role, $this->login, date('Y-m-d'), $this->company_id . ',');
            }
            if ($this->query_insert()) {
                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function login_update() {

        global $preference, $db;
        if ($this->username != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array('' . $db['database_master'] . '.login');
            if ($this->password != NULL) {
                $this->fields = array('password', 'mobile', 'role', 'error');
                $this->field_values = array(md5($this->hash . $this->password), $this->mobile, $this->role, '0');
            } else {
                $this->fields = array('role', 'mobile');
                $this->field_values = array($this->role, $this->mobile);
            }
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            if ($this->query_update()) {
                $this->sql_query;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function employee_work($username) {

        $this->tables = array('employee');
        $this->fields = array('works');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        $work_det = array();
        if (!empty($data)) {

            $works = explode(',', $data[0]['works']);
            foreach ($works as $work) {
                if ($work['id'])
                    $work_det[] = array('id' => $work['id'], 'name' => $this->get_work_details($work['id']));
            }
            return $work_det;
        } else {

            return FALSE;
        }
    }

    function employee_add() {

        global $db;
        $this->tables = array('employee');
        $this->fields = array('username');
        $this->conditions = array('social_security = ?');
        $this->condition_values = array($this->social_security);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data[0]['username'])
            return TRUE;
        if ($this->username != NULL) {

            $this->tables = array('employee');
            $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status');
            $this->field_values = array($this->username, $this->century, $this->code, $this->social_security, $this->first_name, $this->last_name, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date, $this->color_code, $this->status);

            if ($this->query_insert()) {

                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function employee_update() {

        if ($this->username != NULL) {

            $this->tables = array('employee');
            $this->fields = array('code', 'century', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status');
            $this->field_values = array($this->code, $this->century, $this->social_security, $this->first_name, $this->last_name, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date, $this->color_code, $this->status);
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            if ($this->query_update()) {

                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function company_update() {

        global $db;
        if ($this->company_id != NULL) {

            $this->tables = array('' . $db['database_master'] . '.login');
            $this->fields = array('company_ids=CONCAT(`company_ids`,?)');
            $this->field_values = array($this->company_id . ',');
            $this->conditions = array('social_security = ? AND company_ids NOT LIKE ?');
            $this->condition_values = array($this->social_security, '%' . $this->company_id . ',%');
            if ($this->query_update(1)) {

                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function team_member_add() {

        if ($this->team_members != NULL) {

            $this->tables = array('team');
            $this->fields = array('members');
            $this->field_values = array($this->team_members);
            $this->conditions = array('id = ?');
            $this->condition_values = array($this->team_id);
            if ($this->query_update()) {

                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function team_member_update($members, $cur_team) {

        if ($this->username != NULL) {

            $this->tables = array('team');
            $this->fields = array('members');
            $this->field_values = array($members);
            $this->conditions = array('id = ?');
            $this->condition_values = array($cur_team);
            if ($this->query_update()) {

                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }

    function tl_update($cur_team = NULL) {

        $this->tables = array('team');
        $this->fields = array('tl');
        if ($cur_team == NULL) {
            $this->field_values = array($this->tl);
            $this->conditions = array('id = ?');
            $this->condition_values = array($this->team_id);
        } else {

            $this->field_values = array("");
            $this->conditions = array('id = ?');
            $this->condition_values = array($cur_team);
        }
        if ($this->query_update()) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    /* function work_list() {

      $this->tables = array('work');
      $this->fields = array('id', 'name');
      $this->query_generate();
      $result = $this->query_fetch();
      $datas = $this->makeArray($result);

      if (!empty ($datas))
      return $datas;
      else
      return FALSE;
      }
      function makeArray($datas = array()){

      $data_array = array();
      foreach ($datas as $data){

      $data_array[$data['id']] = $data['name'];
      }
      return $data_array;
      } */

    function get_week() {

        global $week;
        return$week;
    }

    function employee_detail($username = NULL) {

        $this->tables = array('employee');
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status');
        if ($this->first_name != NULL) {
            $this->conditions = array('AND', 'first_name LIKE ?');
            $this->condition_values = array($this->first_name . "%");
        } else {
            $this->conditions = array('AND', array('IN', 'username', $username));
        }
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();

        $color = $datas[0]['color'];
        $rgb = $this->hex_to_rgb($color);
        $datas[0]['color'] = $rgb;
        return $datas;
    }

    function get_employee_detail($username) {

        $this->tables = array('employee');
        $this->fields = array('username', 'century' ,'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        $color = $datas[0]['color'];
        $rgb = $this->hex_to_rgb($color);
        $datas[0]['color'] = $rgb;
        return $datas[0];
    }
    
    function employee_detail_main($username) {

        $this->tables = array('employee');
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status');
        $this->conditions = array('AND','username = ?');
        $this->condition_values = array($username);
        
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();

        $color = $datas[0]['color'];
        $rgb = $this->hex_to_rgb($color);
        $datas[0]['color'] = $rgb;
        return $datas;
    }

    function get_available_works() {

        $this->tables = array('work');
        $this->fields = array('id', 'name');
        if ($this->works != NULL) {
            $this->conditions = array('AND', array('NOT IN', 'id', $this->works));
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_assigned_works() {

        $this->tables = array('work');
        $this->fields = array('id', 'name');
        $this->conditions = array('AND', array('IN', 'id', $this->works));
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_available_team($current_team = NULL) {

        $this->tables = array('team');
        $this->fields = array('id', 'name', 'tl', 'members');
        if ($current_team != NULL) {
            $this->conditions = array('AND', array('NOT IN', 'id', $current_team));
            $this->query_generate();
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_name($username) {
        $employee_detail = $this->employee_detail($username);
        return $name = $employee_detail[0]['first_name'] . ' ' . $employee_detail[0]['last_name'];
    }

    function get_selected_team_member($cur_team = NULL) {

        $this->tables = array('team');
        $this->fields = array('members');
        $this->conditions = array('id = ?');
        if ($cur_team != NULL) {
            $this->condition_values = array($cur_team);
        } else {
            $this->condition_values = array($this->team_id);
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_current_team() {

        $this->tables = array('team');
        $this->fields = array('id', 'name', 'members', 'tl');
        if ($this->role == '3') {
            $this->conditions = array('members LIKE ?');
            $this->condition_values = array('%' . $this->username . '%');
        } else {
            $this->conditions = array('tl = ?');
            $this->condition_values = array($this->username);
        }
        $this->query_generate();

        $datas = $this->query_fetch();

        return $datas;
    }

    function get_all_employee_leave($employee, $year = NULL, $month = NULL) {



        $this->tables = array('leave', 'employee');
        $this->fields = array('leave.id', 'leave.type', 'date(leave.apply_date) as apply_date', 'leave.employee',
            "concat(employee.first_name,' ',employee.last_name) as empname", 'leave.status', 'leave.appr_date', 'leave.appr_emp',
            "concat(employee.first_name,' ',employee.last_name) as appr_empname");
        if ($year != NULL && $month != NULL) {
            $this->conditions = array('AND', 'leave.employee = ?', 'year(leave.apply_date) = ?', 'month(leave.apply_date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like employee.username');
            $this->condition_values = array($employee, $year, $month);
        } elseif ($year != NULL && $month == NULL) {
            $this->conditions = array('AND', 'leave.employee = ?', 'year(leave.apply_date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like employee.username');
            $this->condition_values = array($employee, $year);
        } elseif ($year == NULL && $month != NULL) {
            $this->conditions = array('AND', 'leave.employee = ?', 'month(leave.apply_date) = ?', 'leave.employee like employee.username', 'leave.appr_emp like employee.username');
            $this->condition_values = array($employee, $month);
        } else {
            $this->conditions = array('leave.employee = ?', 'leave.employee like employee.username', 'leave.appr_emp like employee.username');
            $this->condition_values = array($employee);
        }
        $this->order_by = array('leave.date');
        $this->query_generate();
//        echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_leave_year($employee) {
        $this->tables = array('leave');
        $this->fields = array('year(apply_date) as year');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        $this->group_by = array('year(apply_date)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    /* ---------------------------------------------------shaju------------------------------------ */

    //removing employee from a particular slot
    function remove_from_slot($id, $alloc_emp) {

        $this->tables = array('timetable');
        $this->fields = array('employee', 'status', 'alloc_emp');
        $this->field_values = array(NULL, '0', $alloc_emp);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }

    //getting slots in memory
    function get_memory_slots($employee, $date, $customer = '') {

        //getting assigned slots
        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from', 'time_to');
        $this->conditions = array('AND', 'employee = ?', 'date = ?');
        $this->condition_values = array($employee, $date);
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $assigned_slots = $this->query_fetch();

        //getting leave slots
        $this->tables = array('leave');
        $this->fields = array('id', 'time_from', 'time_to');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', 'status=?');
        $this->condition_values = array($employee, $date, '1');
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $leave_slots = $this->query_fetch();
        
        $cust_query = '';
        if($customer == ''){
                        
            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('employee = ?');
            $this->query_generate();
            $cust_query = $this->sql_query;
        }
        
        $this->tables = array('memory_slots');
        $this->fields = array('distinct time_from', 'time_to', 'id');
        if ($customer != '') {
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer);
        }
        else{
            if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7){
                $this->conditions = array('AND', array('IN', 'customer', $cust_query), array('IN', 'customer',$cust_query));
                $this->condition_values = array($employee,$_SESSION['user_id']);
            }else if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 5 || $_SESSION['user_role'] == 6){
                $this->conditions = array('AND', array('IN', 'customer', $cust_query));
                $this->condition_values = array($employee);
            }    
        }
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        $memory_slots = array();
        foreach ($datas as $free_slots) {
            $memory_flag = true;
            foreach ($assigned_slots as $occ_slots) {
                if (($free_slots['time_from'] >= $occ_slots['time_from'] && $free_slots['time_from'] < $occ_slots['time_to']) || ($free_slots['time_to'] > $occ_slots['time_from'] && $free_slots['time_from'] < $occ_slots['time_to'])) {
                    $memory_flag = false;
                }
            }
            if ($memory_flag) {
                foreach ($leave_slots as $occ_slots) {
                    if (($free_slots['time_from'] >= $occ_slots['time_from'] && $free_slots['time_from'] < $occ_slots['time_to']) || ($free_slots['time_to'] > $occ_slots['time_from'] && $free_slots['time_from'] < $occ_slots['time_to'])) {
                        $memory_flag = false;
                    }
                }
                if ($memory_flag) {
                    $memory_slots[] = array('id' => $free_slots['id'], 'time_from' => $free_slots['time_from'], 'time_to' => $free_slots['time_to']);
                }
            }
        }
        return $memory_slots;
    }

    function employee_contract_week($employee, $year_week) {

//calculating start date and end date
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->tables = array('employee_contract');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', 'date_to >= ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('employee_contract');
        $this->fields = array('date_from', 'date_to', 'DATEDIFF(date_to,date_from) AS days', 'hour');
        $this->conditions = array('AND', 'employee = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
        $this->condition_values = array($employee, $end_date, $employee, $start_date);
        $this->order_by = array('date_from');
        $this->query_generate();
        $contract_data = $this->query_fetch();
        if (!empty($contract_data)) {

            return $contract_data;
        } else {

            return FALSE;
        }
    }

    function employee_timetable_week_time($employee, $year_week, $fkkn = NULL) {

        global $week;
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $total_alloc_time = 0;
        $date_from = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
        $date_to = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));
        //getting time for the week slot type include normal,travel,break
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {

            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), array('IN', 'type', '0,1,2,4,5,6,7'));
            $this->condition_values = array($employee, $date_from, $date_to, $fkkn);
        } else {

            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'), array('IN', 'type', '0,1,2,4,5,6,7'));
            $this->condition_values = array($employee, $date_from, $date_to);
        }
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $normal_time = $time_data['total_time'];

        //getting time for the week sloat type oncall
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {

            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), 'type = 3');
            $this->condition_values = array($employee, $date_from, $date_to, $fkkn);
        } else {

            $this->conditions = array('AND', 'employee = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'), 'type = 3');
            $this->condition_values = array($employee, $date_from, $date_to);
        }
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $oncall_time = 0;
        if ($time_data['total_time'] != '' && $time_data['total_time'] > 0) {
            //$oncall_time = round(($time_data['total_time'] / 4), 2);
            $oncall_time = $time_data['total_time'];//edited by shaju full hour on oncall not 1/4th
        }

        $total_alloc_time = $normal_time + $oncall_time;

        return $total_alloc_time;
    }

    function employee_contract_week_hour($employee, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $employee_contracts = $this->employee_contract_week($employee, $year_week);

        if ($employee_contracts) {

//getting customer contacts
            $contract_hour_week = 0;
            $week_days = 7;
            foreach ($employee_contracts as $employee_contract) {

                $contract_hour_day = round(($employee_contract['hour'] / ($employee_contract['days'] + 1)), 2);
                if (strtotime($end_date) > strtotime($employee_contract['date_to'])) {

                    $day_before = (((strtotime($employee_contract['date_to']) - strtotime($start_date)) / (24 * 60 * 60)) + 1);
                    $week_days -= $day_before;
                    $contract_hour_week += ($day_before * $contract_hour_day);
                } else if (strtotime($start_date) < strtotime($employee_contract['date_from'])) {

                    $contract_hour_week += ($week_days * $contract_hour_day);
                } else {

                    $contract_hour_week = $contract_hour_day * $week_days;
                }
            }
            return round($contract_hour_week, 2);
        } else {

            return FALSE;
        }
    }

    function get_available_users($customer, $time_from, $time_to, $date) {
        
        //from timetable not slots not colliding
        $cur_date = strtotime($date . ' 00:00:00');
        $this->tables = array('timetable');
        $this->fields = array('distinct employee');
        $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee!=?', 'status!=?');
        //$this->condition_values = array((float)$time_from, (float)$time_to, (float)$time_from,(float)$time_to,(float)$time_from,(float)$time_to,$date,'','2');

        $this->query_generate();
        //echo $this->sql_query;
        //$d = $this->query_fetch();
        //print_r($d);

        $not_emp_query = $this->sql_query;
        
        //excluding leave employee
        $this->tables = array('leave');
        $this->fields = array('distinct employee');
        $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'status=?');

        //$this->condition_values = array((float)$time_from, (float)$time_to, (float)$time_from,(float)$time_to,(float)$time_from,(float)$time_to,$date);
        $this->query_generate();
        $not_emp_query_leave = $this->sql_query;
        
        ///in team
        $this->tables = array('team');
        $this->fields = array('employee');
        $this->conditions = array('customer=?');
        //$this->condition_values = array((float)$time_from, (float)$time_to, (float)$time_from,(float)$time_to,(float)$time_from,(float)$time_to,$date);
        $this->query_generate();
        $emp_query = $this->sql_query;
        if ($_SESSION['user_role'] == 3) {
            $emp_query = "'" . $_SESSION['user_id'] . "'";
        }
        
        // not signed in
        $date_array = explode('-', $date);
        $date_month = $date_array[1];
        $date_year = $date_array[0];
        
        $this->tables = array('report_signing');
        $this->fields = array('employee');
        $this->conditions = array('AND', 'MONTH(date) = ?', 'YEAR(date) = ?');
        //$this->condition_values = array($date_month, $date_year);
        $this->query_generate();
        $emp_query_sign = $this->sql_query;
        
        
        //$datas = $this->query_fetch();    
        $this->tables = array('employee');
        $this->fields = array('username', 'first_name', 'last_name', 'code', 'mobile');
        $this->conditions = array('AND', 'status=?', array('NOT IN', 'username', $not_emp_query), array('NOT IN', 'username', $not_emp_query_leave), array('NOT IN', 'username', $emp_query_sign), array('IN', 'username', $emp_query));
        if ($_SESSION['user_role'] == 3) {
            $this->condition_values = array('1', (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, '', '2', (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, 1, $date_month, $date_year);
        } else {

            $this->condition_values = array('1', (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, '', '2', (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, 1, $date_month, $date_year, $customer);
        }
        $this->query_generate();
//        echo $this->sql_query;

        $datas = $this->query_fetch();

        $employees = array();
        foreach ($datas as $data) {
            $contract_hour = $this->employee_contract_week_hour($data['username'], date('Y', $cur_date) . '|' . date('W', $cur_date));
            $worked_hour = $this->employee_timetable_week_time($data['username'], date('Y', $cur_date) . '|' . date('W', $cur_date));
            $employees[] = array('username' => $data['username'], 'name' => $data['first_name'] . ' ' . $data['last_name'], 'code' => $data['code'], 'contract_hour' => $contract_hour, 'worked_hour' => $worked_hour, 'mobile' => $data['mobile']);
        }

        if (count($employees)) {
            return $employees;
        } else {
            return array();
        }
        //"select username,first_name,last_name,code from employees where work like('$skill') and username not in";
        //"select employee from timetable where date='$date' and (time_from >=(float)$time_from  t and time_from < (float)$time_to) or (time_to > (float)$time_from and time_to <=(float)$time_to) (time_from<(float)$time_from and time_to>(float)$time_to)";
    }

    //checking a slot timing is valid for the user
    function is_valid_slot($employee, $time_from, $time_to, $date) {

        $this->tables = array('timetable');
        $this->fields = array('id');
        $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?');
        $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, $employee);
        $this->query_generate();


        $datas = $this->query_fetch();

        if (count($datas)) {
            return false;
        } else {
            $this->tables = array('leave');
            $this->fields = array('id');
            $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', 'status=?');
            $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, $employee, '1');
            $this->query_generate();
            $datas = $this->query_fetch();

            if (count($datas)) {
                return false;
            } else {
                return true;
            }
        }
        //"select id from timetable where  (time_from >=(float)$time_from   and time_from < (float)$time_to) or (time_to > (float)$time_from and time_to <=(float)$time_to) (time_from<(float)$time_from and time_to>(float)$time_to) and date=$date and employee";
    }

    // getting the details of a slot
    function customer_employee_slot_details($id) {
        $this->tables = array('timetable');
        $this->fields = array('id', 'customer', 'employee', 'fkkn', 'status', 'alloc_emp', 'time_from', 'time_to', 'type', 'date', 'relation_id', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    //adding skill
    function employee_add_skill($id, $work, $alloc_emp) {

        $slot_det = $this->customer_employee_slot_details($id);
        $status = 1;
        if ($slot_det['customer'] == '' || $slot_det['employee'] == '')
            $status = 0;
        $this->tables = array('timetable');
        $this->fields = array('work', 'status', 'alloc_emp');
        $this->field_values = array($work, $status, $alloc_emp);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }

    //add employee to an existing slot
    function employee_add_to_slot($id, $select_emp, $alloc_emp) {
        $msg = new message();
        $slot_det = $this->customer_employee_slot_details($id);
        $status = $slot_det['status'];

        if ($status != 3 && $slot_det['customer'] != '')
            $status = 1;
        $this->checkATL($select_emp, $slot_det['date'], $slot_det['time_from'], $slot_det['time_to']);


        $this->tables = array('timetable');
        $this->fields = array('status', 'employee', 'alloc_emp');
        $this->field_values = array($status, $select_emp, $alloc_emp);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }

    function employee_detail_list($date = NULL) {

        global $leave_type;
        $employees = $this->employee_list();
        $employees_list = array();
        foreach ($employees as $employee) {

            if ($date != NULL && $date != '') {

                $username = $employee['username'];
                $this->tables = array('leave');
                $this->fields = array('id', 'type');
                $this->conditions = array('AND', 'date = ?', 'employee = ?', 'status = ?');
                $this->condition_values = array($date, $username, 1);
                $this->query_generate();
                $datas = $this->query_fetch();
                if (!empty($datas)) {

                    $employees_list[] = array('username' => $employee['username'], 'name' => $employee['first_name'] . ' ' . $employee['last_name'], 'leave' => 1);
                } else {

                    $employees_list[] = array('username' => $employee['username'], 'name' => $employee['first_name'] . ' ' . $employee['last_name'], 'leave' => 0);
                }
            } else {

                $employees_list[] = array('username' => $employee['username'], 'name' => $employee['first_name'] . ' ' . $employee['last_name'], 'leave' => 0);
            }
        }
        return $employees_list;
    }

    function employee_data($username) {

        $this->tables = array('employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'post', 'city', 'phone', 'address');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function company_data() {

        $id = $_SESSION['company_id'];
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function employee_privilege() {

        $user = new user();
        $customer = new customer();
        $privileges = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $customers = $customer->customer_list();
        $employees = $this->employee_list();
        switch ($login_user_role) {

            case 1:
                foreach ($customers as $customer) {

                    $privileges[$customer['username']] = array('link' => 1);
                }
                foreach ($employees as $employee) {

                    $privileges[$employee['username']] = array('link' => 1);
                }
                break;

            case 2:
                $team_customers = $customer->team_customers($login_user);
                $team_members = $this->team_members($login_user);
                foreach ($customers as $customer) {

                    if (in_array($customer['username'], $team_customers)) {

                        $privileges[$customer['username']] = array('link' => 1);
                    } else {

                        $privileges[$customer['username']] = array('link' => 0);
                    }
                }
                foreach ($employees as $employee) {
                    if (in_array($employee['username'], $team_members)) {

                        $privileges[$employee['username']] = array('link' => 1);
                    } else {

                        $privileges[$employee['username']] = array('link' => 0);
                    }
                }
                break;

            case 3:
                $team_customers = $customer->team_employee_customers($login_user);
                foreach ($customers as $customer) {

                    if (in_array($customer['username'], $team_customers)) {

                        $privileges[$customer['username']] = array('link' => 1);
                    } else {

                        $privileges[$customer['username']] = array('link' => 0);
                    }
                }
                foreach ($employees as $employee) {
                    if ($employee['username'] == $login_user) {

                        $privileges[$employee['username']] = array('link' => 1);
                    } else {

                        $privileges[$employee['username']] = array('link' => 0);
                    }
                }
                break;

            case 7:
                $team_customers = $customer->team_customers($login_user);
                $team_members = $this->team_members($login_user);
                foreach ($customers as $customer) {

                    if (in_array($customer['username'], $team_customers)) {

                        $privileges[$customer['username']] = array('link' => 1);
                    } else {

                        $privileges[$customer['username']] = array('link' => 0);
                    }
                }
                foreach ($employees as $employee) {
                    if (in_array($employee['username'], $team_members)) {

                        $privileges[$employee['username']] = array('link' => 1);
                    } else {

                        $privileges[$employee['username']] = array('link' => 0);
                    }
                }
                break;

            default:
                $team_customers = $customer->team_employee_customers($login_user);
                foreach ($customers as $customer) {

                    if (in_array($customer['username'], $team_customers)) {

                        $privileges[$customer['username']] = array('link' => 1);
                    } else {

                        $privileges[$customer['username']] = array('link' => 0);
                    }
                }
                foreach ($employees as $employee) {
                    if ($employee['username'] == $login_user) {

                        $privileges[$employee['username']] = array('link' => 1);
                    } else {

                        $privileges[$employee['username']] = array('link' => 0);
                    }
                }
        }
        return $privileges;
    }

    function employee_timetable_week($employee, $year_week) {

        global $week;

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $customers = $this->employee_week_customer($employee, $year_week);
        $datas = array();
        $i = 0;
        foreach ($customers as $customer) {

            $j = 0;
            foreach ($week as $day) {

                $datas[$i][$j]['customer'] = $customer;
                $datas[$i][$j]['day'] = $day;
                $date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
                $slots = $this->timetable_customer_employee_slots($customer['username'], $employee, $date);
                $datas[$i][$j]['slots'] = $slots;
                $j++;
            }
            $i++;
        }
        return $datas;
    }

    /* -----------------------------------------shaju----------------------------------- */

    function employee_to_allocate($year_week, $user='') {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

//getting all customers
        $employees = array();
        if ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6)
            $employees = $this->employee_list_exact($user);
        else
            $employees = $this->employee_list();
        $employee_pending = array();
        foreach ($employees as $employee) {

//getting employee contacts
            $contract_hour_week = $this->employee_contract_week_hour($employee['username'], $year_week);
//getting customer allocated time
            $timetable_hour_week = $this->employee_timetable_week_time($employee['username'], $year_week);
            //if ($contract_hour_week > $timetable_hour_week) {

            $employee_pending[] = array('username' => $employee['username'], 'code' => $employee['code'], 'name' => $employee['first_name'] . ' ' . $employee['last_name'], 'allocate' => $contract_hour_week, 'allocated' => $timetable_hour_week);
            //}
        }
        if (!empty($employee_pending)) {

            return $employee_pending;
        } else {

            return FALSE;
        }
    }

    function leave_employee_week($year_week) {

        global $leave_type;

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));
        $team_employee_data='';
        
        if($_SESSION['user_role'] == 2 ){
            $team_members = $this->team_members_for_employee_report($_SESSION['user_id']);
            $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
        }else if($_SESSION['user_role'] == 7){
            $team_members = $this->super_team_members($_SESSION['user_id']);
            $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
        }else if($_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 5){
            $team_employee_data = '\''.$_SESSION['user_id']. '\'';
        }
        
        $this->tables = array('leave', 'employee');
        $this->fields = array('leave.id AS id', 'leave.employee AS employee', 'employee.first_name AS first_name', 'employee.last_name AS last_name', 'employee.code AS code', 'MIN(leave.date) AS date_from', 'MAX(leave.date) AS date_to', 'leave.type AS type', 'leave.comment AS comment');
        if($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 6)
            $this->conditions = array('AND', 'leave.employee = employee.username', 'leave.status = 1', 'leave.date >= ?', 'leave.date <= ?',array('IN', 'leave.employee', $team_employee_data));
        else    
            $this->conditions = array('AND', 'leave.employee = employee.username', 'leave.status = 1', 'leave.date >= ?', 'leave.date <= ?');
        $this->condition_values = array($start_date, $end_date);
        $this->group_by = array('group_id');
        $this->query_generate();
        $datas = $this->query_fetch();
        $leave_datas = array();
        foreach ($datas as $data) {

            if ($data['date_from'] == $data['date_to']) {
                $date = $data['date_from'];
            } else {
                $date = $data['date_from'] . '-' . $data['date_to'];
            }
            $leave_datas[] = array('id' => $data['id'], 'employee' => $data['employee'], 'name' => $data['first_name'] . " " . $data['last_name'], 'code' => $data['code'], 'type' => $leave_type[$data['type']], 'date' => $date, 'comment' => $data['comment']);
        }
        return $leave_datas;
    }

    function employee_leave_day($employee, $date) {

        $this->tables = array('leave');
        $this->fields = array('id', 'type', 'comment', 'appr_emp', 'appr_comment');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', 'status = ?');
        $this->condition_values = array($employee, $date, 1);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function timetable_customer_employee_time($customer_username, $employee_username, $date, $carry_fwd = 0) {

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2) AS total_time', 'time_to');
        $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'date = ?', 'status = 1');
        $this->condition_values = array($customer_username, $employee_username, $date);
        $this->group_by = array('employee');
        $this->query_generate();
        $data_time_tmp = $this->query_fetch();
        $time_data = $data_time_tmp[0];
        $total_time = ($time_data['total_time'] + $carry_fwd);
        /*
          //checking overlapping time
          if ($time_data['time_to'] > 24) {

          $cur_carry_fwd = ($time_data['time_to'] - 24);
          $total_time -= $cur_carry_fwd;
          } else {

          $cur_carry_fwd = 0;
          }
         */
        $time = array('time' => $total_time, 'carry_fwd' => $cur_carry_fwd);
        return $time;
    }

    function timetable_week($customers, $employees, $year_week) {

        global $week;
        // $employee = new employee();
        $privileges = $this->employee_privilege();

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

//getting customer loop
        $datas = array();
        $i = 0;
        if (!empty($customers)) {

            foreach ($customers as $customer) {

//getting into employee loop
                $j = 0;
                if (!empty($employees)) {

                    foreach ($employees as $employee) {

                        $datas[$i][$j]['customer'] = $customer;
                        $datas[$i][$j]['employee'] = $employee;
                        $day_array = array();
                        //cheking the relation between customer and employee
                        $this->tables = array('team');
                        $this->fields = array('role');
                        $this->conditions = array('AND', 'employee = ?', 'customer = ?');
                        $this->condition_values = array($employee['username'], $customer['username']);
                        $this->query_generate();
                        $data = $this->query_fetch();
                        if (!empty($data)) {

                            $carry_fwd_time = 0;
                            $day_array = array();
                            foreach ($week as $day) {

                                $date = date("Y-m-d", strtotime($year . 'W' . $week_no . $day['id']));
//getting if it is leave
                                $leave = 0;
                                $leave_data = $this->employee_leave_day($employee['username'], $date);
                                if (!empty($leave_data)) {
                                    $leave = 1;
                                }
//getting toatal time for perticulal user and cusomer for the date
                                $time = $this->timetable_customer_employee_time($customer['username'], $employee['username'], $date, $carry_fwd);
                                $total_time = $time['time'];
                                $carry_fwd = $time['carry_fwd'];
                                $flag_sign = $this->chk_employee_rpt_signed($employee['username'], $date);

                                $day_array[] = array('day' => $day['label'], 'date' => $date, 'time' => $total_time, 'leave' => $leave, 'signed' => $flag_sign);
                            }
                        }
                        $datas[$i][$j]['week'] = $day_array;
                        $j++;
                    }
                }
                $i++;
            }
            return $datas;
        } else {

            return FALSE;
        }
    }

    function employee_week_customer($employee, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->tables = array('timetable');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?', 'date >= ?', 'date <= ?', 'status = ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('customer');
        $this->fields = array('username', 'code', 'first_name', 'last_name');
        $this->conditions = array('AND', array('IN', 'username', $query_inner), 'status = ?');
        $this->condition_values = array($employee, $start_date, $end_date, 1, 1);
        $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function customer_week_employee($customer, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->tables = array('timetable');
        $this->fields = array('employee');
        $this->conditions = array('AND', 'customer = ?', 'date >= ?', 'date <= ?', 'status = ?');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name');
        $this->conditions = array('AND', array('IN', 'username', $query_inner), 'status = ?');
        $this->condition_values = array($customer, $start_date, $end_date, 1, 1);
        $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function timetable_customer_employee_slots($customer = '', $employee = '', $date = '') {

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'type', 'fkkn', 'alloc_emp', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if ($customer != '' && $employee == '') {
            $this->conditions = array('AND', 'customer = ?', 'date = ?');
            $this->condition_values = array($customer, $date);
        } else if ($customer == '' && $employee != '') {
            $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '0,1,2,3'));
            $this->condition_values = array($employee, $date);
        } else if ($customer != '' && $employee != '') {
            $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'date = ?', array('IN', 'status', '0,1,2,3'));
            $this->condition_values = array($customer, $employee, $date);
        }
        $this->order_by = array('time_from');
        $this->query_generate();
        $slots = $this->query_fetch();
        $datas = array();
        foreach ($slots as $slot) {

            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_hour' => $this->time_difference($slot['time_from'], $slot['time_to']), 'status' => $slot['status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 'alloc_emp' => $slot['alloc_emp']);
        }
        return $datas;
    }

    function timetable_customer_employee_slots_copiable($customer = '', $employee = '', $date = '') {

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'type', 'fkkn', 'alloc_emp', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if ($customer != '' && $employee == '') {
            $this->conditions = array('AND', 'customer = ?', 'date = ?', array('IN', 'status', '0,1'));
            $this->condition_values = array($customer, $date);
        } else if ($customer == '' && $employee != '') {
            $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '0,1'));
            $this->condition_values = array($employee, $date);
        } else if ($customer != '' && $employee != '') {
            $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'date = ?', array('IN', 'status', '0,1'));
            $this->condition_values = array($customer, $employee, $date);
        }
        $this->order_by = array('time_from');
        $this->query_generate();
        $slots = $this->query_fetch();
        $datas = array();
        foreach ($slots as $slot) {

            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'time_from' => $slot['time_from'], 'time_to' => $slot['time_to'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'status' => $slot['status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 'alloc_emp' => $slot['alloc_emp']);
        }
        return $datas;
    }

    function timetable_customer_employee_slots_copiable_with_options($customer = '', $employee = '', $date = '', $with_user) {

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'type', 'fkkn', 'alloc_emp', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if ($customer != '' && $employee == '') {
            if ($with_user == 1) {
                $this->conditions = array('AND', 'customer = ?', 'date = ?', array('IN', 'status', '1'));
                $this->condition_values = array($customer, $date);
            } else {
                $this->conditions = array('AND', 'customer = ?', 'date = ?', array('IN', 'status', '0,1'));
                $this->condition_values = array($customer, $date);
            }
        } else if ($customer == '' && $employee != '') {
            if ($with_user == 1) {
                $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '0,1'));
                $this->condition_values = array($employee, $date);
            } else {
                $this->conditions = array('AND', 'employee = ?', 'date = ?', array('IN', 'status', '1'));
                $this->condition_values = array($employee, $date);
            }
        } else if ($customer != '' && $employee != '') {
            $this->conditions = array('AND', 'customer = ?', 'employee = ?', 'date = ?', array('IN', 'status', '0,1'));
            $this->condition_values = array($customer, $employee, $date);
        }
        $this->order_by = array('time_from');
        $this->query_generate();

        $slots = $this->query_fetch();

        $datas = array();
        foreach ($slots as $slot) {


            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'time_from' => $slot['time_from'], 'time_to' => $slot['time_to'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'status' => $slot['status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 'alloc_emp' => $slot['alloc_emp']);
        }
        return $datas;
    }

    function timetable_day($customers, $employees, $date) {

        global $week;

//getting customer loop
        $datas = array();
        $i = 0;
        if (!empty($customers)) {

            foreach ($customers as $customer) {

//getting into employee loop
                $j = 0;
                if (!empty($employees)) {

                    foreach ($employees as $employee) {

                        $datas[$i][$j]['customer'] = $customer;
                        $datas[$i][$j]['employee'] = $employee;
                        $carry_fwd_time = 0;
//getting if it is leave
                        $leave = 0;
                        $leave_data = $this->employee_leave_day($employee['username'], $date);
                        if (!empty($leave_data)) {
                            $leave = 1;
                        }
                        $datas[$i][$j]['date'] = $date;
                        $datas[$i][$j]['leave'] = $leave;
                        //checking for the signined flag
                        $date_array = explode('-', $date);
                        $date_month = $date_array[1];
                        $date_year = $date_array[0];
                        $employee_username = $employee['username'];
                        $this->tables = array('report_signing');
                        $this->fields = array('id');
                        $this->conditions = array('AND', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?');
                        $this->condition_values = array($employee_username, $date_month, $date_year);
                        $this->query_generate();
                        $signin_data = $this->query_fetch();
                        $signin_flag = 0;
                        if (!empty($signin_data)) {
                            $signin_flag = 1;
                        }
                        $datas[$i][$j]['signed'] = $signin_flag;
//getting toatal time for perticulal user and cusomer for the date
                        $slots = $this->timetable_customer_employee_slots($customer['username'], $employee['username'], $date);
                        $datas[$i][$j]['slots'] = $slots;
                        $j++;
                    }
                }
                $i++;
            }
            return $datas;
        } else {

            return FALSE;
        }
    }

    function customer_employee_slot_remove($id) {
        $this->tables = array('timetable');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete())
            return true;
        else
            return false;
    }

    /*     * ************************** NIYAZ **************************************** */

    function employee_inconvenient_time_month($employee_username, $year, $month, $inconvenient_types, $works, $inconvinient_holiday, $block, $type_return) {
        // $incocinient = new inconvenient_timing();
        // $works_assigned = new timetable();
        //print_r($inconvinient_holiday);
        /*  $val1 = 0;
          $val2 = 0;
          $val3 = 0;
          $report = array(); */
        $num = 0;
        // $normal_datas = array();
        /// $inconvenient_datas = array();
        $report_details = array();
        // $inconvenient_datas_holiday = array();
        $works_timetables = $this->get_timetable($year, $month, $employee_username);
        $distinct_inconveniences = $this->get_inconvenience_month_distinct($month, $year);
        // print_r($inconvenient_types);
        $in = 0;
        //print_r($works_timetables);
        //echo "<br><br>";
        //print_r($inconvinient_holiday);
        foreach ($works_timetables as $timetable) {

            foreach ($distinct_inconveniences as $distinct_inconvenience) {
                $reports_in[$in] = array('name' => $distinct_inconvenience['name'], 'value' => '0.0');
                $in++;
            }
            $in = 0;

            $report_details[$num] = array('date' => $timetable['date'], 'work_id' => $timetable['work'], 'work_name' => $timetable['work_name'], 'normal' => '0.0', 'holiday_big' => '0.0', 'holiday_red' => '0.0', 'inconvenient_big' => '0.0', 'inconvenient_red' => '0.0', 'add' => '0', 'inconvenience' => $reports_in);
            $num++;
        }
        $num1 = 0;



        foreach ($works_timetables as $work_timetable) {
            $br = 0;
            foreach ($inconvinient_holiday as $holiday) {

                //echo "<br> ".$work_timetable['date'];
                // echo "<br><br> date ".$work_timetable['date']." holiday date from ".$holiday['date_from']."  ".$holiday['date_to'];
                if (strtotime($work_timetable['date']) >= strtotime($holiday['date_from']) && strtotime($work_timetable['date']) <= strtotime($holiday['date_to'])) {
                    $day_low = date('d', strtotime($holiday['date_from']));
                    $day_high = date('d', strtotime($iholiday['date_to']));
                    $days = date('d', strtotime($work_timetable['date']));
                    $day_difference_low = $days - $day_low;
                    $day_difference_high = $day_high - $days;
                    $day = $day_difference_low + 1;
                    if ($day_difference_low == 0) {
                        $start_time = $holiday['start_time'];
                        $end_time = '24.00';
                        $work_start_time = $work_timetable['time_from'];
                        $work_end_time = $work_timetable['time_to'];
                        $condition = $this->check_condition_holiday($work_start_time, $work_end_time, $start_time, $end_time);
                        $time_values = $this->get_normal_inconvenient_time($work_start_time, $work_end_time, $start_time, $end_time, $condition);
                        $types = $this->get_type_holiday($day, $holiday['id']);
                        $inconvenient_normal_time = explode('/', $time_values);
                        $normal_time = $inconvenient_normal_time[0];
                        $inconvenient_time = $inconvenient_normal_time[1];
                        foreach ($types as $type) {
                            $asd = $type['type'];
                            $master = $type['master_type'];
                        }
                        if ($asd == 1 && $master == 1) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['holiday_red'] = $inconvenient_time;
                                    $report_details[$c]['normal'] = $normal_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        } else if ($asd == 2 && $master == 1) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['holiday_red'] = $inconvenient_time;
                                    $report_details[$c]['normal'] = $normal_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        } else if ($asd == 1 && $master == 2) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['holiday_red'] = $inconvenient_time;
                                    $report_details[$c]['normal'] = $normal_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        } else if ($asd == 2 && $master == 2) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['holiday_red'] = $inconvenient_time;
                                    $report_details[$c]['normal'] = $normal_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        }
                    }
                    if ($day_difference_high == 0) {
                        $start_time = '0.00';
                        $end_time = $holiday['end_time'];
                        $work_start_time = $work_timetable['time_from'];
                        $work_end_time = $work_timetable['time_to'];
                        $condition = $this->check_condition_holiday($work_start_time, $work_end_time, $start_time, $end_time);
                        $time_values = $this->get_normal_inconvenient_time($work_start_time, $work_end_time, $start_time, $end_time, $condition);
                        $types = $this->get_type_holiday($day, $holiday['id']);
                        $inconvenient_normal_time = explode('/', $time_values);
                        $normal_time = $inconvenient_normal_time[0];
                        $inconvenient_time = $inconvenient_normal_time[1];
                        foreach ($types as $type) {
                            $asd = $type['type'];
                            $master = $type['master_type'];
                        }
                        if ($asd == 1 && $master == 1) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['holiday_red'] = $inconvenient_time;
                                    $report_details[$c]['normal'] = $normal_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        } else if ($asd == 2 && $master == 1) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['holiday_red'] = $inconvenient_time;
                                    $report_details[$c]['normal'] = $normal_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        } else if ($asd == 1 && $master == 2) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['holiday_red'] = $inconvenient_time;
                                    $report_details[$c]['normal'] = $normal_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        } else if ($asd == 2 && $master == 2) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['holiday_red'] = $inconvenient_time;
                                    $report_details[$c]['normal'] = $normal_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        }
                    } else {
                        $work_start_time = $work_timetable['time_from'];
                        $work_end_time = $work_timetable['time_to'];
                        $inconvenient_time = $this->time_difference($work_start_time, $work_end_time);
                        $types = $this->get_type_holiday($day, $holiday['id']);
                        foreach ($types as $type) {
                            $asd = $type['type'];
                            $master = $type['master_type'];
                        }
                        if ($asd == 1 && $master == 1) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0')
                                    $report_details[$c]['holiday_red'] = $inconvenient_time;
                                $report_details[$c]['add'] = '1';
                            }
                            $br = 1;
                            break;
                        }
                        else if ($asd == 2 && $master == 1) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['holiday_big'] = $inconvenient_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        } else if ($asd == 1 && $master == 2) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['inconvenient_red'] = $inconvenient_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        } else if ($asd == 2 && $master == 2) {
                            for ($c = 0; $c < count($report_details); $c++) {
                                if ($report_details[$c]['date'] == $work_timetable['date'] && $report_details[$c]['work_id'] == $work_timetable['work'] && $report_details[$c]['add'] == '0') {
                                    $report_details[$c]['inconvenient_big'] = $inconvenient_time;
                                    $report_details[$c]['add'] = '1';
                                }
                            }
                            $br = 1;
                            break;
                        }
                    }
                }
            }

            // echo "<br> count inside ".count($report_details);
            if ($br == 0) {
                foreach ($inconvenient_types as $inconvenient_type) {
                    if ($inconvenient_type['effect_to'] == null) {
                        $inconv_date_to_new = strtotime(date("Y-m-d", strtotime($inconvenient_type['effect_from'])) . " +1 year");
                        $inconv_date_to = date("Y-m-d", $inconv_date_to_new);
                    } else {
                        $inconv_date_to = $inconvenient_type['effect_to'];
                    }
                    // echo "<br> Ordinary Date  ".$work_timetable['date']."<br> start Date  ".$inconvenient_type['effect_from']."<br> stop date ".$inconv_date_to."<br><br>"; 
                    if (strtotime($work_timetable['date']) >= strtotime($inconvenient_type['effect_from']) && strtotime($work_timetable['date']) <= strtotime($inconv_date_to)) {

                        $time_from = $work_timetable['time_from'];
                        $time_to = $work_timetable['time_to'];
                        $inconvenient_time_from = $inconvenient_type['time_from'];
                        $inconvenient_time_to = $inconvenient_type['time_to'];
                        $condition = $this->check_condition_holiday((float) $time_from, (float) $time_to, $inconvenient_time_from, $inconvenient_time_to);
                        $condition;
                        $time_values = $this->get_normal_inconvenient_time((float) $time_from, (float) $time_to, $inconvenient_time_from, $inconvenient_time_to, $condition);
                        $types = $this->get_type_holiday($day, $holiday['id']);
                        $inconvenient_normal_time = explode('/', $time_values);
                        $normal_time = $inconvenient_normal_time[0];
                        $inconvenient_time = $inconvenient_normal_time[1];
                        for ($i = 0; $i < count($report_details); $i++) {
                            if (strtotime($report_details[$i]['date']) == strtotime($work_timetable['date']) && $report_details[$i]['work_id'] == $work_timetable['work']) {
                                $report_details[$i]['normal'] = $normal_time;
                                $report_details[$i]['add'] = '1';
                                for ($j = 0; $j < count($distinct_inconveniences); $j++) {
                                    if ($report_details[$i]['inconvenience'][$j]['name'] == $inconvenient_type['name']) {

                                        $report_details[$i]['inconvenience'][$j]['value'] = $inconvenient_time;
                                        break;
                                    }
                                }
                            }
                        }
                    } else {
                        $time_from = $work_timetable['time_from'];
                        $time_to = $work_timetable['time_to'];

                        for ($i = 0; $i < count($report_details); $i++) {
                            if ($report_details[$i]['date'] == $work_timetable['date'] && $report_details[$i]['work_id'] == $work_timetable['work'] && $report_details[$i]['add'] == '0') {
                                $report_details[$i]['add'] = '1';
                                $report_details[$i]['normal'] = $this->time_difference((float) $time_from, (float) $time_to);
                                break;
                            }
                        }
                    }
                }
            }
        }
        $val5 = 0;
        $report = array();
        for ($i = 0; $i < count($report_details); $i++) {

            if (count($report) == 0) {
                $report[$val5] = $report_details[0];
                $val5++;
            } else {
                for ($j = 0; $j < count($report); $j++) {

                    if (strtotime($report_details[$i]['date']) == strtotime($report[$j]['date']) && $report_details[$i]['work_name'] == $report[$j]['work_name']) {

                        $report[$j]['holiday_big'] = $this->time_sum($report[$j]['holiday_big'], $report_details[$i]['work_name']);
                        $report[$j]['normal'] = $this->time_sum($report[$j]['normal'], $report_details[$i]['normal']);
                        $report[$j]['holiday_red'] = $this->time_sum($report[$j]['holiday_red'], $report_details[$i]['holiday_red']);
                        $report[$j]['inconvenient_red'] = $this->time_sum($report[$j]['inconvenient_red'], $report_details[$i]['inconvenient_red']);
                        $report[$j]['inconvenient_big'] = $this->time_sum($report[$j]['inconvenient_big'], $report_details[$i]['inconvenient_big']);
                        for ($k = 0; $k < count($distinct_inconveniences); $k++) {
                            $report[$j]['inconvenience'][$k]['value'] = $this->time_sum($report[$j]['inconvenience'][$k]['value'], $report_details[$i]['inconvenience'][$k]['value']);
                        }
                        break;
                    }
                }

                if ($j == count($report)) {
                    $report[$val5] = $report_details[$i];
                    $val5++;
                }
            }
        }

        $sum = array();
        $val1 = 0;

        for ($i = 0; $i < count($report_details); $i++) {
            if (count($sum) == 0) {
                $sum[$val1] = $report_details[0];
                $val1++;
            } else {
                for ($j = 0; $j < count($sum); $j++) {
                    if ($report_details[$i]['work_name'] == $sum[$j]['work_name']) {
                        $sum[$j]['holiday_big'] = $this->time_sum($sum[$j]['holiday_big'], $report_details[$i]['work_name']);
                        $sum[$j]['normal'] = $this->time_sum($sum[$j]['normal'], $report_details[$i]['normal']);
                        $sum[$j]['holiday_red'] = $this->time_sum($sum[$j]['holiday_red'], $report_details[$i]['holiday_red']);
                        $sum[$j]['inconvenient_red'] = $this->time_sum($sum[$j]['inconvenient_red'], $report_details[$i]['inconvenient_red']);
                        $sum[$j]['inconvenient_big'] = $this->time_sum($sum[$j]['inconvenient_big'], $report_details[$i]['inconvenient_big']);
                        for ($k = 0; $k < count($distinct_inconveniences); $k++) {
                            $sum[$j]['inconvenience'][$k]['value'] = $this->time_sum($sum[$j]['inconvenience'][$k]['value'], $report_details[$i]['inconvenience'][$k]['value']);
                        }
                        break;
                    }
                }
                if ($j == count($sum)) {
                    $sum[$val1] = $report_details[$i];
                    $val1++;
                }
            }
        }
        $total_inconv = array();
        $val2 = 0;
        $l = 0;
        $i = 0;


        for ($j = 0; $j < count($distinct_inconveniences); $j++) {
            $h = 0;
            $i = 0;
            for ($k = 0; $k < count($distinct_inconveniences); $k++) {
                if ($i == count($sum))
                    break;
                $arra[$h] = array('value' => $sum[$i]['inconvenience'][$l]['value']);
                $i++;
                $h++;
            }
            $l++;
            $total_inconv[$val2] = array('name' => $sum[0]['inconvenience'][$j]['name'], 'values' => $arra);
            $val2++;
        }

        // print_r($total_inconv);
        if ($type_return == 1) {
            return $report;
        } else if ($type_return == 2)
            return $sum;
        else
            return $total_inconv;
    }

    function get_total_normal($normal) {
        $total = '0.00';
        for ($i = 0; $i < count($normal); $i++) {
            $total = $this->time_sum($total, $normal[$i]['normal']);
        }
        return $total;
    }

    function get_total_inconvinient($inconvenient, $count) {

        $count1 = count($inconvenient);
        for ($i = 0; $i < $count1; $i++) {
            $total = 0.0;
            for ($j = 0; $j < $count; $j++) {
                $total = $this->time_sum($total, $inconvenient[$i]['work'][$j]['inconvenient']);
            }
            $inconvenient[$i]['total'] = $total;
        }
        return $inconvenient;
    }

    function get_holiday_total($holiday, $work_ids) {
        $big_red[0] = array('name' => 'Holiday Big', 'total' => '0.0');
        $big_red[1] = array('name' => 'Holiday Red', 'total' => '0.0');
        $big_red[2] = array('name' => 'Inconvenient Big', 'total' => '0.0');
        $big_red[3] = array('name' => 'Inconvenient Red', 'total' => '0.0');
        $count1 = count($holiday);
        $count2 = count($work_ids);
        $total = '0.0';
        $total1 = '0.0';
        $val = 0;
        foreach ($big_red as $big) {
            $i = 0;
            foreach ($work_ids as $work_id) {
                $arr[$i] = array('work_id' => $work_id['id'], 'value' => '0.0');
                $i++;
            }
            $big_red[$val]['work'] = $arr;
            $val++;
        }
        for ($i = 0; $i < $count1; $i++) {

            for ($j = 0; $j < $count2; $j++) {

                if ($holiday[$i]['work'][$j]['work_id'] == $big_red[0]['work'][$j]['work_id'])
                    ; {
                    $big_red[0]['work'][$j]['value'] = $this->time_sum($big_red[0]['work'][$j]['value'], $holiday[$i]['work'][$j]['holiday_big']);
                }

                if ($holiday[$i]['work'][$j]['work_id'] == $big_red[1]['work'][$j]['work_id'])
                    ; {
                    $big_red[1]['work'][$j]['value'] = $this->time_sum($big_red[1]['work'][$j]['value'], $holiday[$i]['work'][$j]['holiday_red']);
                }
                if ($holiday[$i]['work'][$j]['work_id'] == $big_red[2]['work'][$j]['work_id'])
                    ; {
                    $big_red[2]['work'][$j]['value'] = $this->time_sum($big_red[2]['work'][$j]['value'], $holiday[$i]['work'][$j]['inconvenient_big']);
                }
                if ($holiday[$i]['work'][$j]['work_id'] == $big_red[3]['work'][$j]['work_id'])
                    ; {
                    $big_red[3]['work'][$j]['value'] = $this->time_sum($big_red[3]['work'][$j]['value'], $holiday[$i]['work'][$j]['inconvenient_big']);
                }
            }
        }
        $count3 = count($big_red);
        for ($i = 0; $i < $count3; $i++) {

            for ($j = 0; $j < $count2; $j++) {
                $total = $this->time_sum($total, $big_red[$i]['work'][$j]['value']);
            }
            $big_red[$i]['total'] = $total;
            $total = '0.0';
        }


        // $big_red[0] = array('name' => 'Holiday Red' , 'value' = );
        return $big_red;
    }

    /* function assign_holidays_to_big_red($holiday,$work_ids)
      {
      $big_red[0] = array('name' => 'Holiday Big' , 'work' => array());
      $big_red[1] = array('name' => 'Holiday Red' , 'work' => array());
      $total_big = '0.0';
      $total_red = '0.0';

      $count1 = count($holiday);
      $count2 = count($work_ids);
      for($i=0;$i<$count1;$i++)
      {
      for($j=0;$j<$count2;$j++)
      {

      }
      }
      } */

    function check_condition_holiday($work_from, $work_to, $holiday_from, $holiday_to, $inconv_days = null, $work_day = null) {
        if ($work_day != null) {
            $i_day = explode(",", $inconv_days);
            if (!in_array($work_day, $i_day))
                return 5;
        }

        if ($this->convert_time_part($work_from) <= $this->convert_time_part($holiday_from) && $this->convert_time_part($work_to) >= $this->convert_time_part($holiday_to))
            return 1;
        else if ($this->convert_time_part($work_from) <= $this->convert_time_part($holiday_from) && $this->convert_time_part($work_to) <= $this->convert_time_part($holiday_to) && ($this->convert_time_part($holiday_from) < $this->convert_time_part($work_to)))
            return 2;
        else if ($this->convert_time_part($work_from) >= $this->convert_time_part($holiday_from) && $this->convert_time_part($work_to) >= $this->convert_time_part($holiday_to) && !($this->convert_time_part($work_from) > $this->convert_time_part($holiday_to)))
            return 3;
        else if ($this->convert_time_part($work_from) >= $this->convert_time_part($holiday_from) && $this->convert_time_part($work_to) <= $this->convert_time_part($holiday_to))
            return 4;
        else
            return 5;
    }

    function get_normal_inconvenient_time($time_from, $time_to, $inconv_from, $inconv_to, $method) {
        //echo "<br>".(float)$time_from."<br>".(float)$time_to."<br>".$inconv_from."<br>".$inconv_to."<br>";
        switch ($method) {
            case 1: {

                    $normal = $this->time_sum($this->time_difference($inconv_from, (float) $time_from), $this->time_difference((float) $time_to, $inconv_to));
                    $inconvinient_time = $this->time_difference($inconv_to, $inconv_from);

                    return $normal . "/" . $inconvinient_time;
                }
            case 2: {
                    $normal = $this->time_difference($inconv_from, (float) $time_from);
                    $inconvinient_time = $this->time_difference((float) $time_to, $inconv_from);
                    return $normal . "/" . $inconvinient_time;
                }
            case 3: {
                    $normal = $this->time_difference((float) $time_to, $inconv_to);
                    $inconvinient_time = $this->time_difference($inconv_to, (float) $time_from);
                    return $normal . "/" . $this->$inconvinient_time;
                }

            case 4: {
                    $normal = 0.00; //($this->convert_time_part($inconv_from) - $this->convert_time_part((float)$time_from)) + ($this->convert_time_part((float)$time_to) - $this->convert_time_part($inconv_to));           
                    $inconvinient_time = $this->time_difference((float) $time_from, (float) $time_to);
                    return $normal . "/" . $inconvinient_time;
                }
            case 5: {
                    $normal = $this->time_difference((float) $time_from, (float) $time_to); //($this->convert_time_part($inconv_from) - $this->convert_time_part((float)$time_from)) + ($this->convert_time_part((float)$time_to) - $this->convert_time_part($inconv_to));           
                    $inconvinient_time = 0.00;
                    return $normal . "/" . $inconvinient_time;
                }
        }
    }

    function format_time_part($time) {
        $hr = ((int) ($time / 100) < 10) ? "0" . (int) ($time / 100) : (int) ($time / 100);
        $min = ((int) ($time % 100) * (60 / 100) < 10) ? "0" . (int) ($time % 100) * (60 / 100) : (int) ($time % 100) * (60 / 100);
        return $hr . '.' . $min;
    }

    function convert_time_part($time) {

        $hr = (int) $time;
        $min = ((($time - $hr) * 100) / 60) * 100;
        return ($hr * 100) + ($min);
    }

    function get_work_time_month($month, $year, $employee, $work_id) {
        $inconv = new inconvenient_timing();
        $limits = $inconv->get_date_limits($month, $year);
        $dates = explode("/", $limits);
        // print_r($dates);
        $this->tables = array('timetable', 'work');
        $this->fields = array('timetable.employee',
            'timetable.customer',
            'timetable.date',
            'timetable.work',
            'timetable.time_from',
            'timetable.time_to',
            'timetable.type',
            'timetable.status',
            'timetable.comment',
            'work.id',
            'work.name'
        );
        $this->conditions = array('AND', 'timetable.work = work.id', 'employee = ? ', array('BETWEEN', 'date', '?', '?'), 'status = 1', 'type = 0', 'work.id = ?');
        $this->condition_values = array($employee, $dates[0], $dates[1], $work_id);
        $this->order_by = array('date');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        //print_r($datas);
        return $datas;
    }

    function get_date_limits($month, $year) {
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lower_limit = $year . "-" . $month . "-01";
        $upper_limit = $year . "-" . $month . "-" . $num;
        return $lower_limit . "/" . $upper_limit;
    }

    /* function employee_inconvenient_type_time_month($employee_username, $year, $month, $inconvenient_type_id, $work_id){

      $inconvenient_type_det =
      } */

    function inconvinient_time_details_month($month, $year) {

        $limits = $this->get_date_limits($month, $year);
        $limit = explode('/', $limits);
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'type', 'days');
        $$this->conditions = array('OR', array('BETWEEN', 'effect_to', '?', '?'), array('BETWEEN', 'effect_from', '?', '?'));
        $this->condition_values = array($limit[0], $limit[1], $limit[0], $limit[1]);
        $this->order_by = array('effect_from');
        $this->query_generate();
        $data = $this->query_fetch();
        //print_r($data);
        if (!empty($data)) {
            return $data;
        }
        else
            return FALSE;
    }

    function get_inconvinient_details($month, $year) {
        $limits = $this->get_date_limits($month, $year);
        $limit = explode('/', $limits);
        $this->tables = array('inconvenient_timing');
        $this->fields = array('name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days');
        $this->conditions = array('OR', array('BETWEEN', 'effect_to', '?', '?'), array('BETWEEN', 'effect_from', '?', '?'));
        $this->condition_values = array($limit[0], $limit[1], $limit[0], $limit[1]);
        //$this->group_by = array('name');
        $this->query_generate();
        // echo $this->sql_query;
        $data = $this->query_fetch();

        if (!empty($data)) {
            return $data;
        }
        else
            return FALSE;
    }

    function time_difference($t1, $t2) {
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        $time1 = (($a1[0] * 60 * 60) + ($a1[1] * 60));
        $time2 = (($a2[0] * 60 * 60) + ($a2[1] * 60));
        $diff = abs($time1 - $time2);
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        $result = $hours . "." . sprintf('%02d', $mins);
        return $result;
    }

    function time_sum($t1, $t2) {
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        $time1 = (($a1[0] * 60 * 60) + ($a1[1] * 60));
        $time2 = (($a2[0] * 60 * 60) + ($a2[1] * 60));
        $sum = abs($time1 + $time2);
        $hours = floor($sum / (60 * 60));
        $mins = floor(($sum - ($hours * 60 * 60)) / (60));
        $result = $hours . "." . $mins;
        return $result;
    }

    function get_employee_works($month, $year, $employee_username) {
        $inconv = new inconvenient_timing();
        $limits = $inconv->get_date_limits($month, $year);
        $dates = explode("/", $limits);
        // print_r($dates);
        $this->tables = array('timetable', 'work');
        $this->fields = array('timetable.employee',
            'timetable.work',
            'work.id',
            'work.name'
        );
        $this->conditions = array('AND', 'timetable.work = work.id', 'timetable.employee = ? ', array('BETWEEN', 'date', '?', '?'), 'timetable.status = 1', 'timetable.type = 0');
        $this->condition_values = array($employee_username, $dates[0], $dates[1]);
        //$this->order_by = array('work');
        $this->group_by = array('work');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();

        return $datas;
    }

    function get_inconvinient_details_holiday($month, $year) {

        $result = array();
        $this->tables = array($this->db_master . '.holiday_inconvenient_timing', $this->db_master . '.holiday_block_master');
        $this->fields = array($this->db_master . '.holiday_inconvenient_timing.id AS id',
            $this->db_master . '.holiday_inconvenient_timing.block_master_id AS block_master_id',
            $this->db_master . '.holiday_inconvenient_timing.effect_from AS effect_from',
            $this->db_master . '.holiday_inconvenient_timing.effect_to',
            $this->db_master . '.holiday_inconvenient_timing.date_from AS from_date',
            $this->db_master . '.holiday_inconvenient_timing.date_to AS to_date',
            $this->db_master . '.holiday_block_master.id',
            // $this->db_master . '.holiday_block_master.type AS master_type',
            $this->db_master . '.holiday_block_master.name AS name',
            $this->db_master . '.holiday_block_master.start_time AS start',
            $this->db_master . '.holiday_block_master.end_time AS end',
            $this->db_master . '.holiday_block_master.type'
        );
        $this->conditions = array('AND', 'effect_from = ?', $this->db_master . '.holiday_inconvenient_timing.block_master_id = ' . $this->db_master . '.holiday_block_master.id');
        $this->condition_values = array($year);
        $this->query_generate();
        $datas = $this->query_fetch();
        //print_r($datas);
        $i = 0;
        foreach ($datas as $data) {
            $date_from = explode('-', $data['from_date']);

            $date_to = explode('-', $data['to_date']);

            if ($month == $date_from[0] || $month == $date_to[0]) {
                $result[$i] = array('id' => $data['id'], 'block_master_id' => $data['block_master_id'], 'date_from' => $data['effect_from'] . '-' . $data['from_date'], 'date_to' => $data['effect_from'] . '-' . $data['to_date'], 'name' => $data['name'], 'start_time' => $data['start'], 'end_time' => $data['end']);
                $i++;
            }
        }

        return $result;
    }

    function get_inconvenient_block() {
        $result = array();
        $this->tables = array($this->db_master . '.holiday_block_master', $this->db_master . '.holiday_block');
        $this->fields = array(
            $this->db_master . '.holiday_block_master.id AS id',
            $this->db_master . '.holiday_block_master.name AS name',
            $this->db_master . '.holiday_block_master.start_time AS start',
            $this->db_master . '.holiday_block_master.end_time AS end',
            $this->db_master . '.holiday_block_master.type AS master_type',
            $this->db_master . '.holiday_block.block_master_id AS master_id',
            $this->db_master . '.holiday_block.day AS day',
            $this->db_master . '.holiday_block.type AS types',
        );
        $this->conditions = array('AND', $this->db_master . '.holiday_block_master.id = ' . $this->db_master . '.holiday_block.block_master_id');
        //$this->condition_values = array($year);
        $this->order_by = array('master_id');
        $this->query_generate();
        $datas = $this->query_fetch();
        $i = 0;
        foreach ($datas as $data) {
            $result[$i] = array('day' => $data['day'], 'type' => $data['types'], 'id' => $data['id'], 'master_type' => $data['master_type']);
            $i++;
        }
        return $result;
    }

    function get_type_holiday($day, $id) {
        $this->tables = array($this->db_master . '.holiday_block', $this->db_master . '.holiday_block_master');
        $this->fields = array(
            $this->db_master . '.holiday_block.day',
            $this->db_master . '.holiday_block.type',
            $this->db_master . '.holiday_block.block_master_id',
            $this->db_master . '.holiday_block_master.type AS master_type',
            $this->db_master . '.holiday_block_master.id'
        );
        $this->conditions = array('AND', $this->db_master . '.holiday_block.day = ?', $this->db_master . '.holiday_block.block_master_id = ?', $this->db_master . '.holiday_block.block_master_id =' . $this->db_master . '.holiday_block_master.id');
        $this->condition_values = array($day, $id);
        $this->query_generate();
        $datas = $this->query_fetch();

        return $datas;
    }

    function get_inconvenience_month_distinct($month, $year) {
        /* $limits = $inconv->get_date_limits($month, $year);
          $limit = explode("/", $limits); */
        $this->tables = array('inconvenient_timing');
        $this->fields = array('distinct(name)');
        $this->conditions = array('OR', 'month(effect_from) = ?', 'month(effect_to) = ?');
        $this->condition_values = array($month, $month);
        //$this->group_by = array('name');
        $this->query_generate();
        // echo $this->sql_query;
        $data = $this->query_fetch();
        return $data;
    }

    function get_timetable($year, $month, $employee) {
        $this->tables = array('timetable', 'work');
        $this->fields = array('timetable.work',
            'timetable.date',
            'work.name AS work_name',
            'timetable.time_from',
            'timetable.time_to',
            'timetable.employee'
        );
        $this->conditions = array('AND', 'month(date) = ?', 'status=1', 'type=0', 'employee = ?', 'work.id = timetable.work');
        $this->condition_values = array($month, $employee);
        $this->order_by = array('date');
        //$this->group_by = array('name');
        $this->query_generate();
        //echo $this->sql_query;
        $data = $this->query_fetch();
        return $data;
    }

    /* ------------------------NIyaz end---------------------------- */
    /* --------------------------Shamsu----------------------------- */

    function employee_montly_work_details($employee, $month, $year) {

        $this->tables = array('timetable` as `t', 'customer` as `c');
        $this->fields = array('t.date', 't.time_from', 't.time_to', 't.customer', 't.type', 'concat(c.first_name," ",c.last_name) as customer_name');
        $this->conditions = array('AND', 'month(t.date)= ?', 'year(t.date)= ?', 't.employee like ?', 't.status=1', 't.customer like c.username');
        $this->condition_values = array($month, $year, $employee);
        $this->group_by = array('t.date', 't.time_from', 't.time_to');
        $this->order_by = array('t.date', 't.time_from', 't.time_to');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        //print_r($datas);
        return $datas;
    }

    /*     * ***************************start*******************employee work report details*************************** */

    function employee_report($employee, $year, $month) {        //not used
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2)');
        $this->conditions = array('AND', 'type = 0', 'customer like c1', 'date like d1', 'work like w1', 'employee like ?', 'status=1');
        $this->query_generate();
        $query_type0 = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2)');
        $this->conditions = array('AND', 'type = 1', 'customer like c1', 'date like d1', 'work like w1', 'employee like ?', 'status=1');
        $this->query_generate();
        $query_type1 = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2)');
        $this->conditions = array('AND', 'type = 2', 'customer like c1', 'date like d1', 'work like w1', 'employee like ?', 'status=1');
        $this->query_generate();
        $query_type2 = $this->sql_query;

        $this->tables = array('timetable', 'work', 'customer');
        $this->fields = array('timetable.date as d1', 'timetable.work as w1', 'work.name as w_name', 'timetable.customer as c1', 'customer.first_name as cust_name', '(' . $query_type0 . ') as t0', '(' . $query_type1 . ') as t1', '(' . $query_type2 . ') as t2');
        $this->conditions = array('AND', 'timetable.employee like ?', 'month(timetable.date)= ?', 'year(timetable.date)= ?', 'timetable.status=1', 'work.id=timetable.work', 'customer.username like timetable.customer');
        $this->condition_values = array($employee, $employee, $employee, $employee, $month, $year);
        $this->group_by = array('timetable.customer', 'timetable.date', 'timetable.work');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_inconvenient_details_by_month_and_year($month, $year) {
        $this->tables = array('inconvenient_timing');
        $this->fields = array('name', 'effect_from', 'effect_to', 'time_from', 'time_to', 'days');
        $this->conditions = array('OR', array('AND', 'effect_to is null', 'month(effect_from) <= ?', 'year(effect_from) <= ?'), array('AND', 'effect_to is not null', 'month(effect_from) <= ?', 'year(effect_from) <= ?', 'month(effect_to) >= ?', 'year(effect_to) >= ?'));
        $this->condition_values = array($month, $year, $month, $year, $month, $year);
        //$this->order_by = array('uname');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_all_work_details($employee, $month, $year) {
        $this->tables = array('timetable');
        $this->fields = array('date', 'time_from', 'time_to', 'type');
        $this->conditions = array('AND', 'employee like ?', 'month(date)= ?', 'year(date)= ?', 'status=1');
        $this->condition_values = array($employee, $month, $year);
        //$this->group_by = array('timetable.customer', 'timetable.date', 'timetable.work');
        $this->order_by = array('date');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_all_work_details_include_normal_nd_leave($employee, $month, $year) {
        $this->tables = array('timetable');
        $this->fields = array('date', 'time_from', 'time_to', 'type');
        $this->conditions = array('AND', 'employee like ?', 'month(date)= ?', 'year(date)= ?', 'status IN (1,2)');
        $this->condition_values = array($employee, $month, $year);
        //$this->group_by = array('timetable.customer', 'timetable.date', 'timetable.work');
        $this->order_by = array('date');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch(1);
        return $datas;
    }

    function get_holiday_details($month, $year) {

        global $db;
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        $this->tables = array($db['database_master'] . '.holiday_inconvenient_timing', $db['database_master'] . '.holiday_block_master');
        $this->fields = array($db['database_master'] . '.holiday_inconvenient_timing.id', $db['database_master'] . '.holiday_inconvenient_timing.block_master_id', $db['database_master'] . '.holiday_inconvenient_timing.effect_from', $db['database_master'] . '.holiday_inconvenient_timing.effect_to', $db['database_master'] . '.holiday_inconvenient_timing.date_from', $db['database_master'] . '.holiday_inconvenient_timing.date_to', $db['database_master'] . '.holiday_block_master.name', $db['database_master'] . '.holiday_block_master.start_time', $db['database_master'] . '.holiday_block_master.end_time', $db['database_master'] . '.holiday_block_master.type');
        $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'effect_from <= ?'), array('AND', 'effect_to is not null', 'effect_from <= ?', 'effect_to >= ?')), array('OR', 'SUBSTRING(date_from,1,2) = ?', 'SUBSTRING(date_to,1,2) = ?'), $db['database_master'] . '.holiday_inconvenient_timing.block_master_id = ' . $db['database_master'] . '.holiday_block_master.id');
        $this->condition_values = array($year, $year, $year, $month, $month);
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch(1);
        //print_r($datas);
        $details = array();

        foreach ($datas as $data) {

            $start_date = strtotime($year . '-' . $data['date_from']);
            $this->tables = array($db['database_master'] . '.holiday_block');
            $this->fields = array('id', 'day', 'type');
            $this->conditions = array('block_master_id = ?');
            $this->condition_values = array($data['block_master_id']);
            $this->order_by = array('day');
            $this->query_generate();
            //echo $this->sql_query;
            $days = $this->query_fetch();
            $start_time = $data['start_time'];
            $end_time = $data['end_time'];
            $timings = array();
            $start = $end = '';
            foreach ($days as $day) {

                if (date('Y', $start_date) == $year && date('m', $start_date) == $month) {

                    if ($day['day'] == 1) {
                        $start_time = $data['start_time'];
                        $end_time = 24;
                        $start = mktime((int) $start_time, ($start_time - (int) $start_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                        $end = mktime((int) $end_time, ($end_time - (int) $end_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                    } else if ($day['day'] == count($days)) {
                        $start_time = 0;
                        $end_time = $data['end_time'];
                        $end = mktime((int) $end_time, ($end_time - (int) $end_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                    } else {
                        $start_time = 0;
                        $end_time = 24;
                        $end = mktime((int) $end_time, ($end_time - (int) $end_time) * 100, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
                    }

                    $timings[] = array('date' => date('Y-m-d', $start_date), 'time_from' => $start_time, 'time_to' => $end_time, 'bigred' => $day['type']);
                }
                $start_date = strtotime(date("Y-m-d", $start_date) . " +1 day");
            }
            if (!empty($timings)) {

                $details[] = array('id' => $data['id'], 'name' => $data['name'], 'type' => $data['type'], 'start' => $start, 'end' => $end, 'timings' => $timings);
            }
        }

        if (!empty($details)) {

            return $details;
        } else {
            return array();
        }
    }

    function get_distinct_normal_inconvenient_details_by_month_and_year($month, $year, $employee) {
        
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name', 'time_from', 'time_to', 'days');
        $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'month(effect_from) <= ?', 'year(effect_from) <= ?'), array('AND', 'effect_to is not null', 'month(effect_from) <= ?', 'year(effect_from) <= ?', 'month(effect_to) >= ?', 'year(effect_to) >= ?')), 'root_id=0', 'type=0');
        $this->condition_values = array($month, $year, $month, $year, $month, $year);
        $this->query_generate();
        $datas = $this->query_fetch();
        $i = 0;

        $normal = array();
        foreach ($datas as $data) {
            $d = explode(',', $data['days']);
            $days = array();
            $j = 0;
            $week_days = '';
            foreach ($d as $day) {
                if ($j == 0) {
                    $week_days = '\'';
                }
                if ($day) {
                    if ($j != 0)
                        $week_days .= ',\'';
                    $week_days .= ($day % 7) . '\'';
                    $j++;
                }
            }

            $this->tables = array('timetable');
            $this->fields = array('id');
            $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'status = 1', array('IN', 'type', '1,2,0,4,5,6,7'), array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                    array('AND', 'time_to > ?', 'time_to <= ?'),
                    array('AND', 'time_from <= ?', 'time_to >= ?'))
            );

            $this->condition_values = array($month, $year, $employee,
                $data['time_from'], $data['time_to'],
                $data['time_from'], $data['time_to'],
                $data['time_from'], $data['time_to']
            );
            $this->query_generate();
            //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
            if (count($this->query_fetch())) {
                $normal[$i] = $data;

                $i++;
            } else {
                $this->tables = array('inconvenient_timing');
                $this->fields = array('id', 'name', 'time_from', 'time_to', 'days');
                $this->conditions = array('root_id=?');
                $this->condition_values = array($data['id']);
                $this->query_generate();
                $datas_cont = $this->query_fetch();
                foreach ($datas_cont as $data_cont) {
                    $d = explode(',', $data_cont['days']);
                    $j = 0;
                    $week_days = '';
                    foreach ($d as $day) {
                        if ($j == 0) {
                            $week_days = '\'';
                        }
                        if ($day) {
                            if ($j != 0)
                                $week_days .= ',\'';
                            $week_days .= ($day % 7) . '\'';
                            $j++;
                        }
                    }

                    $this->tables = array('timetable');
                    $this->fields = array('id');
                    $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'status = 1', array('IN', 'type', '1,2,0,4,5,6,7'), array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                        array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                            array('AND', 'time_to > ?', 'time_to <= ?'),
                            array('AND', 'time_from <= ?', 'time_to >= ?'))
                    );

                    $this->condition_values = array($month, $year, $employee,
                        $data_cont['time_from'], $data_cont['time_to'],
                        $data_cont['time_from'], $data_cont['time_to'],
                        $data_cont['time_from'], $data_cont['time_to']
                    );
                    $this->query_generate();
                    //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
                    if (count($this->query_fetch())) {
                        $normal[$i] = $data;

                        $i++;
                        break;
                    }
                }
            }
        }

        return $normal;
    }

    function get_distinct_oncall_inconvenient_details_by_month_and_year($month, $year, $employee) {
        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name', 'time_from', 'time_to', 'days');
        $this->conditions = array('AND', array('OR', array('AND', 'effect_to is null', 'month(effect_from) <= ?', 'year(effect_from) <= ?'), array('AND', 'effect_to is not null', 'month(effect_from) <= ?', 'year(effect_from) <= ?', 'month(effect_to) >= ?', 'year(effect_to) >= ?')), 'root_id=0', 'type=3');
        $this->condition_values = array($month, $year, $month, $year, $month, $year);
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        $i = 0;

        $normal = array();
        foreach ($datas as $data) {
            $d = explode(',', $data['days']);
            $days = array();
            $j = 0;
            $week_days = '';
            foreach ($d as $day) {
                if ($j == 0) {
                    $week_days = '\'';
                }
                if ($day) {
                    if ($j != 0)
                        $week_days .= ',\'';
                    $week_days .= ($day % 7) . '\'';
                    $j++;
                }
            }

            $this->tables = array('timetable');
            $this->fields = array('id');
            $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'status = 1', 'type = 3', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                    array('AND', 'time_to > ?', 'time_to <= ?'),
                    array('AND', 'time_from <= ?', 'time_to >= ?'))
            );

            $this->condition_values = array($month, $year, $employee,
                $data['time_from'], $data['time_to'],
                $data['time_from'], $data['time_to'],
                $data['time_from'], $data['time_to']
            );
            $this->query_generate();
            //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
            if (count($this->query_fetch())) {
                $normal[$i] = $data;

                $i++;
            } else {
                $this->tables = array('inconvenient_timing');
                $this->fields = array('id', 'name', 'time_from', 'time_to', 'days');
                $this->conditions = array('root_id=?');
                $this->condition_values = array($data['id']);
                $this->query_generate();
                $datas_cont = $this->query_fetch();
                foreach ($datas_cont as $data_cont) {
                    $d = explode(',', $data_cont['days']);
                    $j = 0;
                    $week_days = '';
                    foreach ($d as $day) {
                        if ($j == 0) {
                            $week_days = '\'';
                        }
                        if ($day) {
                            if ($j != 0)
                                $week_days .= ',\'';
                            $week_days .= ($day % 7) . '\'';
                            $j++;
                        }
                    }

                    $this->tables = array('timetable');
                    $this->fields = array('id');
                    $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'status = 1', 'type = 3', array('IN', 'DATE_FORMAT(date,\'%w\')', $week_days)),
                        array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                            array('AND', 'time_to > ?', 'time_to <= ?'),
                            array('AND', 'time_from <= ?', 'time_to >= ?'))
                    );

                    $this->condition_values = array($month, $year, $employee,
                        $data_cont['time_from'], $data_cont['time_to'],
                        $data_cont['time_from'], $data_cont['time_to'],
                        $data_cont['time_from'], $data_cont['time_to']
                    );
                    $this->query_generate();
                    //if($data['id'] == 30)echo $data['time_from'].'-'.$data['time_to'];
                    if (count($this->query_fetch())) {
                        $normal[$i] = $data;

                        $i++;
                        break;
                    }
                }
            }
        }

        return $normal;
    }

    function get_distinct_normal_inconvenient_details_by_month_and_year_cont($id) {

        $this->tables = array('inconvenient_timing');
        $this->fields = array('id', 'name', 'time_from', 'time_to', 'days');
        $this->conditions = array('root_id=?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_employee_normal_inconvenient_details_by_month_and_year($month, $year, $employee) {

        $this->tables = array('timetable');
        $this->fields = array('id', 'time_from', 'time_to', 'date', 'type', 'status');
        $this->conditions = array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', array('IN', 'status', '1,2'), array('IN', 'type', '1,2,0,3,4,5,6,7'));
        $this->condition_values = array($month, $year, $employee);
        $this->order_by = array('date');
        $this->query_generate();
        $datas = $this->query_fetch();


        return $datas;
    }

    function get_leave_details_by_month_and_year($month, $year, $employee) {
        $leave = array();
        $this->tables = array('leave');
        $this->fields = array('distinct type');
        $this->conditions = array('AND', array('AND', 'month(date) = ?', 'year(date) = ?', 'employee = ?', 'status = 1'));

        $this->condition_values = array($month, $year, $employee,);

        $this->query_generate();
        $datas = $this->query_fetch();

        return $datas;
    }

    function getLeaveType($employee, $date, $time_from, $time_to) {
        $this->tables = array('leave');
        $this->fields = array('type');
        $this->conditions = array('AND', 'date = ?', 'employee = ?', 'time_from <= ?', 'time_to >= ?', 'status = 1');
        $this->condition_values = array($date, $employee, (float) $time_from, (float) $time_to);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function categorize_employee_work_report($employee, $month, $year) {
        $inconvenient_entries = $this->get_inconvenient_details_by_month_and_year($month, $year);
        $works = $this->get_all_work_details($employee, $month, $year);
        //print_r($works);
        //echo "<br />";
        //echo "welcome. <br />";
        $this->inconvient_slots = array();
        $new_array_count = 0;
        for ($i = 0; $i < count($works); $i++) {
            if ($works[$i]['date'] != $works[$i - 1]['date']) {
                $new_array_count = $new_array_count + 1;
                $this->inconvient_slots[$new_array_count]['date'] = $works[$i]['date'];
            }
            //$this->inconvient_slots[$i]['type']=$works[$i]['type'];
            $IL = $works[$i]['time_from'];        //input lower limit
            $IU = $works[$i]['time_to'];          //input upper limit
            $flag_out = true; //it indicate not forcefully breaked
            for ($j = 0; $j < count($inconvenient_entries); $j++) {
                $SL = $inconvenient_entries[$j]['time_from'];     //solution lower limit
                $SU = $inconvenient_entries[$j]['time_to'];       //solution upper limit
                //$this->set_inconvinient_slots($IL,$IU,$SL,$SU,$inconvenient_entries[$j],$works[$i]);
                //$flg=false;     //break to inner for loop
                $time_diff = 0;
                if ($IL >= $SL && $IU <= $SU) {    //1
                    $time_diff = $this->time_difference($IU, $IL);
                    if ($works[$i]['type'] == 0 || $works[$i]['type'] == 1 || $works[$i]['type'] == 2)
                        $this->inconvient_slots[$new_array_count]['norm_' . ($inconvenient_entries[$j]['name'])] = $this->inconvient_slots[$new_array_count]['norm_' . ($inconvenient_entries[$j]['name'])] + $time_diff;
                    elseif ($works[$i]['type'] == 3)
                        $this->inconvient_slots[$new_array_count]['call_' . ($inconvenient_entries[$j]['name'])] = $this->inconvient_slots[$new_array_count]['call_' . ($inconvenient_entries[$j]['name'])] + $time_diff;
                    $flag_out = false;
                    break;
                }
                elseif ($IL <= $SL && $IU <= $SL) {    //2
                    //check next type
                    continue;
                } elseif ($IL >= $SU && $IU >= $SU) {        //3
                    //check next type
                    continue;
                } elseif ($IL < $SL && $IU > $SL && $IU <= $SU) {        //4
                    $time_diff = $this->time_difference($IU, $SL);
                    if ($works[$i]['type'] == 0 || $works[$i]['type'] == 1 || $works[$i]['type'] == 2)
                        $this->inconvient_slots[$new_array_count]['norm_' . ($inconvenient_entries[$j]['name'])] = $this->inconvient_slots[$new_array_count]['norm_' . ($inconvenient_entries[$j]['name'])] + $time_diff;
                    elseif ($works[$i]['type'] == 3)
                        $this->inconvient_slots[$new_array_count]['call_' . ($inconvenient_entries[$j]['name'])] = $this->inconvient_slots[$new_array_count]['call_' . ($inconvenient_entries[$j]['name'])] + $time_diff;
                    $IL = $IL;
                    $IU = $SL;
                    continue;
                    //$flg=true;
                }
                elseif ($IL >= $SL && $IL < $SU && $IU > $SU) {     //5
                    $time_diff = $this->time_difference($SU, $IL);
                    if ($works[$i]['type'] == 0 || $works[$i]['type'] == 1 || $works[$i]['type'] == 2)
                        $this->inconvient_slots[$new_array_count]['norm_' . ($inconvenient_entries[$j]['name'])] = $this->inconvient_slots[$new_array_count]['norm_' . ($inconvenient_entries[$j]['name'])] + $time_diff;
                    elseif ($works[$i]['type'] == 3)
                        $this->inconvient_slots[$new_array_count]['call_' . ($inconvenient_entries[$j]['name'])] = $this->inconvient_slots[$new_array_count]['call_' . ($inconvenient_entries[$j]['name'])] + $time_diff;
                    $IL = $SU;
                    $IU = $IU;
                    continue;
                    //$flg=true;
                }
                elseif ($IL < $SL && $IU > $SU) {  //6
                    $time_diff = $this->time_difference($SU, $SL);
                    if ($works[$i]['type'] == 0 || $works[$i]['type'] == 1 || $works[$i]['type'] == 2)
                        $this->inconvient_slots[$new_array_count]['norm_' . ($inconvenient_entries[$j]['name'])] = $this->inconvient_slots[$new_array_count]['norm_' . ($inconvenient_entries[$j]['name'])] + $time_diff;
                    elseif ($works[$i]['type'] == 3)
                        $this->inconvient_slots[$new_array_count]['call_' . ($inconvenient_entries[$j]['name'])] = $this->inconvient_slots[$new_array_count]['call_' . ($inconvenient_entries[$j]['name'])] + $time_diff;

                    $new_array = array($works[$i]);

                    $new_array[0]['time_from'] = $SU;
                    $new_array[0]['time_to'] = $IU;
                    array_splice($works, $i + 1, 0, $new_array);    //insert new row to work array to get remaining time slot
                    //print_r($new_array);
                    //$pending[]=$SU;
                    //$pending[]=$IU;
                    //$pending[]=$new_array_count;
                    $IL = $IL;
                    $IU = $SL;  //check
                    continue;
                }
                //-------------------------------------------

                /* if(!empty($pending))
                  {
                  //echo 'welcome arion';
                  $IU = array_pop($pending);
                  $IL = array_pop($pending);
                  $j=-1;
                  //echo $IU."hi";
                  //continue;
                  } */
                // break;
            }
            //print_r($works);
            if ($flag_out && $j == count($inconvenient_entries)) {
                if ($works[$i]['type'] == 0 || $works[$i]['type'] == 1 || $works[$i]['type'] == 2)
                    $this->inconvient_slots[$new_array_count]['norm_ordinary'] = $this->inconvient_slots[$new_array_count]['norm_ordinary'] + ($this->time_difference($IU, $IL));
                elseif ($works[$i]['type'] == 3)
                    $this->inconvient_slots[$new_array_count]['call_ordinary'] = $this->inconvient_slots[$new_array_count]['call_ordinary'] + ($this->time_difference($IU, $IL));
            }
        }
        //print_r($pending);
        //print_r($this->inconvient_slots);
        return $this->inconvient_slots;
    }

    function get_all_leaves_for_report($employee, $month, $year) {
        $this->tables = array('leave');
        $this->fields = array('date', 'time_from', 'time_to', 'type');
        $this->conditions = array('AND', 'employee like ?', 'month(date)= ?', 'year(date)= ?', 'status=1');
        $this->condition_values = array($employee, $month, $year);
        //$this->group_by = array('timetable.customer', 'timetable.date', 'timetable.work');
        $this->order_by = array('date');
        $this->query_generate();
        //echo $this->sql_query;
        $datas = $this->query_fetch();
        return $datas;
    }

    function merge_work_and_leaves($work_details, $leaves) {
        $new_merge_array = array();
        //print_r($leaves);
        for ($i = 1; $i < count($work_details); $i++) {
            $flg = false;
            $k = 0;
            for ($j = 0; $j < count($leaves); $j++) {
                if ($work_details[$i]['date'] == $leaves[$j]['date']) {
                    $flg = true;
                    $k = $j;
                    continue;
                } else {
                    
                }
            }
            if ($flg) {
                //$new_merge_array[$i]=array_merge($work_details[$i],$leaves[$k]);
                //$new_merge_array[$i]=array_merge($work_details[$i]);
                //$tDiff=$this->time_difference($leaves[$k]['time_from'],$leaves[$k]['time_to']);
                //array_push($new_merge_array[$i], [($leaves[$k]['type'])] => $tDiff);
//                $new_array[0]['type']=$leaves[$k]['type'];
//                $new_array[0]['timeDiff']=$tDiff;
                //array_splice( $new_merge_array[$i], $i+1, 0, $leaves[$k]); 
                $new_merge_array[] = $work_details[$i] + $leaves[$k];
                //$this->inconvient_slots[$new_array_count]['call_'.($inconvenient_entries[$j]['name'])];
            } else {
                $new_merge_array[] = $work_details[$i];
                //array_splice($new_merge_array[$i], $i+1, 0, $work_details[$i]); 
            }
        }
        foreach ($leaves as $entries) {
            $flg = true;
            for ($i = 0; $i < count($new_merge_array); $i++) {
                if (in_array($entries['date'], $new_merge_array[$i]))
                    $flg = FALSE;
            }
            if ($flg)
                $new_merge_array[] = $entries;
        }
        //sort($new_merge_array);
        $dates = array();     //sort resultant array
        foreach ($new_merge_array as $key => $row) {
            $dates[$key] = $row['date'];
        }

        array_multisort($dates, SORT_ASC, $new_merge_array);
        return $new_merge_array;
    }

    /*     * ***************************end *******************employee work report details*************************** */

    function distinct_employee() {      //not used
        $this->tables = array('employee');
        $this->fields = array('distinct(username) as uname', 'concat(first_name," ", last_name) as fullname');
        $this->order_by = array('uname');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function distinct_years() {
        $this->tables = array('timetable');
        $this->fields = array('distinct(year(date)) as years');
        $this->order_by = array('years desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        return $datas;
    }

    function employee_pdf_report($dataset, $emp_name, $month, $year, $r_heading, $r_sub_head, $col_heading, $total_cap) {
        $pdf = new PDF();
        //$header = array('Date', 'Work', 'Customer', 'Normal', 'Travel', 'Break', 'Total Hour');
        $pdf->AddPage();
        //$pdf->SetFont('Arial','B',8); 
        $pdf->report_Header($r_heading);
        $pdf->SubHeading($r_sub_head, $emp_name, $month, $year);
        $pdf->FancyTable($col_heading, $dataset, $total_cap);
        //$pdf->Footer();
        $pdf->Output();
    }

    function distinct_log_years() {

        //update
        $this->tables = array('log_login');
        $this->fields = array('distinct(year(login_time))as years1');
        $this->order_by = array('years1 desc');
        $this->query_generate();
        $datas = $this->query_fetch(2);
        //print_r($datas);
        return $datas;
    }

    function employee_log_report($employee, $year, $month) {

        //update
        //echo "emp ".$employee."<br>";
        //echo "yr ".$year."<br>";
        //echo "mn ".$month."<br>";
        if ($employee != 'all') {
            $this->tables = array('log_login', 'employee');
            $this->fields = array('log_login.ip as ip', 'log_login.browser as browser', 'log_login.username as empid', "concat(employee.first_name,' ',employee.last_name) as empname", 'date(log_login.login_time) as lin_date', 'time(log_login.login_time) as lin_time', 'time(log_login.logout_time) as lof_time', 'TIMEDIFF(log_login.logout_time,log_login.login_time) as total_time');
            $this->conditions = array('AND', 'log_login.username like ?', 'month(log_login.login_time)= ?', 'year(log_login.login_time)= ?', 'log_login.username like employee.username');
            $this->condition_values = array($employee, $month, $year);
            $this->order_by = array('date(log_login.login_time) desc', 'log_login.username asc', 'time(log_login.login_time) desc');
            //$this->group_by = array('timetable.customer','timetable.date','timetable.work');
            $this->query_generate();
            //echo $this->sql_query."<br />";
            $datas = $this->query_fetch();
            //echo 'row1:'.count($datas);
            //echo 'row2:'.count($datas[0]);
            //print_r($datas);
            return $datas;
        } else {
            $this->tables = array('log_login', 'employee');
            $this->fields = array('log_login.ip as ip', 'log_login.browser as browser', 'log_login.username as empid', "concat(employee.first_name,' ',employee.last_name) as empname", 'date(log_login.login_time) as lin_date', 'time(log_login.login_time) as lin_time', 'time(log_login.logout_time) as lof_time', 'TIMEDIFF(log_login.logout_time,log_login.login_time) as total_time');
            $this->conditions = array('AND', 'month(log_login.login_time)= ?', 'year(log_login.login_time)= ?', 'log_login.username like employee.username');
            $this->condition_values = array($month, $year);
            $this->order_by = array('date(log_login.login_time) desc', 'log_login.username asc', 'time(log_login.login_time) desc');
            //$this->group_by = array('timetable.customer','timetable.date','timetable.work');
            $this->query_generate();
            //echo $this->sql_query;
            $datas = $this->query_fetch();
            return $datas;
        }
    }

    // checks whether the employees of two shift can interchange
    function employee_swap($id1, $id2) {

        $slot_det1 = $this->customer_employee_slot_details($id1);
        $slot_det2 = $this->customer_employee_slot_details($id2);
        $msg = new message();
        if ($slot_det1['employee'] != $slot_det2['employee']) {

            //echo "<script>alert(\"".$emp_work."\")</script>";
            //checking user1 is suitable for user2's shift
            $this->tables = array('timetable');
            $this->fields = array('id', 'date', 'time_from', 'time_to', 'employee', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
            $this->conditions = array('AND', array('AND', 'id != ?', 'date = ?', 'employee = ?'),
                array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                    array('AND', 'time_to > ?', 'time_to <= ?'),
                    array('AND', 'time_from <= ?', 'time_to >= ?')
                )
            );

            $this->condition_values = array($slot_det1['id'], $slot_det2['date'], $slot_det1['employee'],
                $slot_det2['time_from'], $slot_det2['time_to'],
                $slot_det2['time_from'], $slot_det2['time_to'],
                $slot_det2['time_from'], $slot_det2['time_to']
            );

            $this->query_generate();
            $datas = $this->query_fetch();
            if (count($datas)) {
                $msg->set_message('fail', 'slot_collide');
                $msg->set_message_exact('fail', $datas[0]['emp_first_name']. ' '. $datas[0]['emp_last_name'] . ' ' . $datas[0]['date'] . ' ' . str_pad($datas[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($datas[0]['time_to'], 5, '0', STR_PAD_LEFT));
                return false;
            } else if($this->chk_employee_rpt_signed($slot_det1['employee'], $slot_det2['date']) == 1){
                $msg->set_message('fail', 'employee_signed_in');
                $msg->set_message_exact('fail', $slot_det1['emp_first_name']. ' '. $slot_det1['emp_last_name']. '=>' . $slot_det2['date']);
                return false;
            }else {
                //checking user2 is suitable for user1's shift
                $this->tables = array('timetable');
                $this->fields = array('id', 'date', 'time_from', 'time_to', 'employee', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
                $this->conditions = array('AND', array('AND', 'id != ?', 'date = ?', 'employee = ?'),
                    array('OR', array('AND', 'time_from >= ?', 'time_from < ?'),
                        array('AND', 'time_to > ?', 'time_to <= ?'),
                        array('AND', 'time_from <= ?', 'time_to >= ?')
                    )
                );

                $this->condition_values = array($slot_det2['id'], $slot_det1['date'], $slot_det2['employee'],
                    $slot_det1['time_from'], $slot_det1['time_to'],
                    $slot_det1['time_from'], $slot_det1['time_to'],
                    $slot_det1['time_from'], $slot_det1['time_to']
                );

                $this->query_generate();

                $datas = $this->query_fetch();
                if (count($datas)) {
                    $msg->set_message('fail', 'slot_collide');
                    $msg->set_message_exact('fail', $datas[0]['emp_first_name']. ' '. $datas[0]['emp_last_name'] . ' ' . $datas[0]['date'] . ' ' . str_pad($datas[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($datas[0]['time_to'], 5, '0', STR_PAD_LEFT));
                    return false;
                } else if($this->chk_employee_rpt_signed($slot_det2['employee'], $slot_det1['date']) == 1){
                    $msg->set_message('fail', 'employee_signed_in');
                    $msg->set_message_exact('fail', $slot_det2['emp_first_name']. ' '. $slot_det2['emp_last_name']. '=>' . $slot_det1['date']);
                    return false;
                }else {
                    $this->tables = array('timetable');
                    $this->fields = array('employee');
                    $this->field_values = array($slot_det2['employee']);
                    $this->conditions = array('id=?');
                    $this->condition_values = array($slot_det1['id']);
                    if ($this->query_update()) {
                        $this->tables = array('timetable');
                        $this->fields = array('employee');
                        $this->field_values = array($slot_det1['employee']);
                        $this->conditions = array('id=?');
                        $this->condition_values = array($slot_det2['id']);
                        if ($this->query_update()) {
                            $msg->set_message('success', 'swap_success');
                            $atl1 = $this->checkATL($slot_det1['emp_first_name']. ' '. $slot_det1['emp_last_name'], $slot_det2['date'], $slot_det2['time_from'], $slot_det2['time_to'], $id2);
                            $atl2 = $this->checkATL($slot_det2['emp_first_name']. ' '. $slot_det2['emp_last_name'], $slot_det1['date'], $slot_det1['time_from'], $slot_det1['time_to'], $id1);
                            if (!$atl1 && !$atl2) {
                                $msg->set_message_exact('warning', 'ATL varning=>' . $atl1 . ' , ' . $atl2);
                            } else if (!$atl1) {
                                $msg->set_message_exact('warning', 'ATL varning=>' . $atl1);
                            } else if (!$atl2) {
                                $msg->set_message_exact('warning', 'ATL varning=>' . $atl2);
                            }
                            return true;
                        } else {
                            $msg->set_message('fail', 'swaping_failed');
                            return false;
                        }
                    } else {
                        $msg->set_message('fail', 'swaping_failed');
                        return false;
                    }
                }
            }
        } else {
            $msg->set_message('fail', 'swap_emp_should_be_different');
            return false;
        }
    }

    /// setting up slot type fkkkn
    function employee_fkkn_update($id, $type) {
        $status = 1;
        $this->tables = array('timetable');
        $this->fields = array('fkkn');
        $this->field_values = array($type);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }

    //direct priliminary settings
    function employee_direct_preliminary_update($id, $type) {
        //echo "<script>alert(\"".$id."\")</script>";
        $slot_det = $this->customer_employee_slot_details($id);
        $this->tables = array('timetable');
        $this->fields = array('status');
        if ($type == 3) {
            $this->field_values = array($type);
        } else {
            if ($slot_det['customer'] == '' || $slot_det['employee'] == '') {
                $this->field_values = array('0');
            } else {
                $this->field_values = array('1');
            }
        }
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_update()) {
            return true;
        } else {
            return false;
        }
    }

    /*     * ********************************shamsu *********employee monthly report*********start********* */

    function get_customer_employee_report($employee, $year = NULL, $month = NULL) { //not used
        $this->tables = array('note` as `n', 'employee` as `e');
        $this->fields = array('n.id as id', 'n.created_user', "concat(e.first_name,' ',e.last_name) as emp_name", 'n.title', 'n.description', 'n.visibility', 'n.date', 'n.status');


        if ($year != NULL && $month != NULL)
            $this->conditions = array('AND', 'year(n.date) = "' . $year . '"', 'month(n.date) = "' . $month . '"', 'n.visibility = 2', 'n.created_user like e.username');
        else
            $this->conditions = array('AND', 'n.visibility = 2', 'n.created_user like e.username');
        break;


        $this->query_generate();
        $qry2 = $this->sql_query;   //qry2 gets specified private notes

        $this->sql_query = '( ' . $qry1 . ' ) UNION ( ' . $qry2 . ' )  ORDER BY id';
        $data = $this->query_fetch();
        return $data;
    }

    function employee_signing_Transaction() {

//        $employee->username = $report_employee;
//        $employee->signing_report_date = $year.'-'.$month.'-1';
        $login_user = $_SESSION['user_id'];
        $user = new user();
        $login_user_role = $user->user_role($login_user);

        if ($login_user_role == 1) {
            $this->signing_employee = $login_user;
            $this->signing_employee_date = date('Y-m-d H:i:s');
            $this->signing_suTL_date = date('Y-m-d H:i:s');
            $this->signing_suTL_employee = $login_user;
            $this->signing_TL_date = date('Y-m-d H:i:s');
            $this->signing_TL_employee = $login_user;
        } else {
            if ($login_user == $this->username) {
                $this->signing_employee = $login_user;
                $this->signing_employee_date = date('Y-m-d H:i:s');
            }
            if ($user->check_SuperTL_or_not_from_team($login_user)) {
                $this->signing_suTL_date = date('Y-m-d H:i:s');
                $this->signing_suTL_employee = $login_user;
            }
            if ($user->get_customers_in_which_am_TL($login_user)) {
                $this->signing_TL_date = date('Y-m-d H:i:s');
                $this->signing_TL_employee = $login_user;
            }
        }

        $sign_data = $this->employee_signing_existance_check_simple();
        if (!empty($sign_data)) {
            if ($sign_data['signin_employee'] != '') {
                $this->signing_employee = $sign_data['signin_employee'];
                $this->signing_employee_date = $sign_data['signin_date'];
            }
            if ($sign_data['signin_sutl'] != '') {
                $this->signing_suTL_date = $sign_data['signin_sutl_date'];
                $this->signing_suTL_employee = $sign_data['signin_sutl'];
            }
            if ($sign_data['signin_tl'] != '') {
                $this->signing_TL_date = $sign_data['signin_tl_date'];
                $this->signing_TL_employee = $sign_data['signin_tl'];
            }
            if ($this->employee_signing_update($sign_data['id'])) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else if ($this->employee_signing_insert()) {
            return TRUE;
        }else
            return FALSE;
    }

    function employee_signing_insert() {

        $this->tables = array('report_signing');
        $this->fields = array('employee', 'date', 'signin_employee', 'signin_date', 'signin_tl', 'signin_tl_date', 'signin_sutl', 'signin_sutl_date');
        $this->field_values = array($this->username, $this->signing_report_date, $this->signing_employee, $this->signing_employee_date, $this->signing_TL_employee, $this->signing_TL_date, $this->signing_suTL_employee, $this->signing_suTL_date);
        $data = $this->query_insert();
        if ($data)
            return true;
        else
            return FALSE;
    }

    function employee_signing_update($id) {
        $this->tables = array('report_signing');
        $this->fields = array('signin_employee', 'signin_date', 'signin_tl', 'signin_tl_date', 'signin_sutl', 'signin_sutl_date');
        $this->field_values = array($this->signing_employee, $this->signing_employee_date, $this->signing_TL_employee, $this->signing_TL_date, $this->signing_suTL_employee, $this->signing_suTL_date);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
//        $this->conditions = array('AND', 'employee = ?', 'date = ?');
//        $this->condition_values = array($this->username, $this->signing_report_date);

        if ($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function employee_signing_remove() {

        $this->tables = array('report_signing');
        $this->conditions = array('AND', 'employee = ?', 'date = ?');
        $this->condition_values = array($this->username, $this->signing_report_date);
        if ($this->query_delete())
            return true;
        else
            return FALSE;
    }

    function employee_signing_existance_check() {

        $user = new user();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
//        echo $this->signing_report_date;
        $flg =FALSE;
        if($login_user_role == 7){
            if($user->check_SuperTL_or_not_from_team($login_user))  // to check atleast onentry with he is SuTL in Team table
                $flg = TRUE;
        }else if($login_user_role == 2){
            if($user->get_customers_in_which_am_TL($login_user))    // to check atleast onentry with he is TL in Team table
                $flg = TRUE;
        }
//        echo $this->signing_report_date;
        $this->tables = array('report_signing');
        $this->fields = array('signin_employee', 'signin_date');
        switch ($login_user_role) {

            case 1:
                $this->conditions = array('AND', 'employee = ?', 'date = ?', array('AND', 'signin_employee != ""', 'signin_tl != ""', 'signin_sutl != ""'));
                $this->condition_values = array($this->username, $this->signing_report_date);
                break;
            case 2:
                if($flg){
                    $this->conditions = array('AND', 'employee = ?', 'date = ?', 'signin_tl = ?');
                    $this->condition_values = array($this->username, $this->signing_report_date, $login_user);
                }else{
                    $this->conditions = array('AND', 'employee = ?', 'date = ?', 'signin_employee = ?');
                    $this->condition_values = array($this->username, $this->signing_report_date, $login_user);
                }
                break;
            case 3:
                $this->conditions = array('AND', 'employee = ?', 'date = ?', 'signin_employee = ?');
                $this->condition_values = array($this->username, $this->signing_report_date, $login_user);
                break;
            case 7:
                if($flg){
                    $this->conditions = array('AND', 'employee = ?', 'date = ?', 'signin_sutl = ?');
                    $this->condition_values = array($this->username, $this->signing_report_date, $login_user);
                }else{
                    $this->conditions = array('AND', 'employee = ?', 'date = ?', 'signin_employee = ?');
                    $this->condition_values = array($this->username, $this->signing_report_date, $login_user);
                }
                break;
        }

//        $this->conditions = array('AND', 'employee = ?', 'date = ?');
//        $this->condition_values = array($this->username, $this->signing_report_date);
        $this->query_generate();
//        echo $this->sql_query;
        $data = $this->query_fetch();
//        print_r($data);
        if (!empty($data))
            return TRUE;
        else
            return FALSE;
    }

    function employee_signing_existance_check_simple() {

        $this->tables = array('report_signing');
        $this->fields = array('id', 'employee', 'date', 'signin_employee', 'signin_date', 'signin_tl', 'signin_tl_date', 'signin_sutl', 'signin_sutl_date');
        $this->conditions = array('AND', 'employee = ?', 'date = ?');
        $this->condition_values = array($this->username, $this->signing_report_date);
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data))
            return $data[0];
        else
            return FALSE;
    }

    function get_employees_in_a_Team($customer_name) {      //not used
        $this->tables = array('employee` as `e', 'team` as `t');
        $this->fields = array('distinct(t.employee) as uname', 'concat(e.first_name," ", e.last_name) as fullname');
        $this->conditions = array('AND', 't.customer = ?', 't.employee like e.username');
        $this->condition_values = array($customer_name);
        $this->order_by = array('fullname');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    /*     * *********************end***********shamsu ****************** */

    /*   ------------------------------shaju---------------------------   */

    function copy_multiple_slot_to_multiple($slots, $from_wk, $to_wk, $from_option, $with_user, $days, $cur_date) {

        $msg = new message();
        $dona = new dona();

        $weeks = "'";
        $i = 0;
        foreach ($days as $day) {
            if ($i != 0)
                $weeks .= ",'";
            $weeks .= $day . "'";
            $i++;
        }


        $paste_start_date = '';
        if (date('W', strtotime($cur_date)) == $from_wk) {

            $paste_start_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($cur_date)) . ' +1 day'));
        } else {
            $paste_start_date = date('Y-m-d', strtotime(date('Y') . "W" . $from_wk . '1'));
        }

        $paste_year = substr($to_wk, 0, 4);
        $paste_week = str_pad(substr($to_wk, 5), 2, '0', STR_PAD_LEFT);
        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));

        $copiable = true;
        $paste_date = $paste_start_date;
        if ($with_user == 1) {

            while (strtotime($paste_date) <= strtotime($paste_end_date)) {

                if (in_array((date('N', strtotime($paste_date)) % 7), $days)) {
                    foreach ($slots as $data) {

                        $this->tables = array('timetable');
                        $this->fields = array('id', 'time_from', 'time_to');
                        $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', array('NOT IN', 'status', '2'));
                        $this->condition_values = array($data['time_from'], $data['time_to'], $data['time_from'], $data['time_to'], $data['time_from'], $data['time_to'], $paste_date, $data['employee']);
                        $this->query_generate();
                        $values = $this->query_fetch();
                        if (count($values)) {

                            $copiable = false;
                            $msg->set_message('fail', 'slot_collide');
                            $msg->set_message_exact('fail', $data['employee'] . ' ' . $data['date'] . ' ' . $data['time_from'] . '-' . $data['time_to'] . '=>' . $paste_date . ' ' . $values[0]['time_from'] . '-' . $values[0]['time_to']);
                            return false;
                        }
                        if($this->chk_employee_rpt_signed($data['employee'], $paste_date)){
                            $copiable = false;
                            $msg->set_message('fail', 'employee_signed_in');
                            $msg->set_message_exact('fail', $data['employee'] . '=>' . $paste_date);
                            return false;
                        }
                    }
                }
                if (date('N', strtotime($paste_date)) == 7)
                    $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
            }
        }
        if ($copiable) {
            //echo "<script>alert(\"" . $with_user . "\")</script>";
            $this->begin_transaction();
            $paste_date = $paste_start_date;
            while (strtotime($paste_date) <= strtotime($paste_end_date)) {
                if (in_array((date('N', strtotime($paste_date)) % 7), $days)) {
                    if ($with_user == 1) {
                        foreach ($slots as $data) {

                            if (!$dona->customer_employee_slot_add($data['employee'], $data['customer'], $paste_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                                $msg->set_message('fail', 'insertion_failed');
                                $this->rollback_transaction();
                                $copiable = false;
                                return false;
                            }
                        }
                    } else {
                        foreach ($slots as $data) {
                            if (!$dona->customer_employee_slot_add('', $data['customer'], $paste_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'])) {
                                $msg->set_message('fail', 'insertion_failed');
                                $this->rollback_transaction();
                                $copiable = false;
                                return false;
                            }
                        }
                    }
                }
                if (date('N', strtotime($paste_date)) == 7)
                    $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
            }
        }
        if ($copiable) {
            $msg->set_message('success', 'copy_success');
            $this->commit_transaction();
            return true;
        } else {
            $msg->set_message('fail', 'insertion_failed');
            $this->rollback_transaction();
            return false;
        }
    }

    function copy_single_slot_to_multiple($id, $from_wk, $to_wk, $from_option, $with_user, $days) {

        $msg = new message();
        $dona = new dona();

        $weeks = "'";
        $i = 0;
        foreach ($days as $day) {
            if ($i != 0)
                $weeks .= ",'";
            $weeks .= $day . "'";
            $i++;
        }

        $data = $this->customer_employee_slot_details($id);
        $paste_start_date = '';


        if (date('W', strtotime($data['date'])) == $from_wk) {

            $paste_start_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($data['date'])) . ' +1 day'));
        } else {
            $paste_start_date = date('Y-m-d', strtotime(date('Y') . "W" . $from_wk . '1'));
        }

        $paste_year = substr($to_wk, 0, 4);
        $paste_week = str_pad(substr($to_wk, 5), 2, '0', STR_PAD_LEFT);
        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));

        $copiable = true;
        $paste_date = $paste_start_date;
        if ($with_user == 1) {
            while (strtotime($paste_date) <= strtotime($paste_end_date)) {
                //echo "<script>alert(\"".(date('N', strtotime($paste_date)) %7)."\")</script>";
                if (in_array((date('N', strtotime($paste_date)) % 7), $days)) {
                    $this->tables = array('timetable');
                    $this->fields = array('id', 'time_from', 'time_to');
                    $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', array('NOT IN', 'status', '2'));
                    $this->condition_values = array($data['time_from'], $data['time_to'], $data['time_from'], $data['time_to'], $data['time_from'], $data['time_to'], $paste_date, $data['employee']);
                    $this->query_generate();
                    $values = $this->query_fetch();
                    if (count($values)) {

                        $copiable = false;
                        $msg->set_message('fail', 'slot_collide');
                        $msg->set_message_exact('fail', $data['emp_first_name']. ' '. $data['emp_last_name'] . ' ' . $data['date'] . ' ' . $data['time_from'] . '-' . $data['time_to'] . '=>' . $paste_date . ' ' . $values[0]['time_from'] . '-' . $values[0]['time_to']);
                        return false;
                    }
                    if($this->chk_employee_rpt_signed($data['employee'], $paste_date)){
                        $copiable = false;
                        $msg->set_message('fail', 'employee_signed_in');
                        $msg->set_message_exact('fail', $data['employee'] . '=>' . $paste_date);
                        return false;
                    }
                }
                if (date('N', strtotime($paste_date)) == 7)
                    $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
            }
        }
        if ($copiable) {
            //echo "<script>alert(\"" . $with_user . "\")</script>";
            $this->begin_transaction();
            $paste_date = $paste_start_date;
            while (strtotime($paste_date) <= strtotime($paste_end_date)) {
                if (in_array((date('N', strtotime($paste_date)) % 7), $days)) {
                    if ($with_user == 1) {

                        if (!$dona->customer_employee_slot_add($data['employee'], $data['customer'], $paste_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                            $msg->set_message('fail', 'insertion_failed');
                            $this->rollback_transaction();
                            $copiable = false;
                            return false;
                        }
                    } else {

                        if (!$dona->customer_employee_slot_add('', $data['customer'], $paste_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                            $msg->set_message('fail', 'insertion_failed');
                            $this->rollback_transaction();
                            $copiable = false;
                            return false;
                        }
                    }
                }
                if (date('N', strtotime($paste_date)) == 7)
                    $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
                $paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
            }
        }
        if ($copiable) {
            $msg->set_message('success', 'copy_success');
            $this->commit_transaction();
            return true;
        } else {
            $msg->set_message('fail', 'insertion_failed');
            $this->rollback_transaction();
            return false;
        }
        //echo "<script>alert(\"".date('Y-m-d',$paste_end_date)."\")</script>";
    }

    
    /// from process main
    function copy_weeks($copy_start, $copy_end, $paste_start, $paste_end, $no_of_times, $employees, $days, $with_user, $user='', $unmanned=0) {
        $msg = new message();
        $dona = new dona();
        $obj_user = new user();
        $user_role = $obj_user->user_role($user);
        $obj_cust = new customer();
        $smarty = new smartySetup(array('gdschema.xml'));
        $emp = "'";
        $i = 0;
        foreach ($employees as $employee) {
            if ($i != 0)
                $emp .= ",'";
            $emp .= $employee . "'";
            $i++;
        }
        $weeks = "'";
        $i = 0;
        foreach ($days as $day) {
            if ($i != 0)
                $weeks .= ",'";
            $weeks .= $day . "'";
            $i++;
        }

        $this->tables = array('timetable');
        $this->fields = array('employee', 'customer', 'fkkn', 'date', 'time_from', 'time_to', 'type', 'status',  '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        if ($user_role == 4) {
            $this->conditions = array('AND', 'customer = ?', array('IN', 'employee', $emp), array('IN', 'status', '0,1,3'), array('BETWEEN', 'date', '\'' . $copy_start . '\'', '\'' . $copy_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
            $this->condition_values = array($user);
        } else {
            $this->conditions = array('AND', array('IN', 'employee', $emp), array('IN', 'status', '0,1,3'), array('BETWEEN', 'date', '\'' . $copy_start . '\'', '\'' . $copy_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
        }
        $this->order_by = array('date', 'time_from');
        $this->query_generate();
        $datas = $this->query_fetch();
        if (count($datas)) {
            $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
            $copiable = true;
            if ($with_user == 1) {
                for ($i = 1; $i <= $no_of_times; $i++) {

                    foreach ($datas as $data) {
                        //$new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($data['date'])) . " +" . ($date_diff * $i) . " days"));
                        $new_date = date('Y-m-d', strtotime($data['date'] . " +" . ($date_diff * $i) . " days"));
                        //echo '<script>alert(\'' . $new_date . '\')</script>';
                        $this->tables = array('timetable');
                        $this->fields = array('id', 'time_from', 'time_to');
                        $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', array('NOT IN', 'status', '2'));
                        $this->condition_values = array($data['time_from'], $data['time_to'], $data['time_from'], $data['time_to'], $data['time_from'], $data['time_to'], $new_date, $data['employee']);
                        $this->query_generate();
                        $values = $this->query_fetch();
                        if (count($values)) {

                            $copiable = false;
                            $msg->set_message('fail', 'slot_collide');
                            $msg->set_message_exact('fail', $data['emp_first_name']. ' '. $data['emp_last_name'] . ' ' . $data['date'] . ' ' . $data['time_from'] . '-' . $data['time_to'] . '=>' . $new_date . ' ' . $values[0]['time_from'] . '-' . $values[0]['time_to']);
                            return false;
                        }
                        if($this->chk_employee_rpt_signed($data['employee'], $new_date)){
                            $copiable = false;
                            $msg->set_message('fail', 'employee_signed_in');
                            $msg->set_message_exact('fail', $data['emp_first_name']. ' '. $data['emp_last_name'] . '=>' . $new_date);
                            return false;
                        }
                    }
                }
            }
            if ($copiable) {
                $this->begin_transaction();
                if ($with_user == 1) {
                    for ($i = 1; $i <= $no_of_times; $i++) {

                        foreach ($datas as $data) {
                            $new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($data['date'])) . " +" . ($date_diff * $i) . " days"));
                            //echo '<script>alert(\'' . $data['date'] . '\')</script>';
                            
                            if (!$dona->customer_employee_slot_add($data['employee'], $data['customer'], $new_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                                $msg->set_message('fail', 'insertion_failed');
                                $this->rollback_transaction();
                                $copiable = false;
                                return false;
                            }
                        }
                    }
                } else {
                    for ($i = 1; $i <= $no_of_times; $i++) {

                        foreach ($datas as $data) {
                            $new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($data['date'])) . " +" . ($date_diff * $i) . " days"));
                            if ($data['customer'] != '') {
                                if (!$dona->customer_employee_slot_add('', $data['customer'], $new_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                                    $msg->set_message('fail', 'insertion_failed');
                                    $this->rollback_transaction();
                                    $copiable = false;
                                    return false;
                                }
                            }
                        }
                    }
                }
                if($unmanned == 1){
                    $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
                    $copiable = true;
                    if($copiable){
                        $this->tables = array('timetable');
                        $this->fields = array('employee', 'customer', 'fkkn', 'date', 'time_from', 'time_to', 'type', 'status');
                        $this->conditions = array('AND', 'customer = ?', array('OR', 'employee = ?', 'employee is NULL'), array('IN', 'status', '0,3'), array('BETWEEN', 'date', '\'' . $copy_start . '\'', '\'' . $copy_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
                        $this->condition_values = array($user,'');
                        $this->order_by = array('date', 'time_from');
                        $this->query_generate();
                        $datas = $this->query_fetch();
                        if (count($datas)) {
                            $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
                            for ($i = 1; $i <= $no_of_times; $i++) {

                                foreach ($datas as $data) {
                                    $new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($data['date'])) . " +" . ($date_diff * $i) . " days"));
                                    if ($data['customer'] != '') {
                                        if (!$dona->customer_employee_slot_add('', $data['customer'], $new_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                                            $msg->set_message('fail', 'insertion_failed');
                                            $this->rollback_transaction();
                                            $copiable = false;
                                            return false;
                                        }
                                    }
                                }
                            }
                        }
                    }    
            
                }
                
            } else {
                $copiable = false;
                $msg->set_message('fail', 'slot_collide');
                return false;
            }
            if ($copiable) {
                $msg->set_message('success', 'copy_success');
                $copy_message = '';
                if($user_role == 4){
                    $cust_details = $obj_cust->customer_detail($user);
                    $copy_message = ' '.$cust_details['first_name'].' '.$cust_details['last_name'].' =>';
                }
                $copy_message .= ' '.substr($copy_start,0,10).' - '.substr($copy_end,0,10).' '.$smarty->translate['to'].' '.substr($paste_start,0,10).' - '.substr($paste_end,0,10);
                $msg->set_message_exact('success', $copy_message);
                $this->commit_transaction();
                return true;
            } else {
                $msg->set_message('fail', 'insertion_failed');
                $this->rollback_transaction();
                return false;
            }
        } else {
            if($unmanned == 1){
                $copiable = true;
                if($copiable){
                    $this->tables = array('timetable');
                    $this->fields = array('employee', 'customer', 'fkkn', 'date', 'time_from', 'time_to', 'type', 'status');
                    $this->conditions = array('AND', 'customer = ?', array('OR', 'employee = ?', 'employee is NULL'), array('IN', 'status', '0,3'), array('BETWEEN', 'date', '\'' . $copy_start . '\'', '\'' . $copy_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
                    $this->condition_values = array($user,'');
                    $this->order_by = array('date', 'time_from');
                    $this->query_generate();
                    $datas = $this->query_fetch();
                    if (count($datas)) {
                        $date_diff = (strtotime($paste_start) - strtotime($copy_start)) / (60 * 60 * 24);
                        $this->begin_transaction();
                        for ($i = 1; $i <= $no_of_times; $i++) {

                            foreach ($datas as $data) {
                                $new_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime($data['date'])) . " +" . ($date_diff * $i) . " days"));
                                if ($data['customer'] != '') {
                                    if (!$dona->customer_employee_slot_add('', $data['customer'], $new_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
                                        $msg->set_message('fail', 'insertion_failed');
                                        $this->rollback_transaction();
                                        $copiable = false;
                                        return false;
                                    }
                                }
                            }
                        }
                        if ($copiable) {
                            $msg->set_message('success', 'copy_success');
                            $cust_details = $obj_cust->customer_detail($user);
                            $copy_message = ' '.$cust_details['first_name'].' '.$cust_details['last_name'].' =>';
                            $copy_message .= ' '.substr($copy_start,0,10).' - '.substr($copy_end,0,10).' '.$smarty->translate['to'].' '.substr($paste_start,0,10).' - '.substr($paste_end,0,10);
                            $msg->set_message_exact('success', $copy_message);
                            $this->commit_transaction();
                            return true;
                        } else {
                            $msg->set_message('fail', 'insertion_failed');
                            $this->rollback_transaction();
                            return false;
                        }
                    }else{
                        $msg->set_message('fail', 'no_time_slot_exists');
                        return false;
                    }
                }    

            }else{
                $msg->set_message('fail', 'no_time_slot_exists');
                return false;
            }
        }
    }

    function delete_weeks($del_start, $del_end, $employees, $days, $in_focus=0, $user='', $unmanned = 0) {
        $msg = new message();
        $obj_user = new user();
        $user_role = $obj_user->user_role($user);
        $obj_cust = new customer();
        $emp = "'";
        $i = 0;
        foreach ($employees as $employee) {
            if ($i != 0)
                $emp .= ",'";
            $emp .= $employee . "'";
            $i++;
        }
        $weeks = "'";
        $i = 0;
        foreach ($days as $day) {
            if ($i != 0)
                $weeks .= ",'";
            $weeks .= $day . "'";
            $i++;
        }
        $this->tables = array('timetable');
        if ($user_role == 4 && $in_focus == 1) {
            if($unmanned == 0){
                $this->conditions = array('AND', 'customer = ?', array('IN', 'employee', $emp), array('BETWEEN', 'date', '\'' . $del_start . '\'', '\'' . $del_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
                $this->condition_values = array($user);
            }else if($unmanned == 1){
                $this->conditions = array('AND', 'customer = ?', array('OR', 'employee = ?', 'employee is NULL', array('IN', 'employee', $emp)), array('BETWEEN', 'date', '\'' . $del_start . '\'', '\'' . $del_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
                $this->condition_values = array($user, '');
            }    
        } else {
            $this->conditions = array('AND', array('IN', 'employee', $emp), array('BETWEEN', 'date', '\'' . $del_start . '\'', '\'' . $del_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
        }
        if ($this->query_delete()) {
            $del_message = '';
            if($user_role == 4 && $in_focus == 1){
                $cust_details = $obj_cust->customer_detail($user);
                $del_message = ' '.$cust_details['first_name'].' '.$cust_details['last_name'].' =>';
            }
            $del_message .= ' '.$del_start.' - '.$del_end;
            $msg->set_message('success', 'delete_success');
            $msg->set_message_exact('success', $del_message);
            return true;
        } else {
            $msg->set_message('fail', 'no_time_slot_exists');
            return false;
        }
    }

    function replace_employee($from_date, $to_date, $employee, $employee_rep, $in_focus=0, $user='') {
        $msg = new message();
        $dona = new dona();
        $obj_user = new user();
        $user_role = $obj_user->user_role($user);

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'fkkn', 'date', 'time_from', 'time_to', 'type', 'status');
        if ($user_role == 4 && $in_focus == 1) {
            $this->conditions = array('AND', 'customer=?', 'employee=?', array('IN', 'status', '0,1,3'), array('BETWEEN', 'date', '\'' . $from_date . '\'', '\'' . $to_date . '\''));
            $this->condition_values = array($user, $employee);
        } else {
            $this->conditions = array('AND', 'employee=?', array('IN', 'status', '0,1,3'), array('BETWEEN', 'date', '\'' . $from_date . '\'', '\'' . $to_date . '\''));
            $this->condition_values = array($employee);
        }
        $this->order_by = array('date', 'time_from');
        $this->query_generate();
        $datas = $this->query_fetch();
        if (count($datas)) {

            $copiable = true;

            $ids = "'";
            $i = 0;
            foreach ($datas as $data) {
                if ($i != 0) {
                    $ids .= ",'";
                }
                $ids .= $data['id'] . "'";
                $this->tables = array('timetable');
                $this->fields = array('id', 'time_from', 'time_to', 'date');
                $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', array('NOT IN', 'status', '2'));
                $this->condition_values = array($data['time_from'], $data['time_to'], $data['time_from'], $data['time_to'], $data['time_from'], $data['time_to'], $data['date'], $employee_rep);
                $this->query_generate();
                $values = $this->query_fetch();
                if (count($values)) {
                    $copiable = false;
                    $msg->set_message('fail', 'slot_collide');
                    $msg->set_message_exact('fail', $data['date'] . ' ' . $data['time_from'] . '-' . $data['time_to'] . '=>' . $values[0]['date'] . ' ' . $values[0]['time_from'] . '-' . $values[0]['time_to']);
                    return false;
                }
                $i++;
            }

            if ($copiable) {

                $this->tables = array('timetable');
                $this->fields = array('employee', 'alloc_emp');
                $this->field_values = array($employee_rep, $_SESSION['user_id']);
                $this->conditions = array('IN', 'id', $ids);

                if ($this->query_update()) {
                    $msg->set_message('success', 'replace_success');
                    return true;
                } else {
                    $msg->set_message('fail', 'replace_failed');
                    return false;
                }
            } else {
                $copiable = false;
                $msg->set_message('fail', 'slot_collide');
                return false;
            }
        } else {
            $msg->set_message('fail', 'no_time_slot_exists');
            return false;
        }
    }

    function hex_to_rgb($hex) {

        if ($hex == '')
            $hex = '#FFFFFF';
//        $hex = ereg_replace("#", "", $hex);
        $hex = preg_replace("/#/", "", $hex);
        $color = array();

        if (strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex, 0, 1) . $r);
            $color['g'] = hexdec(substr($hex, 1, 1) . $g);
            $color['b'] = hexdec(substr($hex, 2, 1) . $b);
        } else if (strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
        }
        return $color;
    }

    /*   ------------------------------shaju---------------------------   */


    /*   ----------------start-------------shamsu---------------------------   */

    function exact_employee_list_for_employee_detailed_report($key = NULL) {

        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);

        switch ($login_user_role) {

            case 1:
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                if ($key == Null)
                    $this->conditions = array('AND', 'status = 1');
                else {
                    $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                }
                $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                $this->query_generate();
                //echo $this->sql_query;
                $employee_data = $this->query_fetch();
                break;
            case 2:
                $team_members = $this->team_members_for_employee_report($login_user);
//                echo "<pre>\n".print_r($team_members, 1)."</pre>";
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                if ($key == Null)
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                else {
                    $this->conditions = array('AND', 'status = 1', array('IN', 'username', $team_employee_data), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                }
                $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');

                $this->query_generate();
                //echo $this->sql_query;
                $employee_data = $this->query_fetch();
//                echo "<pre>\n".print_r($employee_data, 1)."</pre>";
                break;
            case 3:
                //$team_members = $this->team_members($login_user);
                //print_r($team_members);
                //$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                if ($key == Null) {
                    $this->conditions = array('AND', 'username LIKE ?', 'status = 1');
                    $this->condition_values = array($login_user);
                } else {
                    $this->conditions = array('AND', 'username LIKE ?', 'status = 1', array('IN', 'username', $team_employee_data), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                }
                $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                $this->query_generate();
                //echo $this->sql_query;
                $employee_data = $this->query_fetch();
                break;
            case 4:
                $this->tables = array('team');
                $this->fields = array('employee');
                $this->conditions = array('customer = ?');
                $this->query_generate();
                $customer_query = $this->sql_query;
                //$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                if ($key == Null) {
                    $this->conditions = array('AND', array('IN', 'username', $customer_query), 'status = 1');
                    $this->condition_values = array($login_user);
                } else {
                    $this->conditions = array('AND', array('IN', 'username', $customer_query), 'status = 1', array('IN', 'username', $team_employee_data), array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                }
                $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                $this->query_generate();
                //echo $this->sql_query;
                $employee_data = $this->query_fetch();
                break;
            case 7:
                $team_members = $this->super_team_members($login_user);
//                print_r($team_members);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('employee');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                if ($key == Null) {
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                } else {
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                }
                $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                $this->query_generate();
                //echo $this->sql_query;
                $employee_data = $this->query_fetch();
                break;
        }
        if (count($employee_data))
            return $employee_data;
        else
            return array();
    }

    function team_members_for_employee_report($username, $mod = 1) {          //used for employee report, mode is used for chating purpose & mc_leave
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?', 'role = 2');
        $this->condition_values = array($username);
        $this->query_generate();
        $cust_query = $this->sql_query;
        $data = $this->query_fetch(2);

        //$TL_customers = '\'' . implode('\', \'', $data) . '\'';
        if (count($data)) {
            $this->tables = array('team');
            $this->fields = array('employee');
            $this->conditions = array('IN', 'customer', $cust_query);
            $this->condition_values = array($username);
            $this->query_generate();
            $datas = $this->query_fetch(2);
//            echo "<pre>\n".print_r($datas, 1)."</pre>";
            return $datas;
        } else if($mod == 2) { //mod = 2 is used only for mc_leave
            return $this->team_members($_SESSION['user_id']);
        } else {
            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?', 'role = 3');
            $this->condition_values = array($username);
            $this->query_generate();
            $datas = $this->query_fetch(2);
            if (count($datas)) {
                $datas = array();
                $datas = array('employee' => $username);
                return $datas;
            }
            else{
                return array();
            }    
        }
    }
    
    function get_team_customer_names_using_emp_role($username, $user_role = NULL ) {          
        
        $data = array();
        $this->tables = array('team');
        $this->fields = array('customer');
        if($user_role != NULL){
            $this->conditions = array('AND', 'employee = ?', 'role = ?');
            $this->condition_values = array($username,$user_role);
        }else{
            $this->conditions = array('AND', 'employee = ?');
            $this->condition_values = array($username);
        }
        $this->query_generate();
//        $cust_query = $this->sql_query;
        $data = $this->query_fetch(2);
        if (!empty($data))
            return $data;
        else
            return array();
    }
    
    
    /* get_team_members_using_customer_name is for mc_leave  */
    function get_team_members_using_customer_name($customer) {    
        
        $data = array();
        $this->tables = array('team');
        $this->fields = array('employee');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->query_generate();
        $data = $this->query_fetch(2);
        
        if (!empty($data))
            return $data;
        else
            return array();
    }

    function update_leave_status() {

        $this->tables = array('leave');
        $this->fields = array('status', 'appr_emp', 'appr_date');
        $this->field_values = array($this->leave_status, $_SESSION['user_id'], date("Y-m-d"));
        $this->conditions = array('group_id = ?');
        $this->condition_values = array($this->leave_id);

        if ($this->query_update())
            return TRUE;
        else
            return FALSE;
    }

    function get_leave_details_byID($id) {

        $this->tables = array('leave` as `l', 'employee` as `e', 'employee` as `e1');
        $this->fields = array('l.id as id', 'l.group_id as gid', 'l.employee as emp_id', "concat(e1.first_name,' ',e1.last_name) as leave_employee", 'l.date as leave_date', 'l.time_from as time_from', 'l.time_to as time_to', 'l.type as type', 'l.appr_date as date', "concat(e.first_name,' ',e.last_name) as empname");
        $this->conditions = array('AND', 'group_id = ?', 'l.appr_emp like e.username', 'l.employee like e1.username');
        $this->condition_values = array($id);
        $this->order_by = array('l.date asc');
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data)
            return $data;
        else
            return array();
    }

    function get_signin_details_by_employee($year, $month, $work_employee) {
        //echo $year. $month . $work_employee."<br>";
//        $this->tables = array('report_signing` as `s', 'employee` as `e1', 'employee` as `e2', 'employee` as `e3');
//        $this->fields = array('s.employee as employee', 's.date as date', 's.signin_employee as signin_employee', 
//            'concat(e1.first_name, " ",e1.last_name) as signin_employee_name', 's.signin_date as signin_date', 
//            's.signin_tl as signin_tl', 'concat(e2.first_name, " ",e2.last_name) as signin_tl_name', 
//            's.signin_tl_date as signin_tl_date', 's.signin_sutl as signin_sutl', 'concat(e3.first_name, " ",e3.last_name) as signin_sutl_name', 's.signin_sutl_date as signin_sutl_date');
//        $this->conditions = array('AND', 'year(s.date) = ?','month(s.date) = ?','s.employee = ?','e1.username like s.signin_employee','e2.username like s.signin_tl','e3.username like s.signin_sutl');
//        $this->condition_values = array($year,$month,$work_employee);
////        $this->order_by = array('first_name', 'last_name');
//        $this->query_generate();
//        echo $this->sql_query;
        $this->sql_query = 'SELECT s.employee AS employee, s.date AS date, s.signin_employee AS signin_employee, 
                concat( e1.first_name, " ", e1.last_name ) AS signin_employee_name, s.signin_date AS signin_date, s.signin_tl AS signin_tl, 
                concat( e2.first_name, " ", e2.last_name ) AS signin_tl_name, s.signin_tl_date AS signin_tl_date, s.signin_sutl AS signin_sutl, 
                concat( e3.first_name, " ", e3.last_name ) AS signin_sutl_name, s.signin_sutl_date AS signin_sutl_date
            FROM `report_signing` AS `s`
            LEFT JOIN `employee` AS `e1` ON ( e1.username LIKE s.signin_employee )
            LEFT JOIN `employee` AS `e2` ON ( e2.username LIKE s.signin_tl )
            LEFT JOIN `employee` AS `e3` ON ( e3.username LIKE s.signin_sutl )
            WHERE 1
            AND year( s.date ) = ' . $year . '
            AND month( s.date ) = ' . $month . '
            AND s.employee = \'' . $work_employee . '\'';
        $data = $this->query_fetch(1);
//        print_r($data);
        if ($data)
            return $data;
        else
            return FALSE;
    }

    function remove_leave_from_leave_tbl($id) {

        $this->tables = array('leave');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            return true;
        } else {
            return false;
        }
    }

    /*   ---------end-------------shamsu---------------------------   */

    function employee_skills($emp) {
        $this->tables = array('employee_skill');
        $this->fields = array('id', 'employee', 'skill', 'description');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        $result = array();
        if ($data) {
            for ($i = 0; $i < count($data); $i++) {
                $result[$i]['id'] = $data[$i]['id'];
                $result[$i]['employee'] = $data[$i]['employee'];
                $result[$i]['skill'] = $data[$i]['skill'];
                $description = explode("\n", $data[$i]['description']);
                for ($j = 0; $j < count($description); $j++) {
                    $result[$i]['description'][$j]['desc'] = $description[$j];
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function employee_skill_add($skill, $description, $emp) {
        $this->tables = array('employee_skill');
        $this->fields = array('employee', 'skill', 'description');
        $this->field_values = array($emp, $skill, $description);
        $data = $this->query_insert();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    function delete_employee_skill($id) {
        $this->tables = array('employee_skill');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            return true;
        } else {
            return false;
        }
    }

    function employee_documents($emp) {
        $this->tables = array('employee_attachment');
        $this->fields = array('id', 'employee', 'documents', 'date');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    function employee_documents_add($emp, $file_name) {
        $date = date('Y-m-d H:i:s');

        $this->tables = array('employee_attachment');
        $this->fields = array('employee', 'documents');
        $this->field_values = array($emp, $file_name);
        $data = $this->query_insert();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    function get_file_name_employee_attachment($id_attach) {
        $this->tables = array('employee_attachment');
        $this->fields = array('documents');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id_attach);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data[0];
        } else {
            return false;
        }
    }

    function get_all_files_user($emp) {
        $this->tables = array('employee_attachment');
        $this->fields = array('documents', 'employee');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    function delete_employee_attachment($id) {
        $this->tables = array('employee_attachment');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            return true;
        } else {
            return false;
        }
    }

    function employee_update_self() {
        $this->tables = array('employee');
        $this->fields = array('code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'status');
        $this->field_values = array($this->code, $this->social_security, $this->first_name, $this->last_name, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date, $this->status);
        $this->conditions = array('username = ?');
        $this->condition_values = array($this->username);
        if ($this->query_update()) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    function login_update_self() {

        global $preference, $db;
        if ($this->password != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array('' . $db['database_master'] . '.login');
            $this->fields = array('password');
            $this->field_values = array(md5($this->hash . $this->password));
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            if ($this->query_update()) {

                $this->sql_query;
                return true;
            } else {

                return false;
            }
        }
        return true;
    }

    function has_privilege($employee, $type) {
        $user = new user();
        $user_role = $user->user_role($employee);
        if($user_role == 1 || $user_role == 6 || $user_role == 2 || $user_role == 7){
            return true;
        }else{
            $this->tables = array('privileges');
            if ($type == 'swap') {
                $this->fields = array('swap as type');
            } else if ($type = 'process') {
                $this->fields = array('process as type');
            }
            $this->conditions = array('employee = ?');
            $this->condition_values = array($employee);
            $this->query_generate();
            $data = $this->query_fetch();
            if (!empty($data)) {
                if ($data[0]['type'] == '1') {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    function get_signed_date($employee) {
        $this->tables = array('report_signing');
        $this->fields = array('max(date) as date');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($employee);
        $this->query_generate();
        $data = $this->query_fetch();
        if (!empty($data))
            return $data[0]['date'];
        else
            return '0000-00-00';
    }

    function checkATL($employee, $date, $time_from, $time_to, $exceptional_ids='') {
        ///////////////// start of ATL laws///////////////////
        // for FIRST user
        $max_day_hours = 26;
        $tot_work_hours = 0;
        $atl_flag = 0;
        $output = '';
        $msg = new message();
        //checking before dates

        $this->tables = array('timetable');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', 'date= ?', 'time_from >= ?');
        $this->query_generate();
        $after_to_ids = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('date', 'time_from', 'time_to');
        if ($exceptional_ids == '') {
            $this->conditions = array('AND', 'employee = ?', 'date<= ?', array('NOT IN', 'id', $after_to_ids));
            $this->condition_values = array($employee, $date, $employee, $date, (float) $time_to);
        } else {
            $this->conditions = array('AND', 'employee = ?', 'date<= ?', 'id! = ?', array('NOT IN', 'id', $after_to_ids));
            $this->condition_values = array($employee, $date, $exceptional_ids, $employee, $date, (float) $time_to);
        }
        $this->order_by = array('date DESC', 'time_from DESC');
        $this->query_generate();
        $datas = $this->query_fetch();
        $start_time = mktime((int) $time_from, bcmod($time_from * 100, 100), 0, substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4));
        $user_work = (int) ($time_to - $time_from) * 60 * 60 + ($time_to - $time_from - (int) ($time_to - $time_from)) * 100 * 60;

        $prev_week = strtotime('-7 days', $start_time);

        $day_law = 1;
        $week_law = 1;
        if (empty($datas)) {
            $day_law = 0;
            $week_law = 0;
        }
        foreach ($datas as $row_atl) {

            $prev_end_time = mktime((int) $row_atl['time_to'], ($row_atl['time_to'] - (int) $row_atl['time_to']) * 100, 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));
            //echo date('Y-m-d H:i:s',$start_time)."<br>";								
            //echo date('Y-m-d H:i:s',$prev_end_time)."<br>";

            $interval = $start_time - $prev_end_time;
            //echo $interval;
            //echo ($user_work/3600)."<br>";
            if ($day_law == 1) {
                $tot_work_hours += $user_work;
                if ($tot_work_hours > $max_day_hours * 60 * 60) { //if tottal working > allowed working time
                    $atl_flag = 1;
                    $output = "ATL varning " . $employee . "=>" . $row_atl['date'] . " " . str_pad($row_atl['time_from'], 5, '0', STR_PAD_LEFT) . "-" . str_pad($row_atl['time_to'], 5, '0', STR_PAD_LEFT);
                    break;
                }
                if ($interval >= 39600) { //interval >=11 hours
                    $day_law = 0;
                }
                $user_work = (int) ($row_atl['time_to'] - $row_atl['time_from']) * 60 * 60 + ($row_atl['time_to'] - $row_atl['time_from'] - (int) ($row_atl['time_to'] - $row_atl['time_from'])) * 100 * 60;
            }

            if (($start_time >= $prev_week) && ($interval >= 129600)) { //7 days period  getting a rest of 36 hrs
                $week_law = 0;
                $output = "ATL varning " . $employee . "=>" . $row_atl['date'] . " " . str_pad($row_atl['time_from'], 5, '0', STR_PAD_LEFT) . "-" . str_pad($row_atl['time_to'], 5, '0', STR_PAD_LEFT);
                break;
            }
            $start_time = mktime((int) $row_atl['time_from'], ($row_atl['time_from'] - (int) $row_atl['time_from']) * 100, 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));
        }

        // checking after dates			
        if ($atl_flag == 0 && $day_law == 0 && $week_law == 0) {

            $this->tables = array('timetable');
            $this->fields = array('id');
            $this->conditions = array('AND', 'employee = ?', 'date= ?', 'time_from <= ?');
            $this->query_generate();
            $after_to_ids = $this->sql_query;

            $this->tables = array('timetable');
            $this->fields = array('date', 'time_from', 'time_to');
            if ($exceptional_ids == '') {
                $this->conditions = array('AND', 'employee = ?', 'date>= ?', array('NOT IN', 'id', $after_to_ids));
                $this->condition_values = array($employee, $date, $employee, $date, (float) $time_from);
            } else {
                $this->conditions = array('AND', 'employee = ?', 'date>= ?', 'id != ?', array('NOT IN', 'id', $after_to_ids));
                $this->condition_values = array($employee, $date, $exceptional_ids, $employee, $date, (float) $time_from);
            }
            $this->order_by = array('date', 'time_from');
            $this->query_generate();
            $datas = $this->query_fetch();
            $prev_end_time = mktime((int) $time_to, bcmod($time_to * 100, 100), 0, substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4));
            $user_work = 0;
            $start_time = mktime((int) $time_from, bcmod($time_from * 100, 100), 0, substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4));
            $after_week = strtotime('+7 days', $start_time);
            $day_law = 1;
            $week_law = 1;
            if (empty($datas)) {

                $day_law = 0;
                $week_law = 0;
            }
            foreach ($datas as $row_atl) {

                $start_time = mktime((int) $row_atl['time_from'], ($row_atl['time_from'] - (int) $row_atl['time_from']) * 100, 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));

                $interval = $start_time - $prev_end_time;

                //echo ($user_work/3600)."<br>";
                if ($day_law == 1) {
                    $tot_work_hours += $user_work;
                    if ($tot_work_hours > $max_day_hours * 60 * 60) { //if tottal working > allowed working time
                        $atl_flag = 1;
                        $output = "ATL varning " . $employee . "=>" . $row_atl['date'] . " " . str_pad($row_atl['time_from'], 5, '0', STR_PAD_LEFT) . "-" . str_pad($row_atl['time_to'], 5, '0', STR_PAD_LEFT);
                        break;
                    }
                    if ($interval >= 39600) { //interval >=11 hours
                        $day_law = 0;
                    }
                    $user_work = $user_work = (int) ($row_atl['time_to'] - $row_atl['time_from']) * 60 * 60 + ($row_atl['time_to'] - $row_atl['time_from'] - (int) ($row_atl['time_to'] - $row_atl['time_from'])) * 100 * 60;
                }


                //echo "<script>alert(\"".date('Y-m-d H:i:s',$prev_end_time )."---".date('Y-m-d H:i:s',$after_week )."-----".$interval."\")</script>";
                if (($prev_end_time <= $after_week) && ($interval >= 129600)) { //7 days period  getting a rest of 36 hrs
                    $week_law = 0;
                    $output = "ATL varning " . $employee . "=>" . $row_atl['date'] . " " . str_pad($row_atl['time_from'], 5, '0', STR_PAD_LEFT) . "-" . str_pad($row_atl['time_to'], 5, '0', STR_PAD_LEFT);
                    break;
                }
                $prev_end_time = mktime((int) $row_atl['time_to'], ($row_atl['time_to'] - (int) $row_atl['time_to']) * 100, 0, substr($row_atl['date'], 5, 2), substr($row_atl['date'], 8, 2), substr($row_atl['date'], 0, 4));
            }
        }
        if ($atl_flag == 1 || $day_law == 1 || $week_law == 1) {
            $msg->set_message_exact('warning', $output);
            return $output;
        } else {
            //echo "<script>alert(\"ATL law susscess for ".$swp1_user_name."\")</script>";
            return true;
        }



        // End of ATL laws
    }

    /* ----------------------shamsu start-------------------------------- */

    function super_team_members($username, $mode = 0) {         //mode is used for getting employees and customers on a Super Team (for chat)
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?', 'role = 7');
        $this->condition_values = array($username);
        $this->query_generate();
        $cust_query = $this->sql_query;
        $data = $this->query_fetch(2);
        //$TL_customers = '\'' . implode('\', \'', $data) . '\'';
        if (count($data)) {
            $this->tables = array('team');
            $this->fields = array('employee');
            $this->conditions = array('IN', 'customer', $cust_query);
            $this->condition_values = array($username);
            $this->query_generate();
            $datas = $this->query_fetch(2);
            if ($mode == 1) {       // check is data for chat?
                $datas = array_merge($datas, $data);
            }
            return $datas;
        }else if($mode == 0) {
            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?', 'role = 3');
            $this->condition_values = array($username);
            $this->query_generate();
            $datas = $this->query_fetch(2);
            if (count($datas)) {
                $datas = array();
                $datas = array('employee' => $username);
                return $datas;
            }
            else
                return array();
        }
        
        return array();
    }

    function mobile_users($mobile_num, $ids) {
        $this->tables = array('employee');
        $this->fields = array('mobile');
        $this->conditions = array('AND', 'username <> ?', 'mobile = ?');
        $this->condition_values = array($ids, $mobile_num);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    function get_timetable_leave_entries_id($user, $date, $time_from, $time_to) {
        $this->tables = array('timetable');
        $this->fields = array('id');
        $this->conditions = array('AND', 'employee = ?', 'date = ?', '	time_from >= ?', 'time_to <= ?', 'status = 2');
        $this->condition_values = array($user, $date, $time_from, $time_to);
        $this->query_generate();
        $data = $this->query_fetch(2);
        if ($data) {
            return $data;
        } else {
            return array();
        }
    }

    function check_relations_in_timetable_for_leave($id) {
        $this->tables = array('timetable');
        $this->fields = array('id');
        $this->conditions = array('relation_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        if ($data) {
            return $data;
        } else {
            return FALSE;
        }
    }

    function delete_timetable_leave_byRelationID($id) {
        $this->tables = array('timetable');
        $this->conditions = array('relation_id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            return true;
        } else {
            return false;
        }
    }

    function update_timetable_status_when_leave_cancel_byID($ids) {
        $this->tables = array('timetable');
        $this->fields = array('status ');
        $this->field_values = array(1);
        $this->conditions = array('IN', 'id', $ids);
        $data = $this->query_update();
        if ($data)
            return true;
        else
            return FALSE;
    }

    function generate_pdf_work_report($r_year, $r_month, $r_employee) {
        require_once ('plugins/customize_pdf_work_report_details.class.php');

        $pdf = new PDF_Work_report();
        $pdf->report_employee = $r_employee;
        $pdf->report_month = $r_month;
        $pdf->report_year = $r_year;
        //$obj_emp= new employee();
        ///////////////////////////////////////////page 1/////////////////////////////////////////////////  
        $employee_details = $this->get_employee_detail($r_employee);
        $pdf->AddPage('L');        //page1

        $pdf->P1_Part1_Landscap($employee_details);
        $pdf->Process_contents();
        $pdf->P1_Part2_Landscap();
        $pdf->Output();
    }

    /* ----------------------shamsu end-------------------------------- */
}

?>
