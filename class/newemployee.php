<?php
/**
 * Description of new employee
 *
 * @author Unknown
 */
require_once('configs/config.inc.php');
require_once ('class/user.php');
require_once ('class/customer.php');
require_once ('class/newcustomer.php');
require_once ('class/mail.php');
require_once ('class/sms.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/db.php');
require_once ('class/inconvenient_timing.php');
require_once ('plugins/message.class.php');
require_once ('class/dona.php');

class newemployee extends db {

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
	
	//Delete preffered Time 
	//Added By Rahul : 31-10-2012
	function Delete_PrefferedTime($PreferredTimeId)
	{
		$this->tables = array('emp_preferred_time');
		$this->conditions = array('AND', 'timeid = '.$PreferredTimeId.'');
		if ($this->query_delete())
		{
			$this->tables = array('emp_preferred_time_slot');
			$this->conditions = array('AND', 'slotid = '.$PreferredTimeId.'');
			return $this->query_delete();
		}
		else
		{
			return FALSE;		
		}
		
	}
	
	function getSlotDetails($SlotId)
	{
		$this->tables = array('timetable');
		$this->fields = array("*");
		$this->conditions = array('AND','timetable.id = "'.$SlotId.'"');
		$this->order_by = array('timetable.id');
		$this->query_generate();
		$SlotData = $this->query_fetch();
		if(!empty($SlotData))
		{
			return $SlotData;
		}
		else
		{
			return array();	
		}
	}
	
	//Get Employee leave have sttaus 1 in leave table for that day
	function Check_Emp_Leave($EmployeeUnm,$Date)
	{
		$this->tables = array('leave');
		$this->fields = array("leave.employee","leave.date,leave.time_from","leave.time_to","leave.type");
		$this->conditions = array('AND','leave.type = 1','leave.employee = "'.$EmployeeUnm.'"','leave.date = "'.$Date.'"');
		$this->order_by = array('leave.time_from DESC');
		$this->query_generate();
		$Leaves = $this->query_fetch();
		
		if(!empty($Leaves))
		{
			return $Leaves;
		}
		else
		{
			return array();			
		}		
	}
		
	// Update time table data
	function UpdateTimetableData($TimetableId, $Employee, $Type)
	{
		
		$username = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->tables = array('timetable');
        $this->fields = array('employee','`type`','status','alloc_emp');
        $this->field_values = array($Employee,$Type,1,$username);
        $this->conditions = array('id = ?');
        $this->condition_values = array($TimetableId);
		
        $data = $this->query_update();
        if ($data)
            return true;
        else
            return FALSE;
			
	}
	
	
	
	//Select data from timetable
	function SelectTimetableData()
	{
		$this->tables = array('temp_timetable');
		$this->fields = array("id,employee,type");
		$this->order_by = array('temp_timetable.id');
		$this->query_generate();
		$Schedules = $this->query_fetch();
		if(!empty($Schedules))
		{
			return $Schedules;
		}
		else
		{
			return array();	
		}
	}
	
	//insert data in temp timetable 
	function InsertTempTimetable($Timetable_Id,$Timetable_Employee,$Timetable_Fname,$Timetable_Lname,$Timetable_Type)
	{
		$this->tables = array('temp_timetable');
		$this->fields = array('id','employee','empfname','emplname','`type`');
		$this->field_values = array($Timetable_Id, $Timetable_Employee, $Timetable_Fname,$Timetable_Lname,$Timetable_Type); 
		$data = $this->query_insert($query); 

        if ($data)
            return true;
        else    
			return FALSE;
	}
	
	//Truncate Temp Timetable 
	function TruncateTempTimetable()
	{
		$this->tables = array ("TRUNCATE temp_timetable");
		$this->query_generate_leftjoin();
		$truncate_data = $this->query_fetch();
		if(empty($truncate_data))
		{
			return true;	
		}
		else
		{
			return false;
		}
	}	
	
	//Get Employee Previous schedule from time table if there is not get yesterday schedule from timetable 
	function Get_Previous_Schedule_of_Employee($EmpUserName,$date,$TimeFrom,$EmpTurnCounter,$customer,$SlotDetail)
	{ 
		
		$YesterDay = date('Y-m-d', strtotime('-1 day', strtotime($date)));
		$SchedulerArray = array();	
		
		//Check there are two time slot with same customer and have same timefrom and time to and employee set for the first schedule then second time skeep that employee because he is already set for the same time in auto scheduling 
		if($EmpTurnCounter > 0 )
		{			
			$this->tables = array('timetable');
			$this->fields = array("*");
			$this->conditions = array('AND','timetable.date = "'.$date.'"','timetable.type != 6','timetable.time_from = "'.$TimeFrom.'"','customer = "'.$customer.'"');
			$this->order_by = array('timetable.time_from DESC');
			$this->query_generate();
			$Schedules = $this->query_fetch();
			if(count($Schedules) > 1)
			{
				$SchedulerArray['skip'] = 1;
			}
			else
			{
				$SchedulerArray['skip'] = 0;
			}
		}
		else
		{
			$SchedulerArray['skip'] = 0;
		}
		
		
		
		//Check For employee today's schedule 
		$this->tables = array('timetable');
		$this->fields = array("employee,SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY))) AS totalMinutes","time_to");
		$this->conditions = array('AND','employee = "'.$EmpUserName.'"','timetable.date = "'.$date.'"','timetable.type != 6','timetable.time_from <= "'.$TimeFrom.'"','timetable.id != "'.$SlotDetail.'"');
		$this->order_by = array('timetable.time_from DESC');
		$this->query_generate();
		$Schedules = $this->query_fetch();
		if($Schedules[0]['totalMinutes'] == '')
		{		
			//Check for yesterday Schedule 
			$Schedules = 	array(0 => array('employee'=> '', 'totalMinutes'=> '', 'time_from'=> ''));
			$this->tables = array('timetable');
			$this->fields = array("employee,SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY))) AS totalMinutes","MAX(time_to) AS time_to","MAX(time_from) AS time_from");
			$this->conditions = array('AND','employee = "'.$EmpUserName.'"','timetable.date = "'.$YesterDay.'"','timetable.type != 6');
			$this->order_by = array('timetable.time_from DESC');
			$this->query_generate();
			$YesterDaySchedules = $this->query_fetch();	
		}
		else
		{
			$YesterDaySchedules = array(0 => array('employee'=> '', 'totalMinutes'=> '', 'time_from'=> '', 'time_to'=> ''));
		}
		
		//return $ScheduleArray[] = $YesterDaySchedules[0];
		$SchedulerArray['today']['employee'] = $Schedules[0]['employee'];
		$SchedulerArray['today']['totalMinutes'] = $Schedules[0]['totalMinutes'];
		$SchedulerArray['today']['time_to'] = $Schedules[0]['time_to'];			
		$SchedulerArray['yesterday']['employee'] = $YesterDaySchedules[0]['employee'];			
		$SchedulerArray['yesterday']['totalMinutes'] = $YesterDaySchedules[0]['totalMinutes'];
		$SchedulerArray['yesterday']['time_from'] = $YesterDaySchedules[0]['time_from'];
		$SchedulerArray['yesterday']['time_to'] = $YesterDaySchedules[0]['time_to'];	
		
		if(!isset($SchedulerArray['skip']))	
		{
			$SchedulerArray['skip'] = 0;
		}
		return $SchedulerArray;	
				
	}
	
	
	//Get Employee tomorrow schedule from time table if there is not get tomorrow schedule from timetable 
	function Get_tomorrow_Schedule_of_Employee($EmpUserName,$date,$TimeFrom,$EmpTurnCounter,$customer,$SlotDetail)
	{ 
		
		$tomorrow = date('Y-m-d', strtotime('+1 day', strtotime($date)));
		$SchedulerArray = array();	
		
		//Check there are two time slot with same customer and have same timefrom and time to and employee set for the first schedule then second time skeep that employee because he is already set for the same time in auto scheduling 
		if($EmpTurnCounter > 0 )
		{			
			$this->tables = array('timetable');
			$this->fields = array("*");
			$this->conditions = array('AND','timetable.date = "'.$date.'"','timetable.type != 6','timetable.time_from = "'.$TimeFrom.'"','customer = "'.$customer.'"','timetable.status = 1');
			$this->order_by = array('timetable.time_from DESC');
			$this->query_generate();
			$Schedules = $this->query_fetch();
			if(count($Schedules) > 1)
			{
				$SchedulerArray['skip'] = 1;
			}
			else
			{
				$SchedulerArray['skip'] = 0;
			}
		}
		else
		{
			$SchedulerArray['skip'] = 0;
		}
		
		
		
		//Check For employee today's schedule 
		$this->tables = array('timetable');
		$this->fields = array("employee,SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY))) AS totalMinutes","time_to");
		$this->conditions = array('AND','employee = "'.$EmpUserName.'"','timetable.date = "'.$date.'"','timetable.status = 1','timetable.type != 6','timetable.time_from <= "'.$TimeFrom.'"','timetable.id != "'.$SlotDetail.'"');
		$this->order_by = array('timetable.time_from DESC');
		$this->query_generate();
		$Schedules = $this->query_fetch();
		if($Schedules[0]['totalMinutes'] == '')
		{		
			//Check for yesterday Schedule 
			$Schedules = 	array(0 => array('employee'=> '', 'totalMinutes'=> '', 'time_from'=> ''));
			$this->tables = array('timetable');
			$this->fields = array("employee,SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY))) AS totalMinutes","MAX(time_to) AS time_to","MAX(time_from) AS time_from");
			$this->conditions = array('AND','employee = "'.$EmpUserName.'"','timetable.date = "'.$tomorrow.'"','timetable.type != 6','timetable.status != 1',);
			$this->order_by = array('timetable.time_from DESC');
			$this->query_generate();
			$TomorrowSchedules = $this->query_fetch();	
		}
		else
		{
			$TomorrowSchedules = array(0 => array('employee'=> '', 'totalMinutes'=> '', 'time_from'=> '', 'time_to'=> ''));
		}
		
		//return $ScheduleArray[] = $YesterDaySchedules[0];
		$SchedulerArray['today']['employee'] = $Schedules[0]['employee'];
		$SchedulerArray['today']['totalMinutes'] = $Schedules[0]['totalMinutes'];
		$SchedulerArray['today']['time_to'] = $Schedules[0]['time_to'];			
		$SchedulerArray['tomorrow']['employee'] = $TomorrowSchedules[0]['employee'];			
		$SchedulerArray['tomorrow']['totalMinutes'] = $TomorrowSchedules[0]['totalMinutes'];
		$SchedulerArray['tomorrow']['time_from'] = $TomorrowSchedules[0]['time_from'];
		$SchedulerArray['tomorrow']['time_to'] = $TomorrowSchedules[0]['time_to'];	
		
		if(!isset($SchedulerArray['skip']))	
		{
			$SchedulerArray['skip'] = 0;
		}
		return $SchedulerArray;	
				
	}
	
	/************Not Usable **********///
	//Get Employee scheudles Minutes from timetable for other customers
	// Added By : Rahul (20-10-2012)
	function Check_Scheduled_Hours($CustUserName,$EmpUserName,$date,$TimeFrom,$timediff,$MaxWorkingHours)
	{
		$Varification = array();
		//Global Setting time between schedule (convert into minuts)
		$totminutes =  number_format($timediff,2,'.','');
		$Hours = floor($totminutes/60);
		$Minutes = $totminutes%60;
		$HoursMinutes = $Hours.'.'.$Minutes;

		$YesterDayCheck = 0;
		$NextDayCheck = 0;
		$TodayCheck = 0;
		
		$YesterDay = date('Y-m-d', strtotime('-1 day', strtotime($date)));
		$this->tables = array('timetable');
		$this->fields = array("employee,SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY))) AS totalMinutes");
		$this->conditions = array('AND','employee = "'.$EmpUserName.'"','timetable.date = "'.$YesterDay.'"','customer != "'.$CustUserName.'" ','timetable.type != 6');
		$this->query_generate();
		$YesterdaySchedules = $this->query_fetch();
		$Varification['yesterday'][] = $YesterdaySchedules[0];
		
		if($YesterdaySchedules[0]['totalMinutes'] > 0 )
		{
			$this->tables = array('timetable');
			$this->fields = array("time_to");
			$this->conditions = array('AND','employee = "'.$EmpUserName.'"','timetable.date = "'.$YesterDay.'"','customer != "'.$CustUserName.'" ','timetable.type != 6');
			$this->order_by = array('time_from LIMIT 0,1');
			$this->query_generate();
			$Yesterday_Last_Schedule = $this->query_fetch();
			$Yestesrday_Last_Timeto = $Yesterday_Last_Schedule[0]['time_to'];
			if($Yestesrday_Last_Timeto == 24.00)
			{
				$Yestesrday_Last_Timeto = number_format(0.00,2,'.','');
			}
			$NewTimeFrom = $TimeFrom+(float)$HoursMinutes;
			$NewTimeFrom = number_format($NewTimeFrom,2,'.','');
			//echo $Yestesrday_Last_Timeto.'  '.$TimeFrom.' '.$NewTimeFrom;
			
			if($Yestesrday_Last_Timeto >= $NewTimeFrom && $YesterdaySchedules[0]['totalMinutes'] <= 900)
			{
				$YesterDayCheck = 1;
			}
		}
		else
		{
			$YesterDayCheck = 1;
		}
		$Varification['yesterday'][] = $YesterDayCheck;
		
		$NextDay = date('Y-m-d', strtotime('+1 day', strtotime($date)));
		$this->tables = array('timetable');
		$this->fields = array("employee,SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY))) AS totalMinutes");
		$this->conditions = array('AND','employee = "'.$EmpUserName.'"','timetable.date = "'.$NextDay.'"','customer != "'.$CustUserName.'" ','timetable.type != 6');
		$this->query_generate();
		$NextDaySchedules = $this->query_fetch();
		$Varification['nextday'][] = $NextDaySchedules[0];
		
		if($NextDaySchedules[0]['totalMinutes'] > 0)
		{
			$this->tables = array('timetable');
			$this->fields = array("time_from");
			$this->conditions = array('AND','employee = "'.$EmpUserName.'"','timetable.date = "'.$NextDay.'"','customer != "'.$CustUserName.'" ','timetable.type != 6');
			$this->order_by = array('time_from LIMIT 0,1');
			$this->query_generate();
			$NextDay_Last_Schedule = $this->query_fetch();
			$NextDay_Last_Timeto = $NextDay_Last_Schedule[0]['time_from'];
			if($NextDay_Last_Timeto == 24.00)
			{
				$NextDay_Last_Timeto = number_format(0.00,2,'.','');
			}
			$NewTimeFrom = $TimeFrom+(float)$HoursMinutes;
			$NewTimeFrom = number_format($NewTimeFrom,2,'.','');
			//echo $Yestesrday_Last_Timeto.'  '.$TimeFrom.' '.$NewTimeFrom;
			
			if($NextDay_Last_Timeto >= $NewTimeFrom && $NextDaySchedules[0]['totalMinutes'] <= 900)
			{
				$NextDayCheck = 1;
			}
		}
		else
		{
			$NextDayCheck = 1;	
		}
		$Varification['nextday'][] = $NextDayCheck;
		
		$this->tables = array('timetable');
		$this->fields = array("employee,SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY))) AS totalMinutes");
		$this->conditions = array('AND','employee = "'.$EmpUserName.'"','timetable.date = "'.$date.'"','customer != "'.$CustUserName.'" ','timetable.type != 6');
		$this->query_generate();
		$Schedules = $this->query_fetch();
		$Varification['today'][] = $Schedules[0];
		if($Schedules[0]['totalMinutes'] > 0)
		{
			if($Schedules[0]['totalMinutes'] <= 900)
			{
				$TodayCheck = 1;	
			}
		}
		else
		{
			$TodayCheck = 1;
		}
		$Varification['today'][] = $TodayCheck;
		
		
		//$Varification = array($YesterDayCheck,$NextDayCheck,$TodayCheck);
		
		/*echo "<pre>";
		echo $date.'    Yesterday : '.$YesterdaySchedules[0]['totalMinutes'].'     NextDay : '.$NextDaySchedules[0]['totalMinutes'].'     Today : '.$Schedules[0]['totalMinutes'];
		echo "<br>";*/
		
		/*print_r($YesterdaySchedules[0]['totalMinutes']);
		print_r($NextDaySchedules[0]['totalMinutes']);
		print_r($Schedules[0]['totalMinutes']);
		echo "<br>";*/
		
		return $Varification;
				
	}
	
	//Get Employee Max Hours if user set it in edit time 
	function Get_Employee_Max_Hours($EmpUserName)
	{
		$this->tables = array('employee');
		$this->fields = array("max_hours");
		$this->conditions = array('AND','username = "'.$EmpUserName.'"');
		$this->query_generate();
		$MaxHours = $this->query_fetch();	
		
		if(!empty($MaxHours))
		{
			return $MaxHours[0]['max_hours'];
		}
		else
		{
			return 0;	
		}
	}
	
	
	//Get Employee Preferred Time Slot for specific day
	//Added By : Rahul 20-10-20012
	function Check_Emp_PreferredTime($EmpUserName,$date)
	{
		$this->tables = array('emp_preferred_time');
		$this->fields = array("timeid");
		$this->conditions = array('AND','employee = "'.$EmpUserName.'"',' "'.$date.'" BETWEEN fromdate AND todate');
		$this->query_generate();
		$PreferredTime = $this->query_fetch();
		if(!empty($PreferredTime))
		{
			$TimeId = $PreferredTime[0]['timeid'];
			$dow = date('w', strtotime($date)); //Day of week
			//if it's sunday it will return 0 but in database sunday is 7
			if($dow == 0)
			{
				$dow = 7;
			}
			$this->tables = array('emp_preferred_time_slot');
			$this->fields = array("*");
			$this->conditions = array('AND','slotid = "'.$TimeId.'"','day = '.$dow.'');
			$this->order_by = array('day');
			$this->query_generate();
			$TimeSlots = $this->query_fetch();
			return $TimeSlots;
			
		}
		else
		{
			return array();	
		}
	}	
	
	//Check Unavailable employee for customer for this time and date with other customers
	//Added By : Rahul 20-10-2012
	function Check_Employee_UnAvailability_For_DateAndTime($EmployeeList,$days,$TimeFrom,$TimeTo,$Customer)
	{
		$Employees =  '\'' . implode('\', \'', $EmployeeList) . '\'';
		$this->tables = array('timetable');
		$this->fields = array("timetable.employee");
		$this->conditions = array('AND','timetable.date = "'.$days.'"','timetable.time_from >= '.$TimeFrom.'','timetable.time_to <= '.$TimeTo.'',"timetable.employee IN ( ".$Employees." )","timetable.customer != '".$Customer."'","timetable.status = 1");
		$this->query_generate();
		$UnAvailableEmployees = $this->query_fetch(2);
		if(!empty($UnAvailableEmployees))
		{
			return $UnAvailableEmployees;	
		}
		else
		{
			return array();
		}
		
	}
	
	//This function if for validation for inserting slot in emp_preferred_time
	//Addded bY rahul : 10-10-2012
	function validate_preferred_time_onupdate($EmployeeId, $FromDate, $ToDate, $SlotId)
	{
		$this->tables = array('emp_preferred_time');	
		$this->fields = array('timeid');
		$this->conditions = array('AND','employee = "'.$EmployeeId.'"','fromdate <= "'.$ToDate.'" AND todate >= "'.$FromDate.'"');	
		$this->query_generate();
		$employee_data = $this->query_fetch();
		$count_Record = count($employee_data);
		
		if(($count_Record == 1 && $employee_data[0]['timeid'] == $SlotId) || $count_Record == 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
	
	//Update emp_preferred_time data of employee
	//Added By Rahul : 6-10-2012
	function Update_emp_preferred_time($SlotId,$EmployeeId, $FromDate, $ToDate)
	{
		$this->tables = array('emp_preferred_time');
		$this->fields = array('`fromdate`', '`todate`');
		$this->field_values = array($FromDate, $ToDate);
		$this->conditions = array('AND','employee = "'.$EmployeeId.'"','timeid = "'.$SlotId.'"');
		$this->sql_query;
		$data = $this->query_update();
        if ($data)
            return true;
        else
            return FALSE;
	}
	
	//Update emp_preferred_time data of employee
	//Added By Rahul : 6-10-2012
	function Update_emp_preferred_time_slot($SlotId,$EmployeeId, $Day, $PreferredTime,$OverrTime)
	{
		$this->tables = array('emp_preferred_time_slot');
		$this->fields = array('`day`', '`preferredtime`', '`overtime`');
		$this->field_values = array($Day, $PreferredTime, $OverrTime);
		$this->conditions = array('AND',"slotid = ".$SlotId."","`day` = ".$Day."");
		$this->sql_query;
		$data = $this->query_update();
        if ($data)
            return true;
        else
            return FALSE;
	}
	
	//Get Employee preferred time slot from emp_preferred_time_slot
	//Addded bY rahul : 5-10-2012
	function get_employee_preferredtime_slot($SlotId)
	{
		$this->tables = array('emp_preferred_time_slot');	
		$this->fields = array('*');
		$this->conditions = array('AND','slotid = '.$SlotId.'');	
		$this->query_generate();
		$employee_data = $this->query_fetch();
		$count_Record = count($employee_data);
        if (!empty($employee_data))
            return $employee_data;
        else    
			return array();
	}	
	
	//Get Employee preferred time from emp_preferred_time
	//Addded bY rahul : 5-10-2012
	function get_employee_preferredtime($EmployeeId)
	{
		$this->tables = array('emp_preferred_time');	
		$this->fields = array('*');
		$this->conditions = array('AND','employee = "'.$EmployeeId.'"');	
		$this->order_by = array('timeid DESC');			
		$this->query_generate();
		$employee_data = $this->query_fetch();		
		$count_Record = count($employee_data);
        if (!empty($employee_data))
            return $employee_data;
        else    
			return array();
	}	
	
	//Function to add employee preferred time in slot
	//Added By Rahul : 6-10-2012
	function insert_in_emp_preferred_time_slot($SlotId,$EmployeeId, $Day, $PreferredTime,$OverrTime)
	{
		$this->tables = array('emp_preferred_time_slot');
		$this->fields = array('`slotid`', '`day`', '`preferredtime`','`overtime`');
		$this->field_values = array($SlotId, $Day, $PreferredTime,$OverrTime);
		$data = $this->query_insert();
        if ($data)
            return true;
        else    
			return FALSE;
	}
	
	//Function to add record of employee in emp_preferred_time table
	//Added By Rahul : 5-10-2012
	function insert_slot_in_emp_preferred_time($EmployeeId, $FromDate, $ToDate, $SlotId)
	{
		$this->tables = array('emp_preferred_time');
		$this->fields = array('employee', 'fromdate', 'todate');
		$this->field_values = array($EmployeeId, $FromDate, $ToDate);
		$data = $this->query_insert();
		
		$this->tables = array('emp_preferred_time');
		$this->fields = array('MAX(timeid) AS maxslot');
		$this->order_by = array('timeid DESC LIMIT 0,1');
		$this->query_generate();
		$employee_data = $this->query_fetch();
		$MaxSlotId	= $employee_data[0]['maxslot'];

        if ($MaxSlotId > 0)
            return $MaxSlotId;
        else    
			return FALSE;
	}
	
	//This function if for validation for inserting slot in emp_preferred_time
	//Addded bY rahul : 5-10-2012
	function validate_preferred_time($EmployeeId, $FromDate, $ToDate)
	{
		$this->tables = array('emp_preferred_time');	
		$this->fields = array('employee');
		$this->conditions = array('AND','employee = "'.$EmployeeId.'"','fromdate <= "'.$ToDate.'" AND todate >= "'.$FromDate.'"');	
		$this->query_generate();
		$employee_data = $this->query_fetch();
		
		$count_Record = count($employee_data);
        if ($count_Record > 0)
            return true;
        else    
			return FALSE;
	}	
	
	//This function is for employee time preferrence 
	//Added bY rahul : 5-10-2012 - get count in emp_preferred_time table 
	function count_emp_preferred_time($employee)
	{
		$this->tables = array('emp_preferred_time');	
		$this->fields = array('employee');
		$this->conditions = array('AND','employee = "'.$employee.'"');	
		$this->query_generate();
		$employee_data = $this->query_fetch();
		$count_Record = count($employee_data);
		if($count_Record > 0)
		{
			return $count_Record;
		}
		else
		{
			return 0;
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
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				
				}				
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer');
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'"');
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'"');
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
				}

				$this->group_by = array('timetable.employee','timetable.customer');
				$this->order_by = array('employee.last_name','employee.first_name','customer.first_name','customer.last_name');
				$this->query_generate();
				$employee_data = $this->query_fetch();
				// var_dump($this->sql_query);
				// exit;
				if (!empty($employee_data) && !empty($employee_data[0]['username'])) 
				{	
					return $employee_data;
				}
				else
				{
					return array();
				}
				break;
				
				/*if (!empty($employee_data)  ) 
				{				
					return $employee_data;
				}
				else 
				{
					return array();
				}	
				break;*/
				
				
		case 2:
		case 7:
				$team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
	
				$this->tables = array('employee','customer','timetable');
								$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");						
				}		
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date >= "'.$fromdate.'" ');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date <= "'.$todate.'" ');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
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
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}			
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date >= "'.$fromdate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date <= "'.$todate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
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
				//$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
				$team_employee_data = '\'' . $login_user . '\'';
				$this->tables = array('employee','customer','timetable');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','timetable.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(timetable.time_to - timetable.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),timetable.date + INTERVAL 1 DAY)))%60)) AS hrsmins");
				
				if($name != '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'));
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}			
				if($name != '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date >= "'.$fromdate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date <= "'.$todate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				if($name != '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND',array('IN', 'employee.username', $team_employee_data),'timetable.status = 1','employee.status = 1','customer.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('OR','LCASE(employee.last_name) LIKE ?','LCASE(employee.first_name) LIKE ?','CONCAT_WS(" ",LCASE(employee.first_name),LCASE(employee.last_name)) LIKE ?'),'timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');
					$this->condition_values = array(strtolower($name)."%",strtolower($name)."%",strtolower($name)."%");	
				}
				
				if($name == '-' && $fromdate == '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate == '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date >= "'.$fromdate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate == '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date <= "'.$todate.'" ',array('IN', 'employee.username', $team_employee_data));
				}
				if($name == '-' && $fromdate != '0000-00-00' && $todate != '0000-00-00')
				{
					$this->conditions = array('AND','employee.status = 1','customer.status = 1','timetable.status = 1','employee.username = timetable.employee','customer.username = timetable.customer','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"',array('IN', 'employee.username', $team_employee_data));
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
			$this->conditions = array('AND','timetable.status = 1','timetable.employee = "'.$empunm.'"','timetable.date >= "'.$fromdate.'" ');				
		}	
		if($fromdate == '0000-00-00' && $todate != '0000-00-00')
		{			
			$this->conditions = array('AND','timetable.status = 1','timetable.employee = "'.$empunm.'"','timetable.date <= "'.$todate.'" ');				
		}			
		if($fromdate != '0000-00-00' && $todate != '0000-00-00')
		{			
				$this->conditions = array('AND','timetable.status = 1','timetable.employee = "'.$empunm.'"','timetable.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"');	
							
		}
		if($fromdate == '0000-00-00' && $todate == '0000-00-00')
		{	
			$this->conditions = array('AND','timetable.status = 1','timetable.employee = "'.$empunm.'"');	
		}
		
		$employee_data = $this->query_fetch();
		/*print_r($employee_data);
		exit;*/
							
		
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
			$this->conditions = array('AND','timetable.status = 1','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date >= "'.$fromdate.'" ',array('OR','leave.type = 2','leave.type = 3','leave.type = 4','leave.type = 7'));				
		}	
		if($fromdate == '0000-00-00' && $todate != '0000-00-00')
		{			
			$this->conditions = array('AND','timetable.status = 1','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date <= "'.$todate.'" ',array('OR','leave.type = 2','leave.type = 3','leave.type = 4','leave.type = 7'));				
		}			
		if($fromdate != '0000-00-00' && $todate != '0000-00-00')
		{			
				$this->conditions = array('AND','timetable.status = 1','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"','leave.date = timetable.date',array('OR','leave.type = 2','leave.type = 3','leave.type = 4','leave.type = 7'));	
							
		}
		if($fromdate == '0000-00-00' && $todate == '0000-00-00')
		{	
			$this->conditions = array('AND','timetable.status = 1','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"', 'timetable.date = leave.date',array('OR','leave.type = 2','leave.type = 3','leave.type = 4','leave.type = 7'));	
		}
	
		$employee_data = $this->query_fetch();		
		
		/*echo "<pre>";
		print_r($employee_data);	*/
		$totemp = count($employee_data);
		$leavearr = array();
		//$leavearr['nivv001']['ipix001'][3] = 10;
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

					/*$leavearr[$empuname]['custuname'] = $custuname;
					$leavearr[$empuname]['leavetype'] = $leavetype;
					$leavearr[$empuname]['total_leave'] = $total_leave;*/
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
			$this->conditions = array('AND','timetable.status = 1','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date >= "'.$fromdate.'" ');				
		}	
		if($fromdate == '0000-00-00' && $todate != '0000-00-00')
		{			
			$this->conditions = array('AND','timetable.status = 1','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date <= "'.$todate.'" ');				
		}			
		if($fromdate != '0000-00-00' && $todate != '0000-00-00')
		{			
				$this->conditions = array('AND','timetable.status = 1','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"','leave.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"','leave.date = timetable.date');	
							
		}
		if($fromdate == '0000-00-00' && $todate == '0000-00-00')
		{	
			$this->conditions = array('AND','timetable.status = 1','leave.employee = "'.$empunm.'"','timetable.employee = "'.$empunm.'"', 'timetable.date = leave.date');	
		}
	
		$employee_data = $this->query_fetch();
		
		/*echo "<pre>";
		print_r($employee_data);	*/
		$totemp = count($employee_data);
		$leavearr = array();
		//$leavearr['nivv001']['ipix001'][3] = 10;
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
	
					/*$leavearr[$empuname]['custuname'] = $custuname;
					$leavearr[$empuname]['leavetype'] = $leavetype;
					$leavearr[$empuname]['total_leave'] = $total_leave;*/
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
					echo $team_employee_data =  '\'' . $_SESSION['user_id'] . '\'';
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
                    $team_members = $this->team_members($login_user);

                    $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                    $this->tables = array('employee');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile');
                    $this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1');
                    $this->order_by = array('LOWER(first_name)', 'LOWER(last_name)');
                    $this->query_generate();
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
                    $this->conditions = array('AND', array('IN', 'username', $customer_query), 'status = 1');
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

        foreach ($slots as $slot) {

            $datas[] = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'fkkn' => $slot['fkkn'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_hour' => $this->time_difference($slot['time_from'], $slot['time_to']), 'status' => $slot['status'], 'type' => $slot['type'], 'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 'alloc_emp' => $slot['alloc_emp'], 'emp_color' => $slot['emp_color'], 'signed' => $signin_flag);
        }
        return $datas;
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

    function team_members($username) {

        $this->tables = array('team');
        $this->fields = array('DISTINCT customer AS customer');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $cust_query = $this->sql_query;
        $data = $this->query_fetch();
        if (count($data)) {

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
        $this->fields = array('username', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'color', 'status');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        $color = $datas[0]['color'];
        $rgb = $this->hex_to_rgb($color);
        $datas[0]['color'] = $rgb;
        return $datas[0];
    }

    function get_available_works() {
        return array();
        /*$this->tables = array('work');
        $this->fields = array('id', 'name');
        if ($this->works != NULL) {
            $this->conditions = array('AND', array('NOT IN', 'id', $this->works));
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;*/
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
    function get_memory_slots($employee, $date, $customer='') {

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


        $this->tables = array('memory_slots');
        $this->fields = array('distinct time_from', 'time_to', 'id');
        if ($customer != '') {
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer);
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
        if ($time_data['total_time'] != '' && $time_data['total_time'] > 0) 
		{
            $oncall_time = round(($time_data['total_time'] / 4), 2);
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
        $this->tables = array('leave');
        $this->fields = array('distinct employee');
        $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'status=?');

        //$this->condition_values = array((float)$time_from, (float)$time_to, (float)$time_from,(float)$time_to,(float)$time_from,(float)$time_to,$date);
        $this->query_generate();
        $not_emp_query_leave = $this->sql_query;

        $this->tables = array('team');
        $this->fields = array('employee');
        $this->conditions = array('customer=?');
        //$this->condition_values = array((float)$time_from, (float)$time_to, (float)$time_from,(float)$time_to,(float)$time_from,(float)$time_to,$date);
        $this->query_generate();
        $emp_query = $this->sql_query;
        if ($_SESSION['user_role'] == 3) {
            $emp_query = "'" . $_SESSION['user_id'] . "'";
        }
        //$datas = $this->query_fetch();    
        $this->tables = array('employee');
        $this->fields = array('username', 'first_name', 'last_name', 'code', 'mobile');
        $this->conditions = array('AND', 'status=?', array('NOT IN', 'username', $not_emp_query), array('NOT IN', 'username', $not_emp_query_leave), array('IN', 'username', $emp_query));
        if ($_SESSION['user_role'] == 3) {
            $this->condition_values = array('1', (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, '', '2', (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, 1);
        } else {

            $this->condition_values = array('1', (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, '', '2', (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, 1, $customer);
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
            return false;
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
        $this->fields = array('id', 'customer', 'employee', 'fkkn', 'status', 'alloc_emp', 'time_from', 'time_to', 'type', 'date', 'relation_id');
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

            $employee_pending[] = array('username' => $employee['username'], 'name' => $employee['first_name'] . ' ' . $employee['last_name'], 'allocate' => $contract_hour_week, 'allocated' => $timetable_hour_week);
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

        $this->tables = array('leave', 'employee');
        $this->fields = array('leave.id AS id', 'leave.employee AS employee', 'employee.first_name AS first_name', 'employee.last_name AS last_name', 'MIN(leave.date) AS date_from', 'MAX(leave.date) AS date_to', 'leave.type AS type', 'leave.comment AS comment');
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
            $leave_datas[] = array('id' => $data['id'], 'employee' => $data['employee'], 'name' => $data['first_name'] . " " . $data['last_name'], 'type' => $leave_type[$data['type']], 'date' => $date, 'comment' => $data['comment']);
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
        return $big_red;
    }

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

    function get_date_limits($month, $year) {
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lower_limit = $year . "-" . $month . "-01";
        $upper_limit = $year . "-" . $month . "-" . $num;
        return $lower_limit . "/" . $upper_limit;
    }

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

    function time_difference($t1, $t2, $mod=60) {
//        if(floatval($t1) < floatval($t2)){
//            echo "<script>alert('".$t1." ". $t2."')</script>";
//        }
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        //$time1 = ((intval($a1[0]) * 60 * 60) + (str_pad(intval($a1[1]), 2, '0', STR_PAD_RIGHT) * 60));
        //$time2 = ((intval($a2[0]) * 60 * 60) + (str_pad(intval($a2[1]), 2, '0', STR_PAD_RIGHT) * 60));
        $time1 = ((intval($a1[0]) * 60 * 60) + intval((str_pad($a1[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $time2 = ((intval($a2[0]) * 60 * 60) + intval((str_pad($a2[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $diff = abs($time1 - $time2);
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        if($mod == 100)
            $mins = round($mins*100/60);
        //$result = $hours . "." . sprintf('%02d', $mins);
        $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
        return $result;
    }

    function time_sum($t1, $t2) {
        
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        $time1 = (($a1[0] * 60 * 60) + (str_pad($a1[1], 2, '0', STR_PAD_RIGHT) * 60));
        $time2 = (($a2[0] * 60 * 60) + (str_pad($a2[1], 2, '0', STR_PAD_RIGHT) * 60));
        $sum = abs($time1 + $time2);
        $hours = floor($sum / (60 * 60));
        $mins = floor(($sum - ($hours * 60 * 60)) / (60));
        $result = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
        return $result;
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

    /*     * ***************************end *******************employee work report details*************************** */

    function distinct_employee() {      //not used
        $this->tables = array('employee');
        $this->fields = array('distinct(username) as uname', 'concat(first_name," ", last_name) as fullname');
        $this->order_by = array('uname');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function distinct_years($all_year = null) {
    	if($all_year != null){
            $this->tables = array('timetable');
            $this->fields = array('distinct(year(date)) as years');
            $this->order_by = array('years desc');
            $this->query_generate();
            $real_table_data = $this->sql_query;

            $this->tables = array('backup_timetable');
            $this->fields = array('distinct(year(date)) as years');
            $this->order_by = array('years desc');
            $this->query_generate();
            $backup_table_data = $this->sql_query;

            $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ORDER BY years DESC ';

            $datas = $this->query_fetch(2);
            return $datas;
        }
        else{
        	$this->tables = array('timetable');
	        $this->fields = array('distinct(year(date)) as years');
	        $this->order_by = array('years desc');
	        $this->query_generate();
	        $datas = $this->query_fetch(2);
	        return $datas;
        }
        
    }

    function employee_pdf_report($dataset, $emp_name, $month, $year, $r_heading, $r_sub_head, $col_heading, $total_cap) {
        $pdf = new PDF();
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

        $this->tables = array('report_signing');
        $this->fields = array('signin_employee', 'signin_date');
        switch ($login_user_role) {

            case 1:
                $this->conditions = array('AND', 'employee = ?', 'date = ?', array('AND', 'signin_employee != ""', 'signin_tl != ""', 'signin_sutl != ""'));
                $this->condition_values = array($this->username, $this->signing_report_date);
                break;
            case 2:
                $this->conditions = array('AND', 'employee = ?', 'date = ?', 'signin_tl = ?');
                $this->condition_values = array($this->username, $this->signing_report_date, $login_user);
                break;
            case 3:
                $this->conditions = array('AND', 'employee = ?', 'date = ?', 'signin_employee = ?');
                $this->condition_values = array($this->username, $this->signing_report_date, $login_user);
                break;
            case 7:
                $this->conditions = array('AND', 'employee = ?', 'date = ?', 'signin_sutl = ?');
                $this->condition_values = array($this->username, $this->signing_report_date, $login_user);
                break;
        }

//        $this->conditions = array('AND', 'employee = ?', 'date = ?');
//        $this->condition_values = array($this->username, $this->signing_report_date);
        $this->query_generate();
//        echo $this->sql_query;
        $data = $this->query_fetch();
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

    function delete_weeks($del_start, $del_end, $employees, $days, $in_focus=0, $user='') {
        $msg = new message();
        $obj_user = new user();
        $user_role = $obj_user->user_role($user);
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
            $this->conditions = array('AND', 'customer = ?', array('IN', 'employee', $emp), array('BETWEEN', 'date', '\'' . $del_start . '\'', '\'' . $del_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
            $this->condition_values = array($user);
        } else {
            $this->conditions = array('AND', array('IN', 'employee', $emp), array('BETWEEN', 'date', '\'' . $del_start . '\'', '\'' . $del_end . '\''), array('IN', 'DATE_FORMAT(date,\'%w\')', $weeks));
        }
        if ($this->query_delete()) {
            $msg->set_message('success', 'delete_success');
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

    function team_members_for_employee_report($username) {          //used for employee report, mode is used for chating purpose
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?', 'role = 2');
        $this->condition_values = array($username);
        $this->query_generate();
        $cust_query = $this->sql_query;
        $data = $this->query_fetch(2);
        if (count($data)) {
            $this->tables = array('team');
            $this->fields = array('employee');
            $this->conditions = array('IN', 'customer', $cust_query);
            $this->condition_values = array($username);
            $this->query_generate();
            $datas = $this->query_fetch(2);
            return $datas;
        } else {
            $this->tables = array('team');
            $this->fields = array('customer');
            $this->conditions = array('AND', 'employee = ?', 'role = 3');
            $this->query_generate();
            $datas = $this->query_fetch(2);
            if (count($datas)) {
                $datas[0] = array('employee' => $username);
                return $datas;
            }
            else
                return false;
        }
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
            if ($mode == 1) {
                $datas = array_merge($datas, $data);
            }
            return $datas;
        }
        return FALSE;
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
   
	function getEmployeeName($userName){
		
		$this->tables  = array("SELECT CONCAT(first_name, ' ', last_name) AS name from employee where username='$userName'");
		
		$this->query_generate_leftjoin();
		$data_name = $this->query_fetch();
		return $data_name[0]['name'];
	}
	
    function getTotalSms(){
		
		$this->tables  = array("SELECT Count(*) AS total from log_sms where status=1");
		
		$this->query_generate_leftjoin();
		$data_name = $this->query_fetch();
		return $data_name[0]['total'];
	}
    
    
    function emp_week_temp_schedule_hours($username){
		
		$this->tables  = array("SELECT SUM(t.time_to - time_from) AS week_hours FROM temp_timetable tt
LEFT JOIN timetable t ON tt.id = t.id
WHERE tt.employee = '$username'");
		
		$this->query_generate_leftjoin();
		$data_name = $this->query_fetch();
		return $data_name[0]['week_hours'];
	}
	    
      function temp_employee_slot_update($id,$employee,$empfname="",$emplname=""){
		
		$this->tables = array('temp_timetable');
        $this->fields = array('employee','empfname','emplname');
        $this->field_values = array($employee,$empfname,$emplname);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->sql_query;
        $data = $this->query_update();
	}  
     
     function check_employee_contract_hours($employee,$date){
		
			$this->tables  = array("SELECT employee_contract.employee,employee_contract.fulltime,
			employee_contract.part_time, employee_contract.hour
			FROM temp_timetable
			INNER JOIN employee_contract ON temp_timetable.employee = employee_contract.employee
			WHERE temp_timetable.employee = '".$employee."' AND ( employee_contract.fulltime = 2 OR employee_contract.fulltime = 4 ) 
			AND employee_contract.date_from < '".$date."' AND employee_contract.date_to > '".$date."'
			GROUP BY employee_contract.employee");
		
		$this->query_generate_leftjoin();
		$data = $this->query_fetch();
		return $data;
	}  
    
     function temp_get_previous_date_schedule_emp($date, $empUname){
	
        $this->tables  = array("SELECT temp_timetable.employee
                                FROM temp_timetable
                                INNER JOIN timetable ON temp_timetable.id = timetable.id
                                WHERE timetable.date='".$date."' AND temp_timetable.employee != '".$empUname."'");
            
            $this->query_generate_leftjoin();
            $data = $this->query_fetch();
            return $data;
              
      }
      
      function temp_get_next_date_schedule_emp($yesterday, $previous, $empUname){
	
        $this->tables  = array("SELECT  (timetable.time_to - timetable.time_from) AS total_time
                        FROM temp_timetable
                        INNER JOIN timetable ON temp_timetable.id = timetable.id
                        WHERE (timetable.date='".$yesterday."' || timetable.date='".$previous."') AND temp_timetable.employee = '".$empUname."'
                        AND (timetable.time_to - timetable.time_from) > 15");
            
            $this->query_generate_leftjoin();
            $data = $this->query_fetch();
            return $data;
              
      }

      function check_employee_special_leave_possibility($employee, $date_from, $date_to, $days = ''){
      	//echo $days;
      	$msg = new message();

      	if (!$this->check_employee_signed_between_dates($employee, $date_from, $date_to)) {
            $msg->set_message('fail', 'sp_leave_employee_signed_in');
            return FALSE;
        } elseif (!$this->check_employee_has_slots_between_dates($employee, $date_from, $date_to, $days)) {
            $msg->set_message('fail', 'sp_leave_slot_exists');
            return FALSE;
        } elseif (!$this->check_employee_has_leave_between_dates($employee, $date_from, $date_to, $days)) {
            $msg->set_message('fail', 'sp_leave_leave_exists');
            return FALSE;
        }else{
        	return TRUE;
        }
      }



    function check_employee_signed_between_dates($employee, $start_date, $end_date) {

        $msg = new message();

        $start_date = date('Y-m-d', strtotime('first day of this month', strtotime($start_date)));
        $end_date = date('Y-m-d', strtotime('last day of this month', strtotime($end_date)));
        $this->sql_query = "SELECT employee, customer, date, (SELECT first_name FROM employee where username = report_signing.employee) AS emp_first_name, (SELECT last_name FROM employee where username = report_signing.employee) AS emp_last_name, (SELECT first_name FROM customer where username = report_signing.customer) AS cust_first_name, (SELECT last_name FROM customer where username = report_signing.customer) AS cust_last_name FROM report_signing WHERE signin_employee IS NOT NULL AND signin_employee != '' AND employee ='". $employee ."' AND date BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
        $datas = $this->query_fetch();
        if (!$datas) {
            return TRUE;
        } else {
            $i = 0;
            $emp_name = '';
            $cust_name = '';
            foreach ($datas as $data) {
                if ($i != 0)
                    $emp_name .= ",";
                else
                    $cust_name .= $_SESSION['company_sort_by'] == 1 ? $data['cust_first_name'] . " " . $data['cust_last_name'] : $data['cust_last_name'] . " " . $data['cust_first_name'];
                $emp_name .= $_SESSION['company_sort_by'] == 1 ? $data['emp_first_name'] . " " . $data['emp_last_name'] . "=>" . $data['date'] : $data['emp_last_name'] . " " . $data['emp_first_name'] . "=>" . $data['date'];
                $i++;
            }
            $msg->set_message_exact('fail', $cust_name . " <=> " . $emp_name);
            return false;
        }
    }


    function check_employee_has_slots_between_dates($employee, $date_from, $date_to, $days = ''){
    	$msg = new message();
    	$this->sql_query = "SELECT `date` FROM timetable WHERE employee = '".$employee."' AND date BETWEEN '".$date_from."' AND '".$date_to."'";
    	if($days)
    		$this->sql_query .= " AND DAYOFWEEK(`date`) IN (".$days.")";

    	$datas = $this->query_fetch();
    	if(!empty($datas)){
    		$msg->set_message_exact('fail', $data[0]['date']);
            return false;
    	}else
    		return true;
    }

    function check_employee_has_leave_between_dates($employee, $date_from, $date_to, $days = ''){
    	$msg = new message();
    	$this->sql_query = "SELECT `date` FROM `leave` WHERE employee = '".$employee."' AND `date` BETWEEN '".$date_from."' AND '".$date_to."'";
    	if($days)
    		$this->sql_query .= " AND DAYOFWEEK(`date`) IN (".$days.")";
    	$datas = $this->query_fetch();
    	if(!empty($datas)){
    		$msg->set_message_exact('fail', $datas[0]['date']);
            return false;
    	}else
    		return true;

    }

    function get_new_leave_group_id(){
    	$this->tables = array('leave');
        $this->fields = array('MAX(group_id) AS group_id');
        $this->query_generate();
        $data = $this->query_fetch(2);
        $new_group_id = (int) ($data[0]) + 1;
        return $new_group_id;
    }

    function add_special_leave($insert_array){
    	//echo "<pre>".print_r($insert_array,1)."</pre>";
		$this->tables = array('leave');
        $this->fields = array('group_id', 'employee', 'date', 'time_from', 'time_to', 'type', 'comment', 'appr_emp', 'status');
        $this->field_values = $insert_array;
        $data = $this->query_insert();
        if ($data) {
            return true;
        } else {
        		print_r($this->query_error_details);
            return false;
        }    	
    }

    function get_special_leave($employee, $from_date, $to_date){
    	$this->sql_query = "SELECT id,group_id,`date`,comment FROM `leave` WHERE type=9 AND status = 1 AND `date` BETWEEN '".$from_date."' AND '".$to_date."' AND employee='".$employee."' ORDER BY `date` DESC, group_id ASC";

    	$datas = $this->query_fetch();
    	$leave_by_group_id = array();
        if(!empty($datas)){
        	foreach($datas as $data){
        		$leave_by_group_id[$data['group_id']][] = $data;
        	}
        	return $leave_by_group_id;
        }
        else
        	array();
    }

    function delete_special_leave($id) {
        $this->tables = array('leave');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        if ($this->query_delete()) {
            return true;
        } else {
            return false;
        }
    }

    function delete_special_leave_group($grp_id) {
        $this->tables = array('leave');
        $this->conditions = array('group_id = ?');
        $this->condition_values = array($grp_id);
        if ($this->query_delete()) {
            return true;
        } else {
            return false;
        }
    }

    function add_termination_data($employee, $termination_date, $sign_date, $city, $employee_select = NULL,$date_of_sign = NULL){
    	
		if($employee_select != NULL){
			$this->tables = array('employee_termination');
			$this->fields = array('date_of_termination','appr_emp','appr_date','appr_city');
			$this->field_values = array($termination_date,$employee, $sign_date, $city); 
			$this->conditions = array('AND','employee = ?','appr_emp IS NULL', 'date_of_sign = ?');
        	$this->condition_values = array($employee_select, $date_of_sign);
			return $this->query_update(); 
		}
		else{
			$this->tables = array('employee_termination');
			$this->fields = array('employee','date_of_termination','date_of_sign','city');
			$this->field_values = array($employee, $termination_date, $sign_date, $city); 
			return $this->query_insert(); 
		}
    }

    function get_all_terminated_employee(){
    	$this->sql_query = "SELECT ".($_SESSION['company_sort_by'] == 1 ? " concat(first_name, ' ', last_name)" : " concat(last_name, ' ', first_name)")." as `emp_name` , `employee` FROM `employee` em LEFT JOIN `employee_termination` et ON em.username = et.employee WHERE et.employee IS not null GROUP BY et.employee ORDER BY ".($_SESSION['company_sort_by'] == 1 ? 'em.first_name' : 'em.last_name')."  ";
    	return $data =  $this->query_fetch();

    }

    function check_employee_signed($emp_id ){

    	$this->sql_query = "SELECT * FROM `employee_termination` WHERE `employee` = '".$emp_id."' AND `appr_emp` IS NOT null AND `appr_date` IS NOT null AND `appr_city` IS NOT null ";

        return $data = $this->query_fetch();
    }

    function check_signed_or_not($emp_id ){
    	// exit('fgfg');
    	$this->sql_query = "SELECT `employee`,`date_of_sign`,`date_of_termination` FROM `employee_termination` WHERE `employee` = '".$emp_id ."' AND appr_emp is null and `appr_date` is null and `appr_city` is null ";
    	return $data = $this->query_fetch()[0];
    }

    function get_termination_data($employee,$employer,$appr_date){
    	$this->tables = array('employee_termination');
		$this->fields = array("*");
		$this->conditions = array('AND','employee = ?','appr_emp = ?','appr_date = ?');
        $this->condition_values = array($employee,$employer,$appr_date);
        $this->query_generate();
		return $this->query_fetch()[0]; 
    }
	
    function get_sign_terminaton_details($id){
    	$this->tables = array('employee_termination');
		$this->fields = array("*");
		$this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
		return $this->query_fetch()[0]; 
    } 

    function rejection_data_save($employee, $termination_date, $sign_date, $city,$reject_reason,$employee_select,$date_of_sign){
    	$this->tables = array('employee_termination');
		$this->fields = array('date_of_termination','appr_emp','appr_date','appr_city','reject_reason');
		$this->field_values = array($termination_date,$employee, $sign_date, $city,$reject_reason); 
		$this->conditions = array('AND','employee = ?','appr_emp IS NULL', 'date_of_sign = ?');
    	$this->condition_values = array($employee_select, $date_of_sign);
		return $this->query_update();

    }
   
}
?>