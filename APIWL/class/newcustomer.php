<?php
/**
 * Description of new customer
 * @author dona
 */
require_once('configs/config.inc.php');
require_once ('class/user.php');
require_once ('class/employee.php');
require_once ('class/newemployee.php');
require_once ('class/db.php');
require_once ('plugins/date_calc.class.php');
require_once('plugins/customize_pdf.class.php');
require_once('plugins/customize_pdf_customer.class.php');
require_once('class/general.php');

class newcustomer extends db {

    //variable declaration
    var $username = '';
    var $password = '';
    var $role = 4;
    var $login = 0;
    var $code = '';
    var $ch = '';
    var $first_name = '';
    var $last_name = '';
    var $social_security = '';
    var $address = '';
    var $city = '';
    var $post = '';
    var $phone = '';
    var $mobile = '';
    var $email = '';
    var $date = '';
    var $status = '';
    var $user = '';
    var $date_from = '';
    var $date_to = '';
    var $hours = '';
    //variables for relatives
    var $relative_name = '';
    var $relative_relation = '';
    var $relative_address = '';
    var $relative_city = '';
    var $relative_phone = '';
    var $relative_work_phone = '';
    var $relative_mobile = '';
    var $relative_email = '';
    var $relative_other = '';
    //customer helth details
    var $health_care = '';
    var $occupational_therapists = '';
    var $physiotherapists = '';
    var $aiother = '';
    //customer gaurdian details
    var $guardian_fname = '';
    var $guardian_lname = '';
    var $guardian_mobile = '';
    var $guardian_email = '';
    var $equipment_id = "";
    var $serial_number = "";
    var $customer = "";
    var $employee = "";
    var $issue_date = "";
    var $return_date = "";
    var $subject = "";
    var $note_type = "";
    var $notes = "";
    var $priority = "";
    var $description = "";
    var $work = "";
    var $history = "";
    var $clinical_picture = "";
    var $medications = "";
    var $devolution = "";
    var $special_diet = "";
    var $d_fname = "";
    var $d_lname = "";
    var $d_mobile = "";
    var $d_email = "";
    var $d_comment_other = "";
    var $d_comment_time = "";
    var $d_document = "";
    var $b_fname = "";
    var $b_lname = "";
    var $b_mobile = "";
    var $b_email = "";
    var $b_city = "";
    var $d_city = "";
    var $b_oncall = "";
    var $b_oncall2 = "";
    var $b_awake = "";
    var $b_something = "";
    var $b_comment = "";
    var $b_iss = "";
    var $b_sol = "";
    var $century = "";
   
    var $timediff = '';
    var $maxhours = '';
    var $maxhours_per_week = '';
    var $max_overtime = '';
    var $insurance_personal = '';
    var $insurance_subsitute = '';
    var $normal = '';
    var $travel = '';
    var $break = '';
    var $oncall = '';
    var $overtime = '';
    var $qual_overtime = '';
    var $more_time = '';
    var $some_other_time = '';
    var $training_time = '';
    var $call_training = '';
    var $personal_meeting = '';
    var $voluntary = 0;
    var $complementary = 0;
    var $complementary_oncall = 0;
    var $more_oncall = 0;
    var $standby = 0;
    var $work_for_dismissal = 0;
    var $work_for_dismissal_oncall = 0;
    
    var $holiday_big = '';
    var $holiday_big_oncall = '';
    var $holiday_red = '';
    var $holiday_red_oncall = '';
    var $start_day = '';
    var $week_end_travel = '';
    
    var $salary_main_last_id = '';

    function __construct() {
        parent::__construct();
    }
	
	//Get customers employee order by iorderid with seted max hours
	function GetCustEmployeesList($CustUserName) {
		$this->tables = array('team');
		$this->fields = array('team.employee');
		$this->conditions = array('AND', 'team.customer = "'.$CustUserName.'"');
		$this->order_by = array('team.orderId');
		$this->query_generate();
		$EmployeeData = $this->query_fetch(2);
		return 	!empty($EmployeeData) ? $EmployeeData : array();
	}

	//Get Global Setting
	function GetGlobalSetting() {
		$this->tables = array('global_setting');	
		$this->fields = array('*');
		$this->query_generate();
		$GloBalSetting = $this->query_fetch();
        return !empty($GloBalSetting) ? $GloBalSetting : array();
	}
	
	//Add Global setting
	function AddGlobalSetting($post_arr) {
		$timediff = $post_arr['timediff'];
		$maxhours = $post_arr['maxhours'];
		$maxhours_per_week = $post_arr['maxhours_per_week'];
		$max_overtime = $post_arr['max_overtime'];
		$insurance_personal = $post_arr['insurance_personal'];
		$insurance_subsitute = $post_arr['insurance_subsitute'];
		$inconvinient_week_holiday = $post_arr['inconvinient_week_holiday'];
		$inconvinient_evening = $post_arr['inconvinient_evening'];
		$inconvinient_night = $post_arr['inconvinient_night'];
		$inconvinient_holiday = $post_arr['inconvinient_holiday'];
		$on_call = $post_arr['on_call'];
		$oncall_holiday = $post_arr['oncall_holiday'];
		$oncall_bigholiday = $post_arr['oncall_bigholiday'];
		
		$this->tables = array('global_setting');
		$this->fields = array('schedule_time_diff','emp_max_hours','maxhours_per_week','max_overtime','insurance_personal','insurance_subsitute',
		'on_call','inconvinient_week_holiday','inconvinient_evening','inconvinient_night','inconvinient_holiday','on_call_holiday','on_call_bigholiday');
		$this->field_values = array($timediff,$maxhours,$maxhours_per_week,$max_overtime,$insurance_personal,$insurance_subsitute,
		$on_call,$inconvinient_week_holiday,$inconvinient_evening,$inconvinient_night,$inconvinient_holiday,$oncall_holiday,$oncall_bigholiday);
		return $this->query_update();
	}
	
	//Get Customer Slot from timetable 
	function GetCustomerDateSlot($CustomerUsername, $DayDate) {
		$this->tables = array ("SELECT t.*,employee.first_name, employee.last_name, employee.color, ROUND(t.time_to - t.time_from, 2) AS timediff
		FROM timetable As t
		LEFT JOIN employee
		ON t.employee = employee.username
		WHERE t.customer = '".$CustomerUsername."' AND t.date = '".$DayDate."'
		ORDER BY t.date,t.time_from,t.time_to");	
		$this->query_generate_leftjoin();
		$SlotData = $this->query_fetch();
		return !empty($SlotData) ? $SlotData : array();
	}
	
	//Get MAX schedule Date from timetable
	function GetMaxScheduleDate() {
		$this->tables = array('timetable');	
		$this->fields = array('MAX(`date`) As maxdate');
		$this->query_generate();
		$Maxdate = $this->query_fetch();
		return !empty($Maxdate) && $Maxdate[0] != '' ? $Maxdate[0]['maxdate'] : '0';
	}
	
	//Get All Employees
	function GetAllCustomers() {
		$this->tables = array('customer');
		$this->fields = array('username', '`code`', 'first_name', 'last_name','social_security','address','city','post','phone','mobile','email');
		$this->conditions = array('AND', '`status` = 1');
		$this->query_generate();
		$employee_data = $this->query_fetch();
		return !empty($employee_data) ? $employee_data : array();
	}
	
	//Change customer's employee order in customer edit page in team table 
	function Change_Customer_Employee_Order($CustomerUnm,$EmployeeList,$Employee_Counter) {
		$this->tables = array('team');
		$this->fields = array('orderId');
		$this->field_values = array($Employee_Counter);
		$this->conditions = array('AND','customer = "'.$CustomerUnm.'"','employee = "'.$EmployeeList.'"');
		return $this->query_update();
	}

	function get_employee_leave_by_customer_query($cust, $date, $fromdate, $todate, $table_timetable, $table_leave){
		$obj_employee     = new employee();
		$employees_active = $obj_employee->employees_list_for_right_click($_SESSION['user_id']);
		$extra_condition  = array('OR');
        for($i=0;$i<count($employees_active);$i++){
           $extra_condition[] = "employee = '".$employees_active[$i]['username']."'"; 
        }
		$this->tables     = array($table_timetable);
		$this->fields     = array('DISTINCT employee');
		$this->conditions = array('AND', "customer = '".$cust."'",'status = 2',$extra_condition);
		$this->query_generate();
		$data = $this->query_fetch(2);
		$team_employee_data =  '\'' . implode('\', \'', $data) . '\'';
		
		$user            = new user();
		$employee_data   = array();
		$login_user      = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);
			
		if($login_user_role == 1 || $login_user_role == 6 || $login_user_role == 2 || $login_user_role == 7) {			
		
			$this->tables = array ("SELECT  l.employee, l.time_from, l.time_to, l.type, l.status, CONCAT_WS(', ',e.last_name,e.first_name) AS empname, TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(l.date,' ',l.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(l.date,' ',l.time_to),'%Y-%m-%d %H.%i'),l.date + INTERVAL 1 DAY)) AS totalMinutes
				FROM  `".$table_leave."` as l 
				LEFT JOIN employee As e ON l.employee = e.username 
				WHERE  l.employee != '' AND l.employee IN ( ".$team_employee_data." ) AND l.date = '".$date."'
				ORDER BY e.last_name,e.first_name,l.employee,l.time_from,l.time_to");				
			
		}			
		else if($login_user_role == 3 || $login_user_role == 5){
			$team_members = $this->team_members($login_user);
			$team_data =  '\'' . implode('\', \'', $data) . '\'';
			$this->tables = array ("SELECT l.employee, l.time_from, l.time_to, CONCAT_WS(', ',e.last_name,e.first_name) AS empname, TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(l.date,' ',l.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(l.date,' ',l.time_to),'%Y-%m-%d %H.%i'),l.date + INTERVAL 1 DAY)) AS totalMinutes
				FROM `".$table_leave."` as l 
				LEFT JOIN employee As e ON l.employee = e.username 
				WHERE l.employee != '' AND ((l.employee IN ( ".$team_data." ) AND (l.status = 1 OR l.status = '')) OR (l.employee IN ( '".$login_user."' ))) AND  l.date = '".$date."' 
				ORDER BY e.last_name,e.first_name,l.employee,l.time_from,l.time_to");
		}
		else if($login_user_role == 4){
			//show approved leaves only
			$this->tables = array ("SELECT l.employee, l.time_from, l.time_to, CONCAT_WS(', ',e.last_name,e.first_name) AS empname, TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(l.date,' ',l.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(l.date,' ',l.time_to),'%Y-%m-%d %H.%i'),l.date + INTERVAL 1 DAY)) AS totalMinutes
				FROM `".$table_leave."` as l 
				LEFT JOIN employee As e ON l.employee = e.username 
				WHERE l.employee != '' AND l.employee IN ( ".$team_employee_data." ) AND (l.status = 1 OR l.status = '') AND l.date = '".$date."' 
				ORDER BY e.last_name,e.first_name,l.employee,l.time_from,l.time_to");
		}
		$this->query_generate_leftjoin();
		return $this->sql_query;
	}
	
	//Get Customer's Employees leave by custoemer and date
	function get_employee_leave_by_customer($cust,$date) {
		$obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $fromdate = $todate = $date;

        if($fromdate <= $boundary_date && $todate > $boundary_date){
			$real_table_data   = $this->get_employee_leave_by_customer_query($cust, $date, $fromdate, $todate, 'timetable','leave');
			$backup_table_data = $this->get_employee_leave_by_customer_query($cust, $date, $fromdate, $todate ,'backup_timetable','backup_leave');
    		$this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
    		$this->sql_query = $this->get_employee_leave_by_customer_query($cust, $date, $fromdate, $todate ,'backup_timetable','backup_leave');
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
    		$this->sql_query = $this->get_employee_leave_by_customer_query($cust, $date, $fromdate, $todate, 'timetable','leave');
        }
		$Customer_Leave_data = $this->query_fetch();
		return !empty($Customer_Leave_data) ? $Customer_Leave_data : array();
	}

	function get_employee_schedule_by_customer_query($cust, $date, $fromdate, $todate, $table){
		$obj_employee = new employee();
		$employees_active = $obj_employee->employees_list_for_right_click($_SESSION['user_id']);
	    $extra_condition = '(';
	    for($i=0;$i<count($employees_active);$i++){
	        if($i == count($employees_active)-1){
	           $extra_condition = $extra_condition." t.employee = '".$employees_active[$i]['username']."'";  
	        }
	        else{
	            $extra_condition = $extra_condition." t.employee = '".$employees_active[$i]['username']."' OR "; 
	        }
	    }
	    $extra_condition = $extra_condition." )";
		$this->tables = array ("SELECT t.employee,t.time_from, t.time_to, CONCAT_WS(', ',e.last_name,e.first_name) AS empname, CONCAT_WS(', ',e.first_name,e.last_name) AS empname_ff,TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)) AS totalMinutes
			FROM ".$table." as timetable As t
			LEFT JOIN employee As e ON t.employee = e.username 
			WHERE t.customer = '".$cust."' AND t.employee != '' AND t.status = 1 AND ".$extra_condition." AND t.date = '".$date."' 
			ORDER BY e.last_name,e.first_name,t.employee,t.time_from,t.time_to");
           $this->query_generate_leftjoin();
           return $this->sql_query;
	}

	//Get customer's employees shcdule hours by date
	function get_employee_schedule_by_customer($cust, $date){

		$obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $fromdate = $todate = $date;
        if($fromdate <= $boundary_date && $todate > $boundary_date){
    		$real_table_data  = $this->get_employee_schedule_by_customer_query($cust, $date, $fromdate, $todate, 'timetable');
    		$backup_table_data = $this->get_employee_schedule_by_customer_query($cust, $date, $fromdate, $todate ,'backup_timetable');
    		$this->sql_query = '( ' . $real_table_data . ' ) ' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
    		$this->sql_query = $this->get_employee_schedule_by_customer_query($cust, $date, $fromdate, $todate ,'backup_timetable');

        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
    		$this->sql_query = $this->get_employee_schedule_by_customer_query($cust, $date, $fromdate, $todate, 'timetable');
        }
		$Customer_schedule_date = $this->query_fetch();
		return !empty($Customer_schedule_date) ? $Customer_schedule_date : array();
	}
	
	function get_employee_Leave_hours_based_on_customer($cust,$date) {
		$this->tables = array('team');
		$this->fields = array('DISTINCT employee');
		$this->conditions = array('AND', "customer = '".$cust."'");
		$this->query_generate();
		$data = $this->query_fetch(2);		
		$team_memeber =  '\'' . implode('\', \'', $data) . '\'';
		
		$this->tables = array('leave', 'timetable` as `t');	
		$this->fields = array('t.employee','t.customer','t.time_from AS schfrom','t.time_to AS schto','leave.time_from AS leafrom','leave.time_to AS leato','leave.type','leave.date As leavedate','t.date AS schduledate');
		$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.type != 3","t.customer = '".$cust."'","leave.date = '".$date."'","t.date = '".$date."'",array('IN', 'leave.employee', $team_memeber));
		$this->query_generate();
		$customer_data = $this->query_fetch();

		$totemp = count($customer_data);
		$leavearr = array();
		$TotalLeaveMinutes = 0;
		if($totemp > 0) {		
			for($w=0;$w<$totemp;$w++) {
					$empuname 		= $customer_data[$w]['employee'];
					$custuname 		= $customer_data[$w]['customer'];
					$schdulefrom 	= $customer_data[$w]['schfrom'];
					$schduleto 		= $customer_data[$w]['schto'];
					$leavefrom 		= $customer_data[$w]['leafrom'];
					$leaveto 		= $customer_data[$w]['leato'];
					$leavetype 		= $customer_data[$w]['type'];
					$leavedate 		= $customer_data[$w]['leavedate'];
					
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
					
					if($schdulefrom <= $leavefrom && $schduleto >= $leaveto){
						$total_leave = $leaveto - $leavefrom;
					}
					elseif($schdulefrom >= $leavefrom && $schduleto >= $leaveto){
						$total_leave = $leaveto - $leavefrom - ($schdulefrom - $leavefrom);
					}
					elseif($schdulefrom <= $leavefrom && $schduleto <= $leaveto){
						$total_leave = $leaveto - $leavefrom - ($leaveto - $schduleto);
					}
					elseif($schdulefrom >= $leavefrom && $schduleto <= $leaveto){
						$total_leave = $leaveto - $leavefrom - (($schdulefrom - $leavefrom) + ($leaveto - $schduleto));
					}
					$TotalLeaveMinutes += $total_leave;				
			}
		}
		return $TotalLeaveMinutes > 0 ? $TotalLeaveMinutes : 0;
	}

	function get_employee_Leave_hours_based_on_customer_type3($cust,$date) {
		$this->tables = array('team');
		$this->fields = array('DISTINCT employee');
		$this->conditions = array('AND', "customer = '".$cust."'");
		$this->query_generate();
		$data = $this->query_fetch(2);		
		$team_memeber =  '\'' . implode('\', \'', $data) . '\'';
		
		$this->tables = array('leave','timetable` as `t');	
		$this->fields = array('t.employee','t.customer','t.time_from AS schfrom','t.time_to AS schto','leave.time_from AS leafrom','leave.time_to AS leato','leave.type','leave.date As leavedate','t.date AS schduledate');
		$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.type = 3","t.customer = '".$cust."'","leave.date = '".$date."'","t.date = '".$date."'",array('IN', 'leave.employee', $team_memeber));
		$this->query_generate();
		$customer_data = $this->query_fetch();
		
		$totemp = count($customer_data);
		$leavearr = array();
		$TotalLeaveMinutes = 0;
		if($totemp > 0){		
			for($w=0;$w<$totemp;$w++){
				$empuname 		= $customer_data[$w]['employee'];
				$custuname 		= $customer_data[$w]['customer'];
				$schdulefrom 	= $customer_data[$w]['schfrom'];
				$schduleto 		= $customer_data[$w]['schto'];
				$leavefrom 		= $customer_data[$w]['leafrom'];
				$leaveto 		= $customer_data[$w]['leato'];
				$leavetype 		= $customer_data[$w]['type'];
				$leavedate 		= $customer_data[$w]['leavedate'];
				
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
				
				if($schdulefrom <= $leavefrom && $schduleto >= $leaveto) {
					$total_leave = $leaveto - $leavefrom;
				}
				elseif($schdulefrom >= $leavefrom && $schduleto >= $leaveto) {
					$total_leave = $leaveto - $leavefrom - ($schdulefrom - $leavefrom);
				}
				elseif($schdulefrom <= $leavefrom && $schduleto <= $leaveto) {
					$total_leave = $leaveto - $leavefrom - ($leaveto - $schduleto);
				}
				elseif($schdulefrom >= $leavefrom && $schduleto <= $leaveto) {
					$total_leave = $leaveto - $leavefrom - (($schdulefrom - $leavefrom) + ($leaveto - $schduleto));
				}
				$TotalLeaveMinutes += $total_leave;				
			}
		}
		return $TotalLeaveMinutes > 0 ? $TotalLeaveMinutes : 0;
	}
	
	//Added By Rahul 24-9-2012
	//This function is for find out the schedule hours for customer from schedule table here cust is username of customer
	function get_Regular_schedule_Hours_of_cust($cust,$date) {
		$obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $fromdate = $todate = $date;

        $obj_emp = new employee();
        $employees_display = $obj_emp->employees_list_for_right_click($_SESSION['user_id']);
        $extra_condition = array('OR');
        for($i=0;$i<count($employees_display);$i++){
           $extra_condition[] = "employee = '".$employees_display[$i]['username']."'"; 
        }

        if($fromdate <= $boundary_date && $todate > $boundary_date){
        	$this->tables = array('timetable` as `t');		
			$this->fields = array("SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60) AS hrsmins");		 
			$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.type != 3","t.type != 9","t.type != 14","t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate(); 
			$real_table_data = $this->sql_query;

			$this->tables = array('backup_timetable` as `t');		
			$this->fields = array("SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60) AS hrsmins");		 
			$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.type != 3","t.type != 9","t.type != 14","t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate();
			$backup_table_data = $this->sql_query;

			$this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
			$this->tables = array('backup_timetable` as `t');
			$proceed      = true;
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
			$this->tables = array('timetable` as `t');
			$proceed      = true;
        }
        if($proceed == true){
			$this->fields = array("SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60) AS hrsmins");		 
			$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.type != 3","t.type != 9","t.type != 14","t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate(); 
        }
 
		 $Scheduled_Hrs = $this->query_fetch();
		 return count($Scheduled_Hrs[0]['hrsmins']) > 0 ? $Scheduled_Hrs[0]['hrsmins'] : 0;
	}

	//Added By Rahul 24-9-2012
	//This function is for find out the schedule hours for customer from schedule table here cust is username of customer
	function get_Oncall_schedule_Hours_of_cust($cust,$date) {
		$obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $fromdate = $todate = $date;

        $obj_emp = new employee();
        $employees_display = $obj_emp->employees_list_for_right_click($_SESSION['user_id']);
        $extra_condition = array('OR');
        for($i=0;$i<count($employees_display);$i++){
           $extra_condition[] = "employee = '".$employees_display[$i]['username']."'"; 
        }

        if($fromdate <= $boundary_date && $todate > $boundary_date){
        	$this->tables = array('timetable` as `t');	
			$this->fields = array("SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60) AS hrsmins");	 
			$this->conditions = array('AND', 't.status = 1',"t.employee != ''",array('OR',"t.type = 3","t.type = 9","t.type = 14"),"t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate();
			$real_table_data = $this->sql_query;

			$this->tables = array('backup_timetable` as `t');
			$this->fields = array("SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60) AS hrsmins");	 
			$this->conditions = array('AND', 't.status = 1',"t.employee != ''",array('OR',"t.type = 3","t.type = 9","t.type = 14"),"t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate();
			$backup_table_data = $this->sql_query;

			$this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
			$this->tables = array('backup_timetable` as `t');
			$proceed      = true;
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
			$this->tables = array('timetable` as `t');
			$proceed      = true;
        }
        if($proceed == true){
        	$this->fields = array("SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60) AS hrsmins");	 
			$this->conditions = array('AND', 't.status = 1',"t.employee != ''",array('OR',"t.type = 3","t.type = 9","t.type = 14"),"t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate();
        }

		$Scheduled_Hrs = $this->query_fetch();		
		return count($Scheduled_Hrs[0]['hrsmins']) > 0 ? $Scheduled_Hrs[0]['hrsmins'] : 0;
	}

	function get_Unalloc_schedule_Hours_of_cust($cust,$date) {
		$obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $fromdate = $todate = $date;

        if($fromdate <= $boundary_date && $todate > $boundary_date){
        	$this->tables = array('timetable` as `t');		
			$this->fields = array("SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60) AS hrsmins");		 
			$this->conditions = array('AND', 't.status = 0',"t.employee = ''","t.customer = '".$cust."'","t.date = '".$date."'");
			$this->query_generate(); 
			$real_table_data = $this->sql_query;

			$this->tables = array('backup_timetable` as `t');		
			$this->fields = array("SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60) AS hrsmins");		 
			$this->conditions = array('AND', 't.status = 0',"t.employee = ''","t.customer = '".$cust."'","t.date = '".$date."'");
			$this->query_generate();
			$backup_table_data = $this->sql_query;

			$this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
			$this->tables = array('backup_timetable` as `t');
			$proceed      = true;
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
			$this->tables = array('timetable` as `t');
			$proceed      = true;
        }
        if($proceed == true){
			$this->fields = array("SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60) AS hrsmins");		 
			$this->conditions = array('AND', 't.status = 0',"t.employee = ''","t.customer = '".$cust."'","t.date = '".$date."'");
			$this->query_generate(); 
        }
 
		 $Scheduled_Hrs = $this->query_fetch();
		 return count($Scheduled_Hrs[0]['hrsmins']) > 0 ? $Scheduled_Hrs[0]['hrsmins'] : 0;
	}
	
	function days_between($datefrom,$dateto) {

		$fromday_start = mktime(0,0,0,date("m",$datefrom),date("d",$datefrom),date("Y",$datefrom));
		
		$diff = $dateto - $datefrom;
	 	$days = intval( $diff / 86400 ); // 86400  / day
			
		if( ($datefrom - $fromday_start) + ($diff % 86400) > 86400 ) $days++;
		return  $days;
	}			

	function weeks_between($datefrom, $dateto) {
			
		$day_of_week = date("w", $datefrom);
		$fromweek_start = $datefrom - ($day_of_week * 86400) - ($datefrom % 86400);
		$diff_days = $this->days_between($datefrom, $dateto);
		$diff_weeks = intval($diff_days / 7);
		$seconds_left = ($diff_days % 7) * 86400;
		
		if( ($datefrom - $fromweek_start) + $seconds_left > 604800 ) $diff_weeks ++;
		return $diff_weeks;
	}

	function get_emp_cust_hrs($customer,$employee,$fromdate,$todate) {
		$obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;

		$obj_employee = new employee();
		$employees_active = $obj_employee->employees_list_for_right_click($_SESSION['user_id']);
        $extra_condition = array('OR');
        for($i=0;$i<count($employees_active);$i++){
           $extra_condition[] = "employee = '".$employees_active[$i]['username']."'"; 
        }
        if($fromdate <= $boundary_date && $todate > $boundary_date){
        	$this->tables = array('timetable` as `t');
			$this->fields = array("CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins","employee","customer");
			if($todate != '0000-00-00') {
				$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.date BETWEEN '".$fromdate."' AND '".$todate."' ","t.employee = '".$employee."'","t.customer = '".$customer."'",$extra_condition);		
			}
			else {
				$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.date = '".$fromdate."' ","t.employee = '".$employee."'","t.customer = '".$customer."'",$extra_condition);				
			}
			$this->query_generate();
			$real_table_data = $this->sql_query;


			$this->tables = array('backup_timetable` as `t');
			$this->fields = array("CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins","employee","customer");
			if($todate != '0000-00-00') {
				$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.date BETWEEN '".$fromdate."' AND '".$todate."' ","t.employee = '".$employee."'","t.customer = '".$customer."'",$extra_condition);		
			}
			else {
				$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.date = '".$fromdate."' ","t.employee = '".$employee."'","t.customer = '".$customer."'",$extra_condition);				
			}
			$this->query_generate();
			$backup_table_data = $this->sql_query;
			$this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
        	$this->tables = array('backup_timetable` as `t');
            $proceed = TRUE;
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
        	$this->tables = array('timetable` as `t');
            $proceed = TRUE;
        }
        if($proceed == true){
			$this->fields = array("CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins","employee","customer");
			if($todate != '0000-00-00') {
				$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.date BETWEEN '".$fromdate."' AND '".$todate."' ","t.employee = '".$employee."'","t.customer = '".$customer."'",$extra_condition);		
			}
			else {
				$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.date = '".$fromdate."' ","t.employee = '".$employee."'","t.customer = '".$customer."'",$extra_condition);				
			}
			$this->query_generate();
        }
			
		$Scheduled_Hrs = $this->query_fetch();	
		return !empty($Scheduled_Hrs) ? $Scheduled_Hrs : array();
		exit;	
	}
	
	//Added By Rahul 24-9-2012
	//This function is for find out the schedule hours for customer from schedule table
	function Total_schedule_Hours_of_emps($cust, $date) {
		$obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $start_date = $end_date = $date;

        $obj_employee = new employee();
        $employees_active = $obj_employee->employees_list_for_right_click($_SESSION['user_id']);
        $extra_condition = array('OR');
        for($i=0;$i<count($employees_active);$i++){
           $extra_condition[] = "employee = '".$employees_active[$i]['username']."'"; 
        }
        if($start_date <= $boundary_date && $end_date > $boundary_date){
        	$this->tables = array('timetable` as `t');		
			$this->fields = array("CONCAT_WS('.',SUM(FLOOR(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60)),SUM((TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");		 
			$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate();
			$real_table_data = $this->sql_query;

			$this->tables = array('backup_timetable` as `t');		
			$this->fields = array("CONCAT_WS('.',SUM(FLOOR(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60)),SUM((TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");		 
			$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate();
			$backup_table_data = $this->sql_query;

			$this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
        }
        else if($start_date <= $boundary_date && $end_date <= $boundary_date){
            $this->tables = array('backup_timetable` as `t');
            $proceed = TRUE;
        }
        else if($start_date > $boundary_date && $end_date > $boundary_date){
            $this->tables = array('timetable` as `t');
            $proceed = TRUE;
        }
        if($proceed == true){
			$this->fields = array("CONCAT_WS('.',SUM(FLOOR(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60)),SUM((TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");		 
			$this->conditions = array('AND', 't.status = 1',"t.employee != ''","t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate();
        }

		$Scheduled_Hrs = $this->query_fetch();	
		return count($Scheduled_Hrs[0]['hrsmins']) > 0 ? $Scheduled_Hrs[0]['hrsmins'] : 0;
	}
	
	//Added By Rahul 24-9-2012
	//This function is for find out the schedule hours for customer from schedule table
	function Total_schedule_Hours_each_emps($cust,$date) {
		$obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $start_date = $end_date = $date;

        $obj_employee = new employee();
        $employees_active = $obj_employee->employees_list_for_right_click($_SESSION['user_id']);
        $extra_condition = array('OR');
        for($i=0;$i<count($employees_active);$i++){
           $extra_condition[] = "employee = '".$employees_active[$i]['username']."'"; 
        }
        if($start_date <= $boundary_date && $end_date > $boundary_date){
        	$this->tables = array('timetable` as `t','employee');		
			$this->fields = array("CONCAT_WS('.',FLOOR(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60),(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60) AS hrsmins","CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) AS empname","employee.color","t.time_from","t.time_to","t.type","t.fkkn","employee.username AS empusername");
			$this->conditions = array('AND','employee.username = t.employee', 't.status = 1',"t.employee != ''","t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate();
			$real_table_data = $this->sql_query;

			$this->tables = array('backup_timetable` as `t','employee');		
			$this->fields = array("CONCAT_WS('.',FLOOR(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60),(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60) AS hrsmins","CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) AS empname","employee.color","t.time_from","t.time_to","t.type","t.fkkn","employee.username AS empusername");
			$this->conditions = array('AND','employee.username = t.employee', 't.status = 1',"t.employee != ''","t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->order_by = array('employee.last_name','employee.first_name',"t.time_from","t.time_to");			
			$this->query_generate();	
			$backup_table_data = $this->sql_query;

			$this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ORDER BY  `last_name`, `first_name`, `time_from`,`time_to`' ;

        }
        else if($start_date <= $boundary_date && $end_date <= $boundary_date){
            $this->tables = array('backup_timetable` as `t','employee');
            $proceed = TRUE;
        }
        else if($start_date > $boundary_date && $end_date > $boundary_date){
            $this->tables = array('timetable` as `t','employee');
            $proceed = TRUE;
        }
        if($proceed == TRUE){
			$this->fields = array("CONCAT_WS('.',FLOOR(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))/60),(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60) AS hrsmins","CONCAT_WS(' ',LCASE(employee.first_name),LCASE(employee.last_name)) AS empname","employee.color","t.time_from","t.time_to","t.type","t.fkkn","employee.username AS empusername");
			$this->conditions = array('AND','employee.username = t.employee', 't.status = 1',"t.employee != ''","t.customer = '".$cust."'","t.date = '".$date."'",$extra_condition);
			$this->query_generate();
        }

		$Scheduled_Hrs = $this->query_fetch();
		return !empty($Scheduled_Hrs) ? $Scheduled_Hrs : array();
	}
	
	//customer active in active data
	function customer_activeinactive_data($key = NULL,$status, $order) {
		
        $user = new user();
        $employee_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
		
		if($order == '-') $order	= 'ascname';
		if ($key != '-') { 
			$fullname = str_replace('_',' ',$key);
			$key = $fullname;
		}

        switch ($login_user_role) {
            case 1:
            case 6:
                $team_members = $this->team_members($login_user);
                $this->tables = array('customer');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
                $this->conditions = array('AND', '1');
                $this->condition_values = array();
				if($status != '-')
					$this->conditions[] = 'status = '.$status.'';
				if ($key != '-') {
					$this->conditions[] = 'LCASE(last_name) LIKE ?';
					$this->condition_values[] = strtolower($key)."%";
				}
				switch ($order) {
					case 'ascnum': 	$this->order_by = array('code'); break;
					case 'descnum': $this->order_by = array('code DESC'); break;
					case 'ascssn': 	$this->order_by = array('social_security ASC'); break;
					case 'descssn': $this->order_by = array('social_security DESC'); break;
					case 'ascname': $this->order_by = array('LOWER(last_name) ASC','LOWER(first_name) ASC'); break;
					case 'descname':$this->order_by = array('LOWER(last_name) DESC','LOWER(first_name) DESC'); break;
				}
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 2:
            case 7:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('customer');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
                $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
                $this->condition_values = array();
				if($status != '-')
					$this->conditions[] = 'status = '.$status.'';
				if ($key != '-') {
					$this->conditions[] = 'LCASE(last_name) LIKE ?';
					$this->condition_values[] = strtolower($key)."%";
				}
                switch ($order) {
					case 'ascnum': 	$this->order_by = array('code ASC'); break;
					case 'descnum': $this->order_by = array('code DESC'); break;
					case 'ascssn': 	$this->order_by = array('social_security ASC'); break;
					case 'descssn': $this->order_by = array('social_security DESC'); break;
					case 'ascname': $this->order_by = array('LOWER(last_name) ASC','LOWER(first_name) ASC'); break;
					case 'descname':$this->order_by = array('LOWER(last_name) DESC','LOWER(first_name) DESC'); break;
				}
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 3:
            case 5:
                $team_employee_data = '\'' . $login_user . '\'';
                $this->tables = array('customer');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
                $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
                $this->condition_values = array();
				if($status != '-')
					$this->conditions[] = 'status = '.$status.'';
				if ($key != '-') {
					$this->conditions[] = 'LCASE(last_name) LIKE ?';
					$this->condition_values[] = strtolower($key)."%";
				}
                switch ($order) {
					case 'ascnum': 	$this->order_by = array('code ASC'); break;
					case 'descnum': $this->order_by = array('code DESC'); break;
					case 'ascssn': 	$this->order_by = array('social_security ASC'); break;
					case 'descssn': $this->order_by = array('social_security DESC'); break;
					case 'ascname': $this->order_by = array('LOWER(last_name) ASC','LOWER(first_name) ASC'); break;
					case 'descname':$this->order_by = array('LOWER(last_name) DESC','LOWER(first_name) DESC'); break;
				}
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
            case 4:
                $team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
                $this->tables = array('customer');
                $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile', 'status','email','address','post');
                $this->conditions = array('AND', array('IN', 'username', $team_employee_data));
                $this->condition_values = array();
				if($status != '-')
					$this->conditions[] = 'status = '.$status.'';
				if ($key != '-') {
					$this->conditions[] = 'LCASE(last_name) LIKE ?';
					$this->condition_values[] = strtolower($key)."%";
				}
				switch ($order) {
					case 'ascnum': 	$this->order_by = array('code ASC'); break;
					case 'descnum': $this->order_by = array('code DESC'); break;
					case 'ascssn': 	$this->order_by = array('social_security ASC'); break;
					case 'descssn': $this->order_by = array('social_security DESC'); break;
					case 'ascname': $this->order_by = array('LOWER(last_name) ASC','LOWER(first_name) ASC'); break;
					case 'descname':$this->order_by = array('LOWER(last_name) DESC','LOWER(first_name) DESC'); break;
				}
                $this->query_generate();
                $employee_data = $this->query_fetch();
                break;
        }
        return !empty($employee_data) ? $employee_data : array();
    }
	
	function customer_getgardins($username) {
		$this->tables = array('customer_guardian');
		$this->fields = array('first_name','last_name','mobile','email');
		$this->conditions = array('AND', 'customer = "'.$username.'"');
		$this->query_generate();
		$employee_data = $this->query_fetch();
		return !empty($employee_data) ? $employee_data : array();	
	}
	
	function customer_getrelatives($username) {
		$this->tables = array('customer_relative');
		$this->fields = array('name', 'relation', 'phone', 'mobile','email');
		$this->conditions = array('AND', 'customer = "'.$username.'"');
		$this->query_generate();
		$employee_data = $this->query_fetch();
		return !empty($employee_data) ? $employee_data : array();
	}
	
	function custgriddata($name,$fromdate,$todate) {
			
		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);		
		$name = str_replace('_',' ',$name);		
				
		switch ($login_user_role) {	
			case 1:
			case 6:			
				$team_members = $this->team_members($login_user);
				$this->tables = array('employee','customer','timetable` as `t');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','t.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(t.time_to - t.time_from, 2)) AS `Total Hours`',
				"SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY))) AS totalMinutes",
				"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");	
				
				$this->conditions = array('AND', 'employee.status = 1', 'customer.status = 1', 't.status = 1', 'employee.username = t.employee', 'customer.username = t.customer');
				$this->condition_values = array();

				if($name != '-'){
					$this->conditions[] = array('OR','LCASE(customer.last_name) LIKE ?','LCASE(customer.first_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?');
					$this->condition_values = array_merge($this->condition_values, array(strtolower($name)."%", strtolower($name)."%", strtolower($name)."%"));
				}

				if($fromdate != '0000-00-00' && $todate == '0000-00-00')
					$this->conditions[] = 't.date >= "'.$fromdate.'" ';
				elseif($fromdate == '0000-00-00' && $todate != '0000-00-00')
					$this->conditions[] = 't.date <= "'.$todate.'"';
				elseif($fromdate != '0000-00-00' && $todate != '0000-00-00')
					$this->conditions[] = 't.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"';
				
				$this->group_by = array('t.customer','t.employee');
				$this->order_by = array('customer.last_name','customer.first_name','employee.first_name','employee.last_name');				
				$this->query_generate();
				$employee_data = $this->query_fetch();
				return !empty($employee_data) && !empty($employee_data[0]['username']) ? $employee_data : array();
				break;
		case 2:
		case 7:
				$team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
	
				$this->tables = array('employee','customer','timetable` as `t');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','t.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(t.time_to - t.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");
				$this->conditions = array('AND', 'employee.status = 1', 'customer.status = 1', 't.status = 1', 'employee.username = t.employee', 'customer.username = t.customer', array('IN', 'employee.username', $team_employee_data));
				$this->condition_values = array();

				if($name != '-'){
					$this->conditions[] = array('OR','LCASE(customer.last_name) LIKE ?','LCASE(customer.first_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?');
					$this->condition_values = array_merge($this->condition_values, array(strtolower($name)."%", strtolower($name)."%", strtolower($name)."%"));
				}
				if($fromdate != '0000-00-00' && $todate == '0000-00-00')
					$this->conditions[] = 't.date >= "'.$fromdate.'" ';
				elseif($fromdate == '0000-00-00' && $todate != '0000-00-00')
					$this->conditions[] = 't.date <= "'.$todate.'"';
				elseif($fromdate != '0000-00-00' && $todate != '0000-00-00')
					$this->conditions[] = 't.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"';

				$this->group_by = array('t.customer','t.employee');
				$this->order_by = array('customer.last_name','customer.first_name','employee.first_name','employee.last_name');	
				$this->query_generate();
				$employee_data = $this->query_fetch();
				return !empty($employee_data) ? $employee_data : array();	
				break;
			case 3:
			case 5:
				$team_employee_data = '\'' . $login_user . '\'';
				$this->tables = array('employee','customer','timetable` as `t');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','t.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(t.time_to - t.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");
				$this->conditions = array('AND','employee.status = 1','customer.status = 1','t.status = 1','employee.username = t.employee','customer.username = t.customer', array('IN', 'employee.username', $team_employee_data));
				$this->condition_values = array();

				if($name != '-'){
					$this->conditions[] = array('OR','LCASE(customer.last_name) LIKE ?','LCASE(customer.first_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?');
					$this->condition_values = array_merge($this->condition_values, array(strtolower($name)."%", strtolower($name)."%", strtolower($name)."%"));
				}

				if($fromdate != '0000-00-00' && $todate == '0000-00-00')
					$this->conditions[] = 't.date >= "'.$fromdate.'" ';
				elseif($fromdate == '0000-00-00' && $todate != '0000-00-00')
					$this->conditions[] = 't.date <= "'.$todate.'"';
				elseif($fromdate != '0000-00-00' && $todate != '0000-00-00')
					$this->conditions[] = 't.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"';

				$this->group_by = array('t.customer','t.employee');
				$this->order_by = array('customer.last_name','customer.first_name','employee.first_name','employee.last_name');	
				$this->query_generate();
				$employee_data = $this->query_fetch();
				return !empty($employee_data) ? $employee_data : array();
				break;
		case 4:			
				$team_members = $this->team_members($login_user);
                $team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
				
				$this->tables = array('employee','customer','timetable` as `t');
				$this->fields = array('employee.username','employee.first_name AS empfname','employee.last_name AS emplname','t.customer','customer.first_name AS custfname','customer.last_name AS custlname','SUM(ROUND(t.time_to - t.time_from, 2)) AS `Total Hours`',"CONCAT_WS('.',FLOOR(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))/60),(SUM(TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(t.date,' ',t.time_from),'%Y-%m-%d %H.%i'),COALESCE(STR_TO_DATE(CONCAT(t.date,' ',t.time_to),'%Y-%m-%d %H.%i'),t.date + INTERVAL 1 DAY)))%60)) AS hrsmins");				
				$this->conditions = array('AND','employee.status = 1','customer.status = 1','t.status = 1','employee.username = t.employee','customer.username = t.customer',array('IN', 'employee.username', $team_employee_data));
				$this->condition_values = array();

				if($name != '-'){
					$this->conditions[] = array('OR','LCASE(customer.last_name) LIKE ?','LCASE(customer.first_name) LIKE ?','CONCAT_WS(" ",LCASE(customer.first_name),LCASE(customer.last_name)) LIKE ?');
					$this->condition_values = array_merge($this->condition_values, array(strtolower($name)."%", strtolower($name)."%", strtolower($name)."%"));
				}

				if($fromdate != '0000-00-00' && $todate == '0000-00-00')
					$this->conditions[] = 't.date >= "'.$fromdate.'" ';
				elseif($fromdate == '0000-00-00' && $todate != '0000-00-00')
					$this->conditions[] = 't.date <= "'.$todate.'"';
				elseif($fromdate != '0000-00-00' && $todate != '0000-00-00')
					$this->conditions[] = 't.date BETWEEN "'.$fromdate.'" AND "'.$todate.'"';

				$this->group_by = array('t.customer','t.employee');
				$this->order_by = array('customer.last_name','customer.first_name','employee.first_name','employee.last_name');	
				$this->query_generate();
				$employee_data = $this->query_fetch();
				return !empty($employee_data) ? $employee_data : array();
				break;	
		}
	}
	
	// This function is for show data of CUSTOMER with auto suggest
	function getcustomer($name) {	
        if($_SESSION['company_sort_by'] == 1)
            $condition_value = array('LOWER(first_name)');
        elseif($_SESSION['company_sort_by'] == 2)
            $condition_value = array('LOWER(last_name)');

		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user);
		$name = str_replace('_',' ',$name);
	  	if ($name != NULL) {
            switch ($login_user_role) {

                case 1: 			
                case 6: 
                    $this->tables = array('customer');
                    $this->fields = array('username', '`code`', 'first_name', 'last_name', 'century', 'social_security', 'city', 'phone', 'mobile','address','post');
					$this->conditions = array('AND', 'status = 1','username = "'.$name.'"');
					$this->order_by = $condition_value;
                    $this->query_generate();
                    $employee_data = $this->query_fetch();					
                    break;	
				case 2:
                case 7:
				case 3:
					$this->tables = array('team');
					$this->fields = array('customer');
					$this->conditions = array('AND',"employee = '".$login_user."'");
					$this->query_generate();
					$team_members = $this->query_fetch(2);
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
					
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'century', 'social_security', 'city', 'phone', 'mobile','address','post');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1','username = "'.$name.'"');
					$this->order_by = $condition_value;
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 5:	
                case 4:				
					$team_employee_data = '\'' . $login_user . '\'';
					$this->tables = array('customer');
					$this->fields = array('username', 'code', 'first_name', 'last_name', 'century', 'social_security', 'city', 'phone', 'mobile','address','post');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1','username = "'.$name.'"');
					$this->order_by = $condition_value;				
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;
            }
        }
	
		return !empty($employee_data) ? $employee_data : array();
	}
	
	// find customer name from username
	function getcustomerName($name) {	
        if($_SESSION['company_sort_by'] == 1)
            $condition_value = array('LOWER(first_name)');
        elseif($_SESSION['company_sort_by'] == 2)
            $condition_value = array('LOWER(last_name)');
		$user = new user();	
		$employee_data = array();
		$login_user = $_SESSION['user_id'];
		$login_user_role = $user->user_role($login_user); 
	  	if ($name != NULL)  {
            switch ($login_user_role) {

                case 1:						
                case 6:			
                    $this->tables = array('customer');
                    $this->fields = array('username', '`code`', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','address','post');
					$this->conditions = array('AND', 'status = 1','username = "'.$name.'"');
					$this->order_by = $condition_value;
                    $this->query_generate();
                    $employee_data = $this->query_fetch();					
                    break;	
				case 2:
                case 7:		
				case 3:				
					$this->tables = array('team');
					$this->fields = array('customer');
					$this->conditions = array('AND',"employee = '".$login_user."'");
					$this->query_generate();
					$team_members = $this->query_fetch(2);
					$team_employee_data = '\'' . implode('\', \'', $team_members) . '\'';
					
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','address','post');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1','username = "'.$name.'"');		
					$this->order_by = $condition_value;
                    $this->query_generate();
                    $employee_data = $this->query_fetch();
                    break;
                case 5:	
                case 4:				
					$team_employee_data = '\'' . $login_user . '\'';
					$this->tables = array('customer');
					$this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','address','post');
					$this->conditions = array('AND', array('IN', 'username', $team_employee_data), 'status = 1','username = "'.$name.'"');
					$this->order_by = $condition_value;				
					$this->query_generate();
					$employee_data = $this->query_fetch();
					break;
            }
        }
	
		return !empty($employee_data) ? $employee_data : array();
	}
	
    // Function used to list the all contrats under a particular customer
    function contract_customer($username) {
        $this->tables = array('customer_contract` as `cc', 'customer` as `c');
        $this->fields = array('cc.customer', 'cc.date_from', 'cc.date_to', 'cc.hour', 'cc.id', 'cc.fkkn', 'c.first_name', 'c.last_name', 'c.username' );
        $this->conditions = array('AND', 'cc.customer=c.username', 'cc.customer=?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
	
	function count_cust_employee($year,$custid) {
		$team_members = $this->team_members($login_user);
		$this->tables = array('timetable');
		$this->fields = array('customer');
		$this->conditions = array('AND', 'customer = "'.$custid.'"','status = 1','employee != ""');	

		if($year != '-')
			$this->conditions[] = 'YEAR(date) = '.$year.'';	
		$this->group_by = array('employee','customer');		
		$this->query_generate();
		$employee_data = $this->query_fetch();		
		$totemployee = count($employee_data);
		return $totemployee > 0 ? $totemployee : 0;
	}

    //Function to edit the contract of the customer
    function contract_customer_edit($id) {

        $this->tables = array('customer_contract');
        $this->fields = array('date_from', 'date_to', 'hour');
        $this->field_values = array($this->date_from, $this->date_to, $this->hours);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    //Function to get the values of the customer contract to edit
    function contract_customer_edit_get($id) {

        $this->tables = array('customer_contract');
        $this->fields = array('id', 'customer', 'date_from', 'date_to', 'hour');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    //Function to check wheather the customer contract need to edit or add
    function contract_add_edit_customer_check($id) {
        return !empty($id[1]) ? 'edit' : 'add';
    }

    function contract_customer_add() {

        $this->tables = array('customer_contract',);
        $this->fields = array('customer', 'date_from', 'date_to', 'hour');
        $this->field_values = array($this->user, $this->date_from, $this->date_to, $this->hours);
        $data = $this->query_insert();
        return $data ? TRUE : FALSE;
    }

    function contract_customer_check($val) {

        $this->tables = array('customer_contract');
        $this->fields = array('customer');
        $this->conditions = array('AND', array('OR', '? BETWEEN date_from AND date_to', '?  BETWEEN date_from AND date_to', 'date_from BETWEEN ? AND ?', 'date_to  BETWEEN ? AND ?'), 'customer = ?');
        $this->condition_values = array($this->date_from, $this->date_to, $this->date_from, $this->date_to, $this->date_from, $this->date_to, $this->user);
        if ($val != "") {
            $this->conditions[] = 'id <> ?';
            $this->condition_values[] = $val;
        }
        $this->query_generate();
        return $data ? $data : FALSE;
    }

    function date_difference($fdate, $ldate) {
        return strtotime($ldate) - strtotime($fdate);
    }

    function makeArray($datas = array()) {

        $data_array = array();
        foreach ($datas as $data)
            $data_array[$data['id']] = $data['name'];
        return $data_array;
    }

   	function customer_list($key = NULL) {

        $user = new user();
        $customer_data = array();
        $login_user = $_SESSION['user_id'];
        $login_user_role = $user->user_role($login_user);
        $team_customer_data = 'NULL';
        $team_query = '';
        if ($key == NULL) {
            switch ($login_user_role) {

                case 1:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('status = 1');
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();

                    break;

                case 2:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;

                case 3:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 4:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', 'username = ?', 'status = 1');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 5:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 6:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('status = 1');
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 7:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1');
                    $this->condition_values = array($login_user);
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
            }
        } else {
            switch ($login_user_role) {

                case 1:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();

                    break;

                case 2:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;

                case 3:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 4:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', 'username = ?', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 5:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 6:
                    $this->tables = array('team');
                    $this->fields = array('customer');
                    $this->conditions = array('employee = ?');
                    $this->query_generate();
                    $team_query = $this->sql_query;

                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', array('IN', 'username', $team_query), 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($login_user, $key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();
                    break;
                case 7:
                    $this->tables = array('customer');
                    $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security', 'city', 'phone', 'mobile','status');
                    $this->conditions = array('AND', 'status = 1', array('OR', 'last_name LIKE ?', 'last_name LIKE ?'));
                    $this->condition_values = array($key . "%", strtolower($key) . "%");
                    $this->order_by = array('LOWER(last_name)');
                    $this->query_generate();
                    $customer_data = $this->query_fetch();

                    break;
            }
        }


        if (!empty($customer_data))
            return $customer_data;
        else
            return array();
    }

	//Get temp customer's employees shcdule hours by date
	function temp_get_employee_schedule_by_customer($cust,$date){
		
		$this->tables = array ("SELECT temp_timetable.employee, timetable.time_from, timetable.time_to, 
								CONCAT_WS(', ',temp_timetable.empfname,temp_timetable.emplname) AS empname, 
								TIMESTAMPDIFF(MINUTE,STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_from),'%Y-%m-%d %H.%i'),
								COALESCE(STR_TO_DATE(CONCAT(timetable.date,' ',timetable.time_to),'%Y-%m-%d %H.%i'),
								timetable.date + INTERVAL 1 DAY)) AS totalMinutes FROM temp_timetable 
								INNER JOIN timetable ON temp_timetable.id = timetable.id
								LEFT JOIN employee ON temp_timetable.employee = employee.username  
								WHERE timetable.customer = '".$cust."' AND timetable.date = '".$date."'
								ORDER BY employee.last_name,employee.first_name,timetable.employee,timetable.time_from,timetable.time_to");
		
		$this->query_generate_leftjoin(); 
		$Customer_schedule_date = $this->query_fetch();
		return !empty($Customer_schedule_date) ? $Customer_schedule_date : array();
	}

    function team_employee_customers($username) {

        $this->tables = array('team');
        $this->fields = array('DISTINCT customer AS customer');
        $this->conditions = array('employee = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        $customers_list = array();
        foreach ($datas as $data) {
            $customers_list[] = $data['customer'];
        }
        return $customers_list;
    }

    function team_customers($username) {

        $members_array = $this->team_members($username);
        $members_field_value = '\'' . $username . '\'';
        if (!empty($members_array)) {

            foreach ($members_array as $member) {

                $members_field_value .= ', \'' . $member . '\'';
            }

            $this->tables = array('timetable');
            $this->fields = array('DISTINCT customer AS customer');
            $this->conditions = array('IN', 'employee', $members_field_value);
            $this->query_generate();
            $datas = $this->query_fetch();
            $customers_list = array();
            foreach ($datas as $data) {

                $customers_list[] = $data['customer'];
            }
        } else {

            $this->tables = array('timetable');
            $this->fields = array('DISTINCT customer AS customer');
            $this->conditions = array('employee = ?');
            $this->condition_values = array($username);
            $this->query_generate();
            $datas = $this->query_fetch();
            $customers_list = array();
            foreach ($datas as $data) {

                $customers_list[] = $data['customer'];
            }
        }
        return $customers_list;
    }

    function team_members($username) {

        //getting related customer employees
        $this->tables = array('team');
        $this->fields = array('DISTINCT customer AS customer');
        $this->conditions = array('employee = ?');
        $this->query_generate();
        $sql_customers = $this->sql_query;

        $this->tables = array('team');
        $this->fields = array('DISTINCT employee AS employee');
        $this->conditions = array('IN', 'customer', $sql_customers);
        $this->condition_values = array($username);
        $this->query_generate();
        $datas = $this->query_fetch();
        $members = array();
        foreach ($datas as $data) {

            $members[] = $data['employee'];
        }
        return $members;
    }

    function get_customer_timetable() {

        $this->tables = array('timetable');
        $this->fields = array('username');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : FALSE;
    }

    function login_add() {
        global $preference;
        if ($this->username != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array($this->db_master . '.login');
            if ($this->password != NULL) {
                $this->fields = array('username', 'mobile', 'password', 'role', 'login', 'date');
                $this->field_values = array($this->username, $this->mobile, md5($this->hash . $this->password), $this->role, $this->login, date('Y-m-d'));
            } else {
                $this->fields = array('username', 'mobile', 'role', 'login', 'date');
                $this->field_values = array($this->username, $this->mobile, $this->role, $this->login, date('Y-m-d'));
            }
            return $this->query_insert();
        } else {

            return FALSE;
        }
    }

    function login_update() {
        global $preference;

        if ($this->username != NULL && $this->password != NULL) {
            $this->hash = $preference['hash'];
            $this->tables = array($this->db_master . '.login');
            $this->fields = array('password', 'mobile');
            $this->field_values = array(md5($this->hash . $this->password), $this->mobile);
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            return $this->query_update();
        } elseif ($this->username != NULL) {
            $this->tables = array($this->db_master . '.login');
            $this->fields = array('mobile');
            $this->field_values = array($this->mobile);
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            return $this->query_update();
        } else {
            return true;
        }
    }

    function customer_add() {

        if ($this->username != NULL) {
            $this->tables = array('customer');
            $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'status');
            $this->field_values = array($this->username, $this->century, $this->code, $this->social_security, $this->first_name, $this->last_name, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date, $this->status);
            return $this->query_insert();
        } else {
            return FALSE;
        }
    }

    function customer_relatives_add() {

        if ($this->username != NULL && $this->relative_name != '') {
            $this->tables = array('customer_relative');
            $this->fields = array('customer', 'name', 'relation', 'address', 'city', 'phone', 'work_phone', 'mobile', 'email', 'other');
            $this->field_values = array($this->username, $this->relative_name, $this->relative_relation, $this->relative_address, $this->relative_city, $this->relative_phone, $this->relative_work_phone, $this->relative_mobile, $this->relative_email, $this->relative_other);
            return $this->query_insert();
        } else {

            return FALSE;
        }
    }

    function customer_relatives_update($relative_id) {

        if ($relative_id != '' && $this->relative_name != '') {
            $this->tables = array('customer_relative');
            $this->fields = array('name', 'relation', 'address', 'city', 'phone', 'work_phone', 'mobile', 'email', 'other');
            $this->field_values = array($this->relative_name, $this->relative_relation, $this->relative_address, $this->relative_city, $this->relative_phone, $this->relative_work_phone, $this->relative_mobile, $this->relative_email, $this->relative_other);
            $this->conditions = array('id = ?');
            $this->condition_values = array($relative_id);
            return $this->query_update();
        } else {
            return FALSE;
        }
    }

    function customer_relative_delete($relative_id, $customer_username) {

        if ($relative_id != '' && $customer_username != '') {
            $this->tables = array('customer_relative');
            $this->conditions = array('AND', 'id = ?', 'customer = ?');
            $this->condition_values = array($relative_id, $customer_username);
            return $this->query_delete();
        } else {
            return FALSE;
        }
    }

    function customer_update() {
        if ($this->username != NULL) {
            $this->tables = array('customer');
            $this->fields = array('code', 'century', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'status');
            $this->field_values = array($this->code, $this->century, $this->social_security, $this->first_name, $this->last_name, $this->address, $this->city, $this->post, $this->phone, $this->mobile, $this->email, $this->date, $this->status);
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            return $this->query_update();
        } else {
            return FALSE;
        }
    }

    function company_add() {

        if ($this->username != NULL) {

            $this->tables = array('company');
            $this->fields = array('username', 'name', 'address', 'city', 'post', 'phone', 'mobile', 'email');
            $this->field_values = array($this->username, $this->company_name, $this->company_address, $this->company_city, $this->company_post, $this->company_phone, $this->company_mobile, $this->company_email);
            return $this->query_insert();
        } else {
            return FALSE;
        }
    }

    function company_update() {

        if ($this->username != NULL) {

            $this->tables = array('company');
            $this->fields = array('name', 'address', 'city', 'post', 'phone', 'mobile', 'email');
            $this->field_values = array($this->company_name, $this->company_address, $this->company_city, $this->company_post, $this->company_phone, $this->company_mobile, $this->company_email);
            $this->conditions = array('username = ?');
            $this->condition_values = array($this->username);
            return $this->query_update();
        } else {
            return FALSE;
        }
    }

    function customer_detail($customer_username, $name = NULL) {

        $this->tables = array('customer');
        $this->fields = array('username', 'century', 'code', 'social_security', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date', 'status');
        if ($name != NULL) {
            $this->conditions = array('AND', 'first_name LIKE ?');
            $this->condition_values = array($name . "%");
        } else {
            $this->conditions = array('AND', 'username = ?');
            $this->condition_values = array($customer_username);
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function customer_relatives($customer_username) {

        $this->tables = array('customer_relative');
        $this->fields = array('id', 'name', 'relation', 'address', 'city', 'phone', 'work_phone', 'mobile', 'email', 'other');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function customer_relative_details($relative_id) {

        $this->tables = array('customer_relative');
        $this->fields = array('id', 'name', 'relation', 'address', 'city', 'phone', 'work_phone', 'mobile', 'email', 'other');
        $this->conditions = array('id = ?');
        $this->condition_values = array($relative_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function customer_health($customer_username) {

        $this->tables = array('customer_health');
        $this->fields = array('health_care', 'occupational_therapists', 'physiotherapists', 'other');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function customer_health_add($customer_username) {

        $customer_health = $this->customer_health($customer_username);
        if (!empty($customer_health)) {

            $this->tables = array('customer_health');
            $this->fields = array('health_care', 'occupational_therapists', 'physiotherapists', 'other');
            $this->field_values = array($this->health_care, $this->occupational_therapists, $this->physiotherapists, $this->aiother);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer_username);
            return $this->query_update();
        } else {
            $this->tables = array('customer_health');
            $this->fields = array('customer', 'health_care', 'occupational_therapists', 'physiotherapists', 'other');
            $this->field_values = array($customer_username, $this->health_care, $this->occupational_therapists, $this->physiotherapists, $this->aiother);
            return $this->query_insert();
        }
    }

    function customer_guardian($customer_username) {

        $this->tables = array('customer_guardian');
        $this->fields = array('first_name', 'last_name', 'mobile', 'email');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function customer_guardian_add($customer_username) {

        $customer_guardian = $this->customer_guardian($customer_username);
        if (!empty($customer_guardian)) {

            $this->tables = array('customer_guardian');
            $this->fields = array('first_name', 'last_name', 'mobile', 'email');
            $this->field_values = array($this->guardian_fname, $this->guardian_lname, $this->guardian_mobile, $this->guardian_email);
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer_username);
            return $this->query_update();
        } else {

            $this->tables = array('customer_guardian');
            $this->fields = array('customer', 'first_name', 'last_name', 'mobile', 'email');
            $this->field_values = array($customer_username, $this->guardian_fname, $this->guardian_lname, $this->guardian_mobile, $this->guardian_email);
            return $this->query_insert();
        }
    }

    function customer_attachment_document_sting($customer_username) {

        $this->tables = array('customer_attachment');
        $this->fields = array('documents');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = $datas[0]['documents'];
        return $documents_str;
    }

    function attachment_array($documents_array) {

        $documents = array();
        if (!empty($documents_array)) {
            foreach ($documents_array as $document) {

                $extension = $this->get_file_extension($document);
                if ($extension == "odt") {

                    $icon = "open.jpg";
                } else if ($extension == "pdf") {

                    $icon = "pdf.jpg";
                } else {

                    $icon = "word.jpg";
                }
                if (strlen($document) >= 20) {
                    $filename = substr($document, 0, 20) . '...';
                } else {
                    $filename = $document;
                }
                $documents[] = array('file' => $document, 'name' => $filename, 'icon' => $icon);
            }
        }
        return $documents;
    }

    function customer_attachment_documents($customer_username) {

        $this->tables = array('customer_attachment');
        $this->fields = array('documents');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer_username);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = $datas[0]['documents'];
        if ($documents_str != '') {

            $documents = array();
            $documents_array = explode(',', $documents_str);
            foreach ($documents_array as $document) {

                $extension = $this->get_file_extension($document);
                if ($extension == "odt") {

                    $icon = "open.jpg";
                } else if ($extension == "pdf") {

                    $icon = "pdf.jpg";
                } else {

                    $icon = "word.jpg";
                }
                if (strlen($document) >= 20) {
                    $filename = substr($document, 0, 20) . '...';
                } else {
                    $filename = $document;
                }
                $documents[] = array('file' => $document, 'name' => $filename, 'icon' => $icon);
            }

            return $documents;
        } else {
            return FALSE;
        }
    }

    function customer_attachment_documents_add($customer_username, $documents) {

        if (!empty($documents)) {

            $document = implode(',', $documents);
            $this->tables = array('customer_attachment');
            $this->fields = array('documents');
            $this->conditions = array('customer = ?');
            $this->condition_values = array($customer_username);
            $this->query_generate();
            $datas = $this->query_fetch();

            if (!empty($datas[0])) {
                $this->tables = array('customer_attachment');
                $this->fields = array('documents');
                $this->field_values = array($document);
                $this->conditions = array('customer = ?');
                $this->condition_values = array($customer_username);
                return $this->query_update();
            } else {

                $this->tables = array('customer_attachment');
                $this->fields = array('customer', 'documents');
                $this->field_values = array($customer_username, $document);
                return $this->query_insert();
            }
        } else {
            return TRUE;
        }
    }

    function get_available_works() {
        return array();
    }

    function get_assigned_works() {

        $this->tables = array('work');
        $this->fields = array('id', 'name');
        $this->conditions = array('AND', array('IN', 'id', $this->works));
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_available_team() {

        $this->tables = array('work');
        $this->fields = array('id', 'name');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function get_work_details($id) {

        $this->tables = array('work');
        $this->fields = array('name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return !empty($data) ? $data[0]['name'] : FALSE;
    }

    function customer_work($username) {

        $this->tables = array('customer');
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
        } else
            return FALSE;
    }

    function work_common($customer_username, $employee_username) {

        $employee = new employee();
        $customer_works = $this->customer_work($customer_username);
        $employee_works = $employee->employee_work($employee_username);
        if ($customer_works && $employee_works) {

            $works = array_intersect($customer_works, $employee_works);
            $work_det = array();
            if (!empty($works)) {

                foreach ($works as $work) {
                    if ($work['id'])
                        $work_det[] = array('id' => $work['id'], 'name' => $this->get_work_details($work['id']));
                }
                return $work_det;
            } else 
                return FALSE;
        } else 
            return FALSE;
    }

    /* ------------------------------------------------shaju----------------------- */

    //removing customer from a particular slot
    function remove_from_slot($id, $alloc_emp) {

        $this->tables = array('timetable');
        $this->fields = array('customer', 'status', 'alloc_emp');
        $this->field_values = array(NULL, '0', $alloc_emp);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    //getting slots in memory
    function get_memory_slots($customer, $date) {

        $this->tables = array('memory_slots');
        $this->fields = array('time_from', 'time_to', 'id');
        $this->conditions = array('customer = ?');
        $this->condition_values = array($customer);
        $this->order_by = array('time_from', 'time_to');
        $this->query_generate();
        $datas = $this->query_fetch();
        $memory_slots = array();
        foreach ($datas as $free_slots) {
            $memory_flag = true;
            $memory_slots[] = array('id' => $free_slots['id'], 'time_from' => $free_slots['time_from'], 'time_to' => $free_slots['time_to']);
        }
        return $memory_slots;
    }

    //Adding customer memory slot
    function add_memory_slot($customer, $time_from, $time_to) {
        $this->tables = array('memory_slots');
        $this->fields = array('id');
        $this->conditions = array('AND', 'customer=?', 'time_from=?', 'time_to=?');
        $this->condition_values = array($customer, $time_from, $time_to);
        $this->query_generate();
        $datas = $this->query_fetch();
        if (count($datas) == 0) {
            $this->tables = array('memory_slots');
            $this->fields = array('customer', 'time_from', 'time_to');
            $this->field_values = array($customer, $time_from, $time_to);
            return $this->query_insert();
        }
    }

    //removing memory slot
    function remove_memory_slot($id) {
        $this->tables = array('memory_slots');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_delete();
    }

    function customer_contract_week($customer, $year_week, $fkkn = NULL) {

//calculating start date and end date
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $this->tables = array('customer_contract');
        $this->fields = array('id');
        $this->conditions = array('AND', 'customer = ?', 'date_to >= ?');
        $this->query_generate();
        $query_inner = $this->sql_query;
        $this->tables = array('customer_contract');
        $this->fields = array('date_from', 'date_to', 'DATEDIFF(date_to,date_from) AS days', 'hour');
        if ($fkkn != NULL || $fkkn != '') {
            if($fkkn == 1)
            $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', 'fkkn = ?', array('IN', 'id', $query_inner));
            elseif($fkkn == 2)
                $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('OR','fkkn = ?','fkkn = 3'), array('IN', 'id', $query_inner));
            elseif($fkkn == 3)
                $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('OR','fkkn = ?','fkkn = 2'), array('IN', 'id', $query_inner));
            $this->condition_values = array($customer, $end_date, $fkkn, $customer, $start_date);
        } else {

            $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
            $this->condition_values = array($customer, $end_date, $customer, $start_date);
        }
        $this->order_by = array('date_from');
        $this->query_generate();
        $contract_data = $this->query_fetch(1);
        return !empty($contract_data) ? $contract_data : FALSE;
    }

    function customer_contract_week_hour($customer, $year_week, $fkkn = NULL) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $customer_contracts = $this->customer_contract_week($customer, $year_week, $fkkn);
        if ($customer_contracts) {
            //getting customer contacts
            $contract_hour_week = 0;
            $week_days = 7;
            foreach ($customer_contracts as $customer_contract) {

                $contract_hour_day = round(($customer_contract['hour'] / ($customer_contract['days'] + 1)), 2);
                if (strtotime($end_date) > strtotime($customer_contract['date_to'])) {

                    $day_before = (((strtotime($customer_contract['date_to']) - strtotime($start_date)) / (24 * 60 * 60)) + 1);
                    $week_days -= $day_before;
                    $contract_hour_week += ($day_before * $contract_hour_day);
                } else if (strtotime($start_date) < strtotime($customer_contract['date_from'])) {

                    $contract_hour_week += ($week_days * $contract_hour_day);
                } else {

                    $contract_hour_week = $contract_hour_day * $week_days;
                }
            }
            return round($contract_hour_week, 2);
        } else 
            return 0;
    }

    function customer_timetable_week_time($customer, $year_week, $fkkn = NULL) {

        global $week;
        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);
        $total_alloc_time = 0;
        $date_from = date("Y-m-d", strtotime($year . 'W' . $week_no . 1));
        $date_to = date("Y-m-d", strtotime($year . 'W' . $week_no . 7));

        //excluding trainee sloats
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username');
        $this->conditions = array('role != 5');
        $this->query_generate();
        $sql_not_trainee = $this->sql_query;

        //getting time for the week sloat type include normal,travel,break
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {
            if($fkkn == 1)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,7'), array('IN', 'employee', $sql_not_trainee));
            elseif($fkkn == 2)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 3','fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,7'), array('IN', 'employee', $sql_not_trainee));
            elseif($fkkn == 3)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 2','fkkn = ?'), array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,7'), array('IN', 'employee', $sql_not_trainee));
            $this->condition_values = array($customer, $date_from, $date_to, $fkkn);
        } else {

            //$this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'), array('IN', 'type', '0,4,5,6,7'), array('IN', 'employee', $sql_not_trainee));
            //
            //For showing tatal time allotted to customers in grundschema.php
            $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1,3'));
            $this->condition_values = array($customer, $date_from, $date_to);
        }
        $this->query_generate();
        $data_time = $this->query_fetch();
        $time_data = $data_time[0];
        $normal_time = $time_data['total_time'];

        //getting time for the week sloat type oncall
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2) AS total_time');
        if ($fkkn != NULL && $fkkn != '') {
            if($fkkn == 1)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), 'fkkn = ?', array('IN', 'status', '1'), 'type = 3', array('IN', 'employee', $sql_not_trainee));
            elseif($fkkn == 2)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 3','fkkn = ?'), array('IN', 'status', '1'), 'type = 3', array('IN', 'employee', $sql_not_trainee));
            elseif($fkkn == 3)
                $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('OR','fkkn = 2','fkkn = ?'), array('IN', 'status', '1'), 'type = 3', array('IN', 'employee', $sql_not_trainee));
            $this->condition_values = array($customer, $date_from, $date_to, $fkkn);
         /*else {

            $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '1'), 'type = 3', array('IN', 'employee', $sql_not_trainee));
            $this->condition_values = array($customer, $date_from, $date_to);
        }*/
	        $this->query_generate();
	        $data_time = $this->query_fetch();
	        $time_data = $data_time[0];
	        $oncall_time = 0;
	        if ($time_data['total_time'] != '' && $time_data['total_time'] > 0) {
	            $oncall_time = round(($time_data['total_time'] / 4), 2);
	        }

	        $total_time = $normal_time + $oncall_time;
        }else{
            $total_time = $normal_time;
        }
        return sprintf("%.02f", $total_time);
    }

    // get available customers 
    function get_available_customers($employee, $date) {
        $cur_date = strtotime($date . ' 00:00:00');

        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('employee=?');
        //$this->condition_values = array($time_from, $time_to, $time_from,$time_to,$time_from,$time_to,$date);
        $this->query_generate();
        $cust_query = $this->sql_query;
        if ($_SESSION['user_role'] == 4) {
            $cust_query = "'" . $_SESSION['user_id'] . "'";
        }

        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name', 'code');
        $this->conditions = array('AND', 'status=1', array('IN', 'username', $cust_query));
        if ($_SESSION['user_role'] != 4) {
            $this->condition_values = array($employee);
        }
        $this->query_generate();
        $datas = $this->query_fetch();
        $customers = array();
        foreach ($datas as $data) {
            $contract_hour = $this->customer_contract_week_hour($data['username'], date('Y', $cur_date) . '|' . date('W', $cur_date));
            $worked_hour = $this->customer_timetable_week_time($data['username'], date('Y', $cur_date) . '|' . date('W', $cur_date));
            $customers[] = array('username' => $data['username'], 'name' => $data['first_name'] . ' ' . $data['last_name'], 'code' => $data['code'], 'contract_hour' => $contract_hour, 'worked_hour' => $worked_hour);
        }
        return count($customers) ? $customers : FALSE;
    }

    //adding customer to a slot
    function customer_add_to_slot($id, $select_cust, $alloc_emp) {

        $slot_det = $this->customer_employee_slot_details($id);
        $status = $slot_det['status'];

        if ($status != 3 && $slot_det['employee'] != '')
            $status = 1;
        $this->tables = array('timetable');
        $this->fields = array('status', 'customer', 'alloc_emp');
        $this->field_values = array($status, $select_cust, $alloc_emp);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    // details of a particular slot
    function customer_employee_slot_details($id) {

        $this->tables = array('timetable');
        $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to', 'status', 'type', 'fkkn', 'alloc_emp', '(SELECT first_name FROM customer where username = timetable.customer) AS cust_first_name', '(SELECT last_name FROM customer where username = timetable.customer) AS cust_last_name', '(SELECT first_name FROM employee where username = timetable.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = timetable.employee) AS emp_last_name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $slot = $datas[0];
        $result = array('id' => $slot['id'], 'employee' => $slot['employee'], 'customer' => $slot['customer'], 'date' => $slot['date'], 'slot' => $slot['time_from'] . '-' . $slot['time_to'], 'slot_hour' => $this->time_difference($slot['time_from'], $slot['time_to']), 'status' => $slot['status'], 'type' => $slot['type'], 'fkkn' => $slot['fkkn'], 'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 'emp_name' => $slot['emp_first_name'] . ' ' . $slot['emp_last_name'], 'alloc_emp' => $slot['alloc_emp']);
        return $result;
    }

    /* ----------------------------------------shaju---------------------------- */

    function get_customer_allocation($user, $start_date, $end_date) {

        $this->tables = array('customer_contract');
        $this->fields = array('id');
        $this->conditions = array('AND', 'customer = ?', 'date_to >= ?');
        $this->order_by = array('date_from');
        $this->query_generate();
        $query_inner = $this->sql_query;

        $this->tables = array('customer_contract');
        $this->fields = array('id', 'date_from', 'date_to', 'DATEDIFF(date_to,date_from)', 'hour');
        $this->conditions = array('AND', 'customer = ?', 'date_from <= ?', array('IN', 'id', $query_inner));
        $this->condition_values = array($user, $end_date, $user, $start_date);
        $this->order_by = array('date_from');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : FALSE;
    }

    function get_customer_weekly_allocation($user) {

        $this->tables = array('timetable');
        $this->fields = array('date', 'WEEKOFYEAR(date)', 'DAYNAME(date)', 'time_from', 'time_to');
        $this->conditions = array('AND', 'customer = ?', 'status = \'1\'');
        $this->condition_values = array($user);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : FALSE;
    }

    function customer_to_allocate($year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));

        $customers = $this->customer_list();
        $customer_pending = array();

        foreach ($customers as $customer) {


            //getting customer contacts for fk
            $contract_hour_week_fk = $this->customer_contract_week_hour($customer['username'], $year_week, 1); //echo $contract_hour_week_fk . "<br/>";
            //getting customer contacts for kn
            $contract_hour_week_kn = $this->customer_contract_week_hour($customer['username'], $year_week, 2); //echo $contract_hour_week_kn . "<br/>";
            //getting customer allocated time for fk
            $timetable_hour_week_fk = $this->customer_timetable_week_time($customer['username'], $year_week, 1); //echo $timetable_hour_week_fk . "<br/>";
            //getting customer allocated time for kn
            $timetable_hour_week_kn = $this->customer_timetable_week_time($customer['username'], $year_week, 2); //echo $timetable_hour_week_kn . "<br/>";
            //echo $customer['username'].'-'.$contract_hour_week.'-'.$timetable_hour_week;
            if ($contract_hour_week_fk > $timetable_hour_week_fk || $contract_hour_week_kn > $timetable_hour_week_kn) {

                $customer_name = $customer['first_name'] . ' ' . $customer['last_name'];
                $customer_pending[] = array('username' => $customer['username'], 'name' => $customer_name, 'fk' => array('allocate' => $contract_hour_week_fk, 'allocated' => $timetable_hour_week_fk), 'kn' => array('allocate' => $contract_hour_week_kn, 'allocated' => $timetable_hour_week_kn));
            }
        }
        return count($customer_pending) ? $customer_pending : FALSE;
    }

    function customer_data($username) {

        $this->tables = array('customer');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'social_security');
        $this->conditions = array('username = ?');
        $this->condition_values = array($username);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function get_week() {

        global $week;
        return$week;
    }

    function customer_week_employee($customer, $year_week) {
        
        if($_SESSION['company_sort_by'] == 1)
            $condition_value = array('LOWER(first_name)');
        elseif($_SESSION['company_sort_by'] == 2)
            $condition_value = array('LOWER(last_name)');
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
        $this->order_by = $condition_value;
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    /* --------------------------Shamsu----------------------------- */

    function customer_report($customer, $year, $month) {

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2)');
        $this->conditions = array('AND', 'type = 0', 'employee like e1', 'date like d1', 'work like w1', 'customer like ?', 'status=1');
        $this->query_generate();
        $query_type0 = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2)');
        $this->conditions = array('AND', 'type = 1', 'employee like e1', 'date like d1', 'work like w1', 'customer like ?', 'status=1');
        $this->query_generate();
        $query_type1 = $this->sql_query;

        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2)');
        $this->conditions = array('AND', 'type = 2', 'employee like e1', 'date like d1', 'work like w1', 'customer like ?', 'status=1');
        $this->query_generate();
        $query_type2 = $this->sql_query;


        $this->tables = array('timetable` as `t', 'work', 'employee');
        $this->fields = array('t.date as d1', 't.work as w1', 'work.name as w_name', 't.employee as e1', 'employee.first_name as emp_name', '(' . $query_type0 . ') as t0', '(' . $query_type1 . ') as t1', '(' . $query_type2 . ') as t2');
        $this->conditions = array('AND', 't.customer like ?', 'month(t.date)= ?', 'year(t.date)= ?', 't.status=1', 'work.id=t.work', 'employee.username like t.employee');
        $this->condition_values = array($customer, $customer, $customer, $customer, $month, $year);
        $this->group_by = array('t.date', 't.employee', 't.work');
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas;
    }

    function distinct_customers() {
        $this->tables = array('customer');
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

    function Customer_pdf_report($dataset, $cust_name, $month, $year, $r_heading, $r_sub_head, $col_heading, $total_cap) {
        $pdf = new PDF();
        //$header = array('Date', 'Work', 'Employee', 'Normal', 'Travel', 'Break', 'Total Hour');
        $pdf->AddPage();
        //$pdf->SetFont('Arial','I',8); 
        $pdf->report_Header($r_heading);
        $pdf->SubHeading($r_sub_head, $cust_name, $month, $year);
        $pdf->FancyTable($col_heading, $dataset, $total_cap);
        //$pdf->Footer();
        $pdf->Output();
    }

    function employee_social_security_check($social_security) {

        $this->tables = array($this->db_master . '.login');
        $this->fields = array('company_ids');
        $this->conditions = array('social_security = ?');
        $this->condition_values = array($social_security);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0]['company_ids'] ? $datas[0]['company_ids'] : FALSE;
    }

    function get_company_db($company_id) {

        $this->tables = array('' . $this->db_master . '.company');
        $this->fields = array('db_name');
        $this->conditions = array('id = ?');
        $this->condition_values = array($company_id);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0]['db_name'];
    }

    function get_employee_detail($db, $social_security) {

        $this->tables = array('' . $db . '.employee');
        $this->fields = array('username', 'code', 'first_name', 'last_name', 'address', 'city', 'post', 'phone', 'mobile', 'email', 'date');
        $this->conditions = array('social_security = ?');
        $this->condition_values = array($social_security);
        $this->query_generate();
        $datas = $this->query_fetch();
        return $datas[0];
    }

    function get_all_issue_data($customer, $year, $month) {
        $this->tables = array('customer_equipment');
        $this->fields = array('id', 'equipment', 'serial_number', 'issue_date', 'return_date');
        $this->conditions = array('AND', 'customer = ?', 'month(issue_date) = ?', 'year(issue_date) = ?');
        $this->condition_values = array($customer, $month, $year);
        $this->order_by = array('id DESC');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_equipments() {
        $this->tables = array('customer_equipment');
        $this->fields = array('distinct(equipment)');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_serial_number() {
        $this->tables = array('customer_equipment');
        $this->fields = array('distinct(serial_number)');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function add_equipment_issue($type, $name, $num, $issue, $return, $customer, $employee = NULL, $id=NULL) {
       
        $issue_date = date('Y-m-d', strtotime($issue));
        $return_date = date('Y-m-d', strtotime($return));
        if ($type == 1) {
            $this->tables = array('customer_equipment');
            $this->fields = array('equipment', 'customer', 'employee', 'issue_date', 'return_date', 'serial_number');
            $this->field_values = array($name, $customer, $employee, $issue_date, $return_date, $num);
            return $this->query_insert();
        }
        else if ($type == 2) {

            $this->tables = array('customer_equipment');
            $this->fields = array('equipment', 'customer', 'issue_date', 'return_date', 'serial_number');
            $this->field_values = array($name, $customer, $issue_date, $return_date, $num);
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            return $this->query_update();
        }
    }

    function customer_view() {
        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_dates_equipments() {
        $this->tables = array('customer_documentation');
        $this->fields = array('id', 'created_date');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_documentation_date($id) {

        $this->tables = array('customer_documentation');
        $this->fields = array('id', 'created_date', 'customer', 'employee', 'completed_date', 'subject', 'note_type', 'notes', 'priority', 'description', 'status');
        $this->conditions = array('AND', 'id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function insert_documentation() {
        $created_date = date('Y-m-d H:i:s', strtotime($this->issue_date));
        $complete_date = date('Y-m-d H:i:s', strtotime($this->return_date));
        $this->tables = array('customer_documentation');
        $this->fields = array('created_date', 'customer', 'employee', 'completed_date', 'subject', 'note_type', 'notes', 'priority', 'description', 'status');
        $this->field_values = array($created_date, $this->customer, $this->employee, $complete_date, $this->subject, $this->note_type, $this->notes, $this->priority, $this->description, $this->status);
        return $this->query_insert();
    }

    function edit_documentation($id) {
        $created_date = date('Y-m-d H:i:s', strtotime($this->issue_date));
        $complete_date = date('Y-m-d H:i:s', strtotime($this->return_date));
        $this->tables = array('customer_documentation');
        $this->fields = array('created_date', 'customer', 'employee', 'completed_date', 'subject', 'note_type', 'notes', 'priority', 'description', 'status');
        $this->field_values = array($created_date, $this->customer, $this->employee, $complete_date, $this->subject, $this->note_type, $this->notes, $this->priority, $this->description, $this->status);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function get_dates_customer_work() {
        $this->tables = array('customer_work');
        $this->fields = array('id', 'date');
        $this->query_generate();
        return $this->query_fetch();
    }

    function get_customer_works_date($id) {
        $this->tables = array('customer_work');
        $this->fields = array('id', 'customer', 'date', 'work', 'history', 'clinical_picture', 'medications', 'devolution', 'special_diet');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        return $this->query_fetch();
    }

    function insert_work_customer() {
        $date = date('Y-m-d');
        $this->tables = array('customer_work');
        $this->fields = array('customer', 'date', 'work', 'history', 'clinical_picture', 'devolution', 'medications', 'special_diet');
        $this->field_values = array($this->customer, $date, $this->work, $this->history, $this->clinical_picture, $this->devolution, $this->medications, $this->special_diet);
        return $this->query_insert();
    }

    function edit_work_customer($id) {
        $this->tables = array('customer_work');
        $this->fields = array('customer', 'work', 'history', 'clinical_picture', 'devolution', 'medications', 'special_diet');
        $this->field_values = array($this->customer, $this->work, $this->history, $this->clinical_picture, $this->devolution, $this->medications, $this->special_diet);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function get_date_period($customer, $fkkn) {
        $this->tables = array('customer_contract');
        $this->fields = array('id', 'date_from', 'date_to', 'customer');
        $this->conditions = array('AND', 'customer = ?', 'fkkn = ?');
        $this->condition_values = array($customer, $fkkn);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }

    function get_ful_contract_detail($id) {
        $result = array();
        $data = array();
        $this->tables = array('customer_contract');
        $this->fields = array('id', 'date_from', 'date_to', 'hour', 'fkkn');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data1 = $this->query_fetch();

        $this->tables = array('customer_contract_billing');
        $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'awake', 'oncall2', 'something', 'comments', 'iss', 'sol');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data2 = $this->query_fetch();

        $this->tables = array('customer_contract_decision');
        $this->fields = array('first_name AS first', 'last_name AS last', 'mobile AS mob', 'email AS mail', 'city AS cities', 'comments_time', 'comments_other', 'documents');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data3 = $this->query_fetch();

        $result[0] = array('id' => $data1[0]['id'], 'date_from' => $data1[0]['date_from'], 'date_to' => $data1[0]['date_to'], 'hour' => $data1[0]['hour'], 'fkkn' => $data1[0]['fkkn'],
            'first_name' => $data2[0]['first_name'], 'last_name' => $data2[0]['last_name'], 'mobile' => $data2[0]['mobile'], 'email' => $data2[0]['email'], 'city' => $data2[0]['city'], 'oncall' => $data2[0]['oncall'], 'awake' => $data2[0]['awake'], 'oncall2' => $data2[0]['oncall2'], 'something' => $data2[0]['something'], 'comments' => $data2[0]['comments'], 'iss' => $data2[0]['iss'], 'sol' => $data2[0]['sol'],
            'first' => $data3[0]['first'], 'last' => $data3[0]['last'], 'mob' => $data3[0]['mob'], 'mail' => $data3[0]['mail'], 'cities' => $data3[0]['cities'], 'comments_time' => $data3[0]['comments_time'], 'comments_other' => $data3[0]['comments_other'], 'documents' => $data3[0]['documents']
        );

        return $result;
    }

    function customer_decision_document_string($id) {

        $this->tables = array('customer_contract_decision');
        $this->fields = array('documents');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = $datas[0]['documents'];
        return $documents_str;
    }

    function customer_decision_documents($id) {

        $this->tables = array('customer_contract_decision');
        $this->fields = array('documents');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $datas = $this->query_fetch();
        $documents_str = $datas[0]['documents'];

        if ($documents_str != '') {

            $documents = array();
            $documents_array = explode(',', $documents_str);
            foreach ($documents_array as $document) {

                $extension = $this->get_file_extension($document);
                if ($extension == "odt") {

                    $icon = "open.jpg";
                } else if ($extension == "pdf") {

                    $icon = "pdf.jpg";
                } else {

                    $icon = "word.jpg";
                }
                if (strlen($document) >= 20) {
                    $filename = substr($document, 0, 20) . '...';
                } else {
                    $filename = $document;
                }
                $documents[] = array('file' => $document, 'name' => $filename, 'icon' => $icon);
            }
            return $documents;
        } else 
            return FALSE;
    }

    function get_file_extension($file) {

        $extension = substr(strrchr($file, '.'), 1);
        return $extension;
    }

    function add_customer_contract($user, $hours, $fromdate, $todate, $fkkn) {
        $from = date('Y-m-d', strtotime($fromdate));
        $to = date('Y-m-d', strtotime($todate));
        $this->tables = array('customer_contract');
        $this->fields = array('hour', 'date_from', 'date_to', 'fkkn', 'customer');
        $this->field_values = array($hours, $from, $to, $fkkn, $user);
        $data = $this->query_insert();
        $id = $this->get_id();
        return $data ? $id : FALSE;
    }

    function customer_contract_billing_insert($id, $fkkn) {
        $this->tables = array('customer_contract_billing');
        if ($fkkn == 2) {
            $this->fields = array('contract_id', 'first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'oncall2', 'awake', 'something', 'iss', 'sol');
            $this->field_values = array($id, $this->b_fname, $this->b_lname, $this->b_mobile, $this->b_email, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something, $this->b_iss, $this->b_sol);
        } else {
            $this->fields = array('contract_id', 'first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'oncall2', 'awake', 'something');
            $this->field_values = array($id, $this->b_fname, $this->b_lname, $this->b_mobile, $this->b_email, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something);
        }
        return $this->query_insert();
    }

    function customer_contract_decision_insert($id) {

        $this->tables = array('customer_contract_decision');
        $this->fields = array('contract_id', 'first_name', 'last_name', 'mobile', 'email', 'city', 'comments_time', 'comments_other', 'documents');
        $this->field_values = array($id, $this->d_fname, $this->d_lname, $this->d_mobile, $this->d_email, $this->d_city, $this->d_comment_time, $this->d_comment_other, $this->d_document);
        //$this->conditions = array('contract_id')
        return $this->query_insert();
    }

    function customer_contract_update($id, $hours, $fromdate, $todate, $fkkn) {

        $from = date('Y-m-d', strtotime($fromdate));
        $to = date('Y-m-d', strtotime($todate));
        $this->tables = array('customer_contract');
        $this->fields = array('hour', 'date_from', 'date_to', 'fkkn');
        $this->field_values = array($hours, $from, $to, $fkkn);
        $this->conditions = array('id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function customer_contract_billing_update($id, $fkkn) {

        $this->tables = array('customer_contract_billing');
        if ($fkkn == 2) {
            $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'oncall2', 'awake', 'something', 'iss', 'sol');
            $this->field_values = array($this->b_fname, $this->b_lname, $this->b_mobile, $this->b_email, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something, $this->b_iss, $this->b_sol);
        } else {
            $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'city', 'oncall', 'oncall2', 'awake', 'something');
            $this->field_values = array($this->b_fname, $this->b_lname, $this->b_mobile, $this->b_email, $this->b_city, $this->b_oncall, $this->b_oncall2, $this->b_awake, $this->b_something);
        }

        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function customer_contract_decision_update($id) {

        $this->tables = array('customer_contract_decision');

        $this->fields = array('first_name', 'last_name', 'mobile', 'email', 'city', 'comments_time', 'comments_other', 'documents');
        $this->field_values = array($this->d_fname, $this->d_lname, $this->d_mobile, $this->d_email, $this->d_city, $this->d_comment_time, $this->d_comment_other, $this->d_document);
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function add_new_documents($file_new, $id) {

        $this->tables = array('customer_contract_decision');
        $this->fields = array('documents');
        $this->field_values = array($file_new);
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        return $this->query_update();
    }

    function check_trainee_employee($employee) {
        $this->tables = array($this->db_master . '.login');
        $this->fields = array('username', 'role');
        $this->conditions = array('username = ?');
        $this->condition_values = array($employee);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['role'] == 5 ? FALSE : TRUE;
    }

    function get_timetable_customer($customer, $from_date, $to_date, $current, $fkkn) {
        $this->tables = array('timetable');

        $this->fields = array('customer', 'date', 'time_from', 'time_to', 'type', 'employee');
        $this->conditions = array('AND', 'date BETWEEN ? AND ?', 'fkkn = ?', 'customer = ?', 'type <> 1', 'type <> 2', 'type <> 7');
        $this->condition_values = array($from_date, $to_date, $fkkn, $customer);
        $this->query_generate();
        $data = $this->query_fetch();
        $oncall_time = "0.00";
        $result = "0.00";
        for ($i = 0; $i < count($data); $i++) {
            if ($this->check_trainee_employee($data[$i]['employee'])) {
                if ($data[$i]['type'] == 3) {
                    $oncall_time = $this->time_sum($oncall_time, $this->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                } else {
                    $result = $this->time_sum($result, $this->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
                }
            }
        }
        $time_oncall = $this->time_divide($oncall_time, 4);
        $result = $this->time_sum($result, $time_oncall);
        return $result;
    }

    function time_difference($t1, $t2, $mod=60) {
        $a1 = explode(".", $t1);
        $a2 = explode(".", $t2);
        $time1 = ((intval($a1[0]) * 60 * 60) + intval((str_pad($a1[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $time2 = ((intval($a2[0]) * 60 * 60) + intval((str_pad($a2[1], 2, '0', STR_PAD_RIGHT)) * 60));
        $diff = abs($time1 - $time2);
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        if($mod == 100)
            $mins = round($mins*100/60);
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

    function time_divide($t1, $t2) {
        $a1 = explode(".", $t1);
        $time1 = (($a1[0] * 60 * 60) + (str_pad($a1[1], 2, '0', STR_PAD_RIGHT) * 60));
        $div = floor($time1 / $t2);
        $hours = floor($div / (60 * 60));
        $mins = floor(($div - ($hours * 60 * 60)) / (60));
        $result = $hours . "." . $mins;
        return $result;
    }

    function customer_id_present_decision($id) {

        $this->tables = array('customer_contract_decision');
        $this->fields = array('contract_id');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? TRUE : FALSE;
    }

    function customer_id_present_billing($id) {

        $this->tables = array('customer_contract_billing');
        $this->fields = array('contract_id');
        $this->conditions = array('contract_id = ?');
        $this->condition_values = array($id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? TRUE : FALSE;
    }

    function oncall_customer($customer, $from, $to) {
        $this->tables = array('timetable');

        $this->fields = array('customer', 'date', 'time_from', 'time_to');
        $this->conditions = array('AND', 'date BETWEEN ? AND ?', 'customer = ?', 'type = 3', 'status = 1');
        $this->condition_values = array($from, $to, $customer);
        $this->query_generate();
        $data = $this->query_fetch();
        $result = "0.00";
        for ($i = 0; $i < count($data); $i++) {
            $result = $this->time_sum($result, $this->time_difference($data[$i]['time_to'], $data[$i]['time_from']));
        }

        return $result;
    }

    function customer_of_employee($emp) {
        $this->tables = array('team');
        $this->fields = array('customer');
        $this->conditions = array('AND', 'employee = ?', 'customer <> ""');
        $this->condition_values = array($emp);
        $this->query_generate();
        $data = $this->query_fetch();

        $this->tables = array('customer');
        $this->fields = array('username', 'first_name', 'last_name');
        $this->query_generate();
        $data1 = $this->query_fetch();
        $result = array();
        if ($data) {
            for ($i = 0; $i < count($data); $i++) {
                $resut[$i]['username'] = $data[$i]['customer'];
                for ($j = 0; $j < count($data1); $j++) {
                    if ($data[$i]['customer'] == $data1[$j]['username']) {
                        $result[$i]['name'] = $data1[$j]['first_name'] . $data1[$j]['last_name'];
                    }
                }
            }
            return $result;
        } else
            return false;
    }

    function get_folder_name($compony_id) {
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('upload_dir');
        $this->conditions = array('id = ?');
        $this->condition_values = array($compony_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['upload_dir'];
    }

    function get_company_detail($compony_id) {
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('id', 'name', 'db_name', 'language', 'logo', 'org_no', 'address', 'email', 'phone', 'mobile', 'website', 'contact_person1', 'contact_person1_email', 'contact_person2', 'contact_person2_email', 'upload_dir', 'status');
        $this->conditions = array('id = ?');
        $this->condition_values = array($compony_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0] : FALSE;
    }

    function mobile_users($mobile_num, $ids) {
        $this->tables = array('customer');
        $this->fields = array('mobile');
        $this->conditions = array('AND', 'username <> ?', 'mobile = ?');
        $this->condition_values = array($ids, $mobile_num);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : FALSE;
    }
    
    /******************************shamsu start***************************/
    
    function non_allocated_customers($year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));
        $customers = $this->customer_list();
        
        $list_customers = array();
        foreach ($customers as $customer) {
            $list_customers[] = $customer['username'];
        }
        $filtered_customer_list =  '\''. implode('\' , \'', $list_customers). '\'';
        $this->tables = array('timetable');
        $this->fields = array('DATE_FORMAT(date, \'%x|%v\')');
        $this->conditions = array('AND', 'customer like t.customer', 'date <= ?', 'employee IS NULL','status != 2');
        $this->order_by = array('customer', 'date');
        $this->limit = 1;
        $this->query_generate();
        $sub_query = $this->sql_query;
        
        $this->tables = array('timetable` AS `t', 'customer` AS `c');
        $this->fields = array('ROUND(SUM(CAST(t.time_to - t.time_from AS UNSIGNED) + ((t.time_to - t.time_from) - CAST(t.time_to - t.time_from AS unsigned))/60*100),2) as total_hours', 't.customer as customer_id', '('. $sub_query .') AS first_date', 'concat(c.first_name, " ", c.last_name) as customer_name');
        $this->conditions = array('AND', array('IN','t.customer', $filtered_customer_list), 't.date <= ?', 't.employee IS NULL', 'c.username like t.customer','t.status != 2');
        $this->order_by = array('t.customer', 't.date');
        $this->group_by = array('t.customer');
        $this->condition_values = array($end_date,$end_date);
        $this->limit = 0;
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : FALSE;
    }
    
    
    function total_work_hours_for_customers_in_single_week($customer, $year_week) {

        $week_data = explode('|', $year_week);
        $year = $week_data[0];
        $week_no = sprintf("%02d", $week_data[1]);

        $start_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '1'));
        $end_date = date("Y-m-d", strtotime($year . 'W' . $week_no . '7'));
        
        $this->tables = array('timetable');
        $this->fields = array('ROUND(SUM(CAST(time_to - time_from AS UNSIGNED) + ((time_to - time_from) - CAST(time_to - time_from AS unsigned))/60*100),2) as total_hours');
        $this->conditions = array('AND', 'customer = ?', array('BETWEEN', 'date', '?', '?'),'status != 2');
        $this->condition_values = array($customer, $start_date, $end_date);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['total_hours'] != "" ? $data[0]['total_hours'] : 0;
    }
    
    
    /******************************shamsu end***************************/
	
	function get_filter_date_report($customer,$fdate,$tdate,$per) {  //-//
	
		//Calculating for Used FK      	
		$this->sql_query = "SELECT SUM(time_to-time_from) AS fk_sum FROM timetable WHERE DATE BETWEEN '$fdate' AND '$tdate' AND customer='$customer' AND fkkn='1' GROUP BY customer;";
		$fk_used = $this->query_fetch(); // This will calculate FK used by specified customer
		//Calculation for Used FK over

		//Calculating for Used KN	
		$this->sql_query = "SELECT SUM(time_to-time_from) AS kn_sum FROM timetable WHERE DATE BETWEEN '$fdate' AND '$tdate' AND customer='$customer' AND (fkkn='2' OR fkkn='3') GROUP BY customer;";
		$kn_used = $this->query_fetch(); // This will calculate KN used by specified customer
		//Calculating for Used KN over
	
		$fk_used = intval($fk_used[0]['fk_sum']); // FK
		$kn_used = intval($kn_used[0]['kn_sum']); // KN
		
		
		//Calculating for Granted FK
		$this->sql_query = "SELECT * FROM customer_contract WHERE
		( 
		 (date_from BETWEEN '$fdate' AND '$tdate' AND date_to BETWEEN '$fdate' AND '$tdate') 
 			OR ('$fdate' BETWEEN date_from AND date_to) 
 			OR ('$tdate' BETWEEN date_from AND date_to) 
 		)
 		AND customer='$customer' AND fkkn='1'";
		$granted_fk_arr = $this->query_fetch(); // Fetch all FK granted data come in specified date range
		
		$granted_fk = 0;
		foreach($granted_fk_arr as $gfk) {		
			$days = $this->calculate_day_difference($gfk['date_from'],$gfk['date_to']);
					
			$hours_per_day = $gfk['hour']/$days;
			$hours_per_day = $hours_per_day; // Hours per day in partucular month for FK
			
					
			if( $fdate>=$gfk['date_from'] AND $tdate<=$gfk['date_to'] ) // Specified dates are between db dates
			{
				$calculated_days = $this->calculate_day_difference($fdate,$tdate);
				$temp_granted_fk = $calculated_days * $hours_per_day;
				$granted_fk = $granted_fk + $temp_granted_fk;
			}elseif($fdate<=$gfk['date_from'] AND $tdate>=$gfk['date_to'] )  // Specified dates cover db dates
			{
				$calculated_days = $this->calculate_day_difference($gfk['date_from'],$gfk['date_to']);
				$temp_granted_fk = $calculated_days * $hours_per_day;
				$granted_fk = $granted_fk + $temp_granted_fk;	
			}elseif( $fdate>=$gfk['date_from'] AND $fdate<=$gfk['date_to']) // First date between db from date and to date
			{
				$calculated_days = $this->calculate_day_difference($fdate,$gfk['date_to']);	
				$temp_granted_fk = $calculated_days * $hours_per_day;
				$granted_fk = $granted_fk + $temp_granted_fk;
			}elseif( $tdate>= $gfk['date_from'] AND $tdate<=$gfk['date_to'] )
			{
				$calculated_days = $this->calculate_day_difference($gfk['date_from'],$tdate);
				$temp_granted_fk = $calculated_days * $hours_per_day;
				$granted_fk = $granted_fk + $temp_granted_fk;	
			}
		}
		$granted_fk = intval($granted_fk);
		//Calculating for Granted FK over
		
		//Calculating for Granted KN
		$this->sql_query = "SELECT * FROM customer_contract WHERE
		( 
		 (date_from BETWEEN '$fdate' AND '$tdate' AND date_to BETWEEN '$fdate' AND '$tdate') 
 			OR ('$fdate' BETWEEN date_from AND date_to) 
 			OR ('$tdate' BETWEEN date_from AND date_to) 
 		)
 		AND customer='$customer' AND (fkkn='2' OR fkkn='3')";
		
		$granted_kn_arr = $this->query_fetch(); // Fetch all KN granted data come in specified date range
		
		$granted_kn = 0;
		
		foreach($granted_kn_arr as $gkn) {		
			$days = $this->calculate_day_difference($gkn['date_from'],$gkn['date_to']);
			$hours_per_day = $gkn['hour']/$days;
			$hours_per_day = $hours_per_day; // Hours per day in partucular month for KN
			
			if( $fdate>=$gkn['date_from'] AND $tdate<=$gkn['date_to'] ) // Specified dates are between db dates
			{
				$calculated_days = $this->calculate_day_difference($fdate,$tdate);
				$temp_granted_kn = $calculated_days * $hours_per_day;
				$granted_kn = $granted_kn + $temp_granted_kn;
			}elseif($fdate<=$gkn['date_from'] AND $tdate>=$gkn['date_to'] )  // Specified dates cover db dates
			{
				$calculated_days = $this->calculate_day_difference($gkn['date_from'],$gkn['date_to']);
				$temp_granted_kn = $calculated_days * $hours_per_day;
				$granted_kn = $granted_kn + $temp_granted_kn;	
			}elseif( $fdate>=$gkn['date_from'] AND $fdate<=$gkn['date_to']) // First date between db from date and to date
			{
				$calculated_days = $this->calculate_day_difference($fdate,$gkn['date_to']);	
				$temp_granted_kn = $calculated_days * $hours_per_day;
				$granted_kn = $granted_kn + $temp_granted_kn;
			}elseif( $tdate>= $gkn['date_from'] AND $tdate<=$gkn['date_to'] )
			{
				$calculated_days = $this->calculate_day_difference($gkn['date_from'],$tdate);
				$temp_granted_kn = $calculated_days * $hours_per_day;
				$granted_kn = $granted_kn + $temp_granted_kn;	
			}
		}
		$granted_kn = intval($granted_kn);
		//Calculating for Granted KN over
		
		
		$fk_diff = $granted_fk - $fk_used;
		
		$kn_diff = $granted_kn - $kn_used;
		
		$fk_valid_diff = ( ($granted_fk/100) * $per );
		
		$fk_valid_diff = intval($fk_valid_diff);
		
		$fk_valid_lower_range = $granted_fk - $fk_valid_diff;
		$fk_valid_lower_range = intval($fk_valid_lower_range);
		
		$fk_valid_higher_range = $granted_fk + $fk_valid_diff;
		$fk_valid_higher_range = intval($fk_valid_higher_range);
		
		if( ($fk_valid_lower_range <= $fk_used) AND ($fk_used <= $fk_valid_higher_range))
		{
			$fk_text_color = 'BLACK';
		}else{
			$fk_text_color = 'RED';
		}
		
		$kn_valid_diff = ( ($granted_kn/100 ) * $per);
		$kn_valid_lower_range = $granted_kn - $kn_valid_diff;
		$kn_valid_lower_range = intval($kn_valid_lower_range);
		
		$kn_valid_higher_range = $granted_kn + $kn_valid_diff;
		$kn_valid_higher_range = intval($kn_valid_higher_range);
		
		if( ($kn_valid_lower_range <= $kn_used) AND ($kn_used <= $kn_valid_higher_range))
		{
			$kn_text_color = 'BLACK';
		}else{
			$kn_text_color = 'RED';
		}
		
		$data = array();
		
		$data['fk_granted'] = $granted_fk;
		$data['fk_used'] = $fk_used;
		$data['fk_diff'] = $fk_diff;
		$data['fk_color'] = $fk_text_color;
		$data['fk_diff_per'] = ($fk_diff/$granted_fk)*100;	
		$data['fk_diff_per'] = number_format((float)$data['fk_diff_per'], 2, '.', '');
		
		$data['kn_granted'] = $granted_kn;
		$data['kn_used'] = $kn_used;
		$data['kn_diff'] = $kn_diff;
		$data['kn_color'] = $kn_text_color;
		$data['kn_diff_per'] = ($kn_diff/$granted_kn)*100;	
		$data['kn_diff_per'] = number_format((float)$data['kn_diff_per'], 2, '.', '');
		return $data;
	}
			
	function get_filter_date_report_dropdown($customer,$fkdate='',$kndate='', $per){
		$data = array();
		if(!empty($fkdate)){
			$this->sql_query = "SELECT * FROM customer_contract WHERE id='$fkdate';";
			$fkdata = $this->query_fetch(); // This will calculate FK used by specified customer	
			$fk_date_from = $fkdata[0]['date_from'];
			$fk_date_to = $fkdata[0]['date_to'];
			$granted_fk = intval($fkdata[0]['hour']);
			
			$this->sql_query = "SELECT SUM(time_to-time_from) AS fk_sum FROM timetable WHERE DATE BETWEEN '$fk_date_from' AND '$fk_date_to' AND customer='$customer' AND fkkn='1' GROUP BY customer;";
			$fk_used = $this->query_fetch(); // This will calculate FK used by specified customer
			
			$fk_used = intval($fk_used[0]['fk_sum']); // FK
			
			$fk_diff = $granted_fk - $fk_used;
	
			$fk_valid_diff = ( ($granted_fk/100) * $per );
			
			$fk_valid_diff = intval($fk_valid_diff);
			
			$fk_valid_lower_range = $granted_fk - $fk_valid_diff;
			$fk_valid_lower_range = intval($fk_valid_lower_range);
			
			$fk_valid_higher_range = $granted_fk + $fk_valid_diff;
			$fk_valid_higher_range = intval($fk_valid_higher_range);
			
			if( ($fk_valid_lower_range <= $fk_used) AND ($fk_used <= $fk_valid_higher_range))
			{
				$fk_text_color = 'BLACK';
			}else{
				$fk_text_color = 'RED';
			}
			
			$data['fk_granted'] = $granted_fk;
			$data['fk_used'] = $fk_used;
			$data['fk_diff'] = $fk_diff;
			$data['fk_color'] = $fk_text_color;
			$data['fk_diff_per'] = ($fk_diff/$granted_fk)*100;	
			$data['fk_diff_per'] = number_format((float)$data['fk_diff_per'], 2, '.', '');
			
			if(empty($kndate))
			{
				$data['hide_kn'] = '1';
			}			
		}
		
		if(!empty($kndate)){
			$this->sql_query = "SELECT * FROM customer_contract WHERE id='$kndate';";
			$kndata = $this->query_fetch(); // This will calculate FK used by specified customer	
			$kn_date_from = $kndata[0]['date_from'];
			$kn_date_to = $kndata[0]['date_to'];
			$granted_kn = intval($kndata[0]['hour']);
			
			$this->sql_query = "SELECT SUM(time_to-time_from) AS kn_sum FROM timetable WHERE DATE BETWEEN '$kn_date_from' AND '$kn_date_to' AND customer='$customer' AND (fkkn='2' OR fkkn='3') GROUP BY customer;";
			
			$kn_used = $this->query_fetch(); // This will calculate FK used by specified customer
			
			$kn_used = intval($kn_used[0]['kn_sum']); // FK
			
			$kn_diff = $granted_kn - $kn_used;
	
			$kn_valid_diff = ( ($granted_kn/100) * $per );
			
			$kn_valid_diff = intval($kn_valid_diff);
			
			$kn_valid_lower_range = $granted_kn - $kn_valid_diff;
			$kn_valid_lower_range = intval($kn_valid_lower_range);
			
			$kn_valid_higher_range = $granted_kn + $kn_valid_diff;
			$kn_valid_higher_range = intval($kn_valid_higher_range);
			
			if( ($kn_valid_lower_range <= $kn_used) AND ($kn_used <= $kn_valid_higher_range))
			{
				$kn_text_color = 'BLACK';
			}else{
				$kn_text_color = 'RED';
			}
			
			$data['kn_granted'] = $granted_kn;
			$data['kn_used'] = $kn_used;
			$data['kn_diff'] = $kn_diff;
			$data['kn_color'] = $kn_text_color;
			$data['kn_diff_per'] = ($kn_diff/$granted_kn)*100;	
			$data['kn_diff_per'] = number_format((float)$data['kn_diff_per'], 2, '.', '');
			
			if(empty($fkdate))
			{
				$data['hide_fk'] = '1';	
			}			
		}
		return $data;
	}
			
	// Common function for day difference of two dates
	function calculate_day_difference($fdate,$tdate) {
		$start = strtotime($fdate);
		$end = strtotime($tdate);
		$days_between = ceil(abs($end - $start) / 86400)+1;
		return $days_between;
	}
			
	function getCustomerSchedule($customer, $start_date, $end_date){
		
		$this->sql_query = "SELECT * FROM timetable WHERE customer = '".$customer."' AND `date` >= '".$start_date."' 
		AND `date` <= '".$end_date."' group by date ORDER BY `date`, `time_from`, `time_to`";
	   	$kndata = $this->query_fetch(); 
		return $kndata;
	}
	
	function get_slote_per_date($date, $customer){
		$this->sql_query = "SELECT * FROM timetable WHERE customer = '".$customer."' AND `date` = '".$date."' AND type IN(0,3) AND status IN(0,1) ORDER BY `date`, `time_from`, `time_to`";
	    $kndata = $this->query_fetch(); 
		return $kndata;
	}
	
	function getCustomerScheduleAllData($customer, $start_date, $end_date){
		
		$this->sql_query = "SELECT * FROM timetable WHERE customer = '".$customer."' AND `date` >= '".$start_date."' 
		AND `date` <= '".$end_date."' 
                        AND status IN(0,1) AND type IN(0,3) ORDER BY date asc, time_from asc, time_to asc";
	   	$kndata = $this->query_fetch(); 
		return $kndata;
	}
			
	function AddTemplate($customer, $tname="", $tid=""){
	 	if($tid==''){
			$this->tables = array('schedule_template');
			$this->fields = array('tid');
            $this->conditions = array('AND', 'customer = ?', 'temp_name = ?');
            $this->condition_values = array($customer, $tname);
            $this->query_generate();
            $data  = $this->query_fetch();
            if(empty($data)){
                $this->tables = array('schedule_template');
                $this->fields = array('customer', 'Added_date', 'temp_name');
                $this->field_values = array($customer, date('Y-m-d'), addslashes($tname));
                $this->query_insert();
                $tid = $this->con->lastInsertId();
            	return $tid ;
            }else
                return false;
		}else{
			
			$this->sql_query = "update schedule_template set customer = '".$customer."' where tid='".$tid."'";
		    $this->query_fetch();
			return $tid;
		}			
	}
			
	function customer_template_list($customer = ""){
		
		if($customer != ''){
		   $this->sql_query = "SELECT * FROM schedule_template WHERE customer = '".$customer."' ORDER BY `temp_name`  asc";
		   $kndata = $this->query_fetch(); 
			return $kndata;
		}
	}
             
	function exsitCopyTemplateDataDelete($customer, $tid){
		
		$this->tables = array('schedule_copy');
		$this->conditions = array('AND', 'tid = ?', 'customer = ?');
		$this->condition_values = array($tid, $customer);
		if($this->query_delete()){
            $this->tables = array('schedule_template');
            $this->conditions = array('AND', 'tid = ?', 'customer = ?');
            $this->condition_values = array($tid, $customer);
            return $this->query_delete();
        }else
            return false;
	}
	
	function exsitTimetableDataDelete($slot_data){ 
		
		$this->tables = array('timetable');
		$this->conditions = array('AND',  'customer = ?','date = ?', 'time_from like ?', 'time_to like ?');
		$this->condition_values = array($slot_data['customer'],$slot_data['date'], $slot_data['time_from'], $slot_data['time_to']);				
		$id = $this->query_delete();
		return $id;
	}
	
	function DeleteCustomerPreviousSetSchedule($date, $customer){
		$this->tables = array('timetable');
		$this->conditions = array('AND',  'customer = ?','date = ?');
		$this->condition_values = array($customer, $date);				
		return $this->query_delete();
	}
	
	function exsitDataCheck($slot_data){ 
		$this->sql_query = "SELECT * FROM timetable WHERE customer = '".$slot_data['customer']."'  and date = '".$slot_data['date']."' and time_to = '".$slot_data['time_to']."'
		 and time_from = '".$slot_data['time_from']."' ";
	   	$kndata = $this->query_fetch();
	  	return $kndata;
	}
			
	function SaveTemplate($slot_data, $tid){
		
		$this->tables = array('schedule_copy');
		$this->fields = array('tid','employee','customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp', 'relation_id','fkkn');
		$this->field_values = array($tid, $slot_data['employee'],$slot_data['customer'], $slot_data['date'], (float) $slot_data['time_from'], 
			(float) $slot_data['time_to'], $slot_data['type'], $slot_data['status'], $slot_data['comment'], $slot_data['alloc_emp'],  $slot_data['slot_id'],$slot_data['fkkn']);
		$this->query_insert(); 
	}
	
	function getCustomerScheduleTemplate($customer, $tid, $sdate){
		
			$this->tables = array('schedule_copy');
			$this->fields = array('*');
			$this->conditions = array('AND', 'customer = ?', 'tid = ?'); 
			$this->condition_values = array($customer, $tid);
			$this->group_by = array('date');
			$this->query_generate();
			$data = $this->query_fetch();
			return $data ? $data : FALSE;
	} 
	
	function get_copy_slote_per_date($date, $customer, $tid){
		 $this->sql_query = "SELECT * FROM schedule_copy WHERE customer = '".$customer."' AND `date` = '".$date."'
			and tid = '".$tid."' ORDER BY time_from,time_to asc";
	    	$kndata = $this->query_fetch(); 
			return $kndata;
	}
	
	function SaveSceduleTimetable($arr){ 
		if($arr != ''){
			$data = explode(",",$arr);
			
			$slot_data = array(
                'employee'      =>  $data[0],
                'customer'      =>  $data[1], 
                'date'          =>  $data[2], 
                'time_from'     =>  $data[3], 
                'time_to'       =>  $data[4], 
                'type'          =>  $data[5], 
                'status'        =>  ($data[0] != '' && $data[1] != ''? 1 : 0), // && $data[6] 
                'comment'       =>  $data[7], 
                'alloc_emp'     =>  $data[8], 
                'relation_id'   =>  $data[9],
                'fkkn'          =>  $data[10]); 
			
            $this->tables = array('timetable');
            $this->fields = array('employee','customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp','fkkn');
            $this->field_values = array( $slot_data['employee'],$slot_data['customer'], $slot_data['date'], (float) $slot_data['time_from'], 
                                    (float) $slot_data['time_to'], $slot_data['type'], $slot_data['status'], $slot_data['comment'], $slot_data['alloc_emp'], $slot_data['fkkn']);
            return $this->query_insert();
		}
	}
	
    function DeleteSceduleTimetable($tid, $cust){ 
        $this->tables = array('schedule_copy');
        $this->conditions = array('AND', 'tid = ?', 'customer = ?');
        $this->condition_values = array($tid, $cust);
        
        if($this->query_delete()){
              $this->tables = array('schedule_template');
              $this->conditions = array('AND', 'tid = ?', 'customer = ?');
              $this->condition_values = array($tid, $cust);
            return $this->query_delete();
        }else
            return false;
	}
                        
	function getStartDateTouptoDatdate($ResultArray, $day) {
		$first_part = array();
		$k=0;
		
		foreach($ResultArray as $arr){
			 if($k==1){
			 	$first_part[] = $arr["date"];
			 }
			 if(date("D",strtotime($arr["date"])) == $day){
				$k=1;
				$first_part[] = $arr["date"];
			 }	
		} 
		return $first_part;	
	}
	
	function getShiftOtherDayBack($ResultArray, $sdate, $edate) {
		$second_part = array();
		$i=1;
		foreach($ResultArray as $arr){
			 	
			 if($sdate > $arr["date"] || $edate < $arr["date"]){ echo $date;
				$NewDate = date("Y-m-d",(strtotime(date("Y-m-d", strtotime($edate)) . " +".$i." days"))); 
			 	$second_part[] = $arr["date"];
				$i++;
			 }
		} 
		return $second_part;
	}
	
	/* Check employee assign for other customer to give time slote OR Not */  
	 function check_employee_schedule_to_other_customer($employee, $customer, $date, $time_from, $to_time){
			$err_c = 0 ;
			$this->tables  = array("SELECT *
									FROM timetable
									WHERE employee = '".$employee."' and customer != '".$customer."' and
									date = '".$date."'");
			
			$this->query_generate_leftjoin();
			$data = $this->query_fetch();
			if($data){
				foreach($data as $stote_data){
					if( ($time_from >= $stote_data['time_from'] && $time_from <= $stote_data['time_to']) || 
					($to_time >= $stote_data['time_from'] && $to_time <= $stote_data['time_to']) ||
					($to_time >= $stote_data['time_to'] && $time_from <= $stote_data['time_from']) 
					) {
						$err_c++;
					}
				}
			}
			return $err_c;
	 } 
			 
	 /* check contract hours */	 
	 function check_employee_expired($employee){
			$err_n = 0;
			$this->tables  = array("SELECT employee_contract.*
									FROM employee e
									INNER JOIN employee_contract ON e.username = employee_contract.employee
									WHERE employee_contract.employee = '".$employee."' 
									GROUP BY employee_contract.employee
									ORDER BY employee_contract.id DESC");
			
			$this->query_generate_leftjoin();
			$contract = $this->query_fetch();
			if(sizeof($contract) > 0){
		
				if($contract['date_from'] < $date && $contract['date_to'] > $date){
					$err_n++;
				}
			  }
		 return $err_n;	  
	 }   
	 
	  /* check employee team leave for customer */	 
	 function check_employee_leave_customer($employee, $customer){
			$err_n = 0;
			$this->tables  = array(" SELECT * FROM `team`  WHERE employee = '".$employee."' AND customer = '".$customer."'");
			$this->query_generate_leftjoin();
			$data = $this->query_fetch();
			
			if(sizeof($data) == 0){
					$err_n++;
			 }
		 	return $err_n;	  
	 }   
	 
	 //Check Leave for employee  
	function check_leave_employee_to_template_set($username,$date,$TimeTo){
		
		require_once ('class/newemployee.php');
		$newemployee = new newemployee();
		
		$err_l = 0;
		$EmpLeaveData = $newemployee->Check_Emp_Leave($username,$date);											
		if(!empty($EmpLeaveData)) {
			for($leaveCounter = 0 ; $leaveCounter < count($EmpLeaveData) ; $leaveCounter++){												
				if($EmpLeaveData[$leaveCounter]['time_from'] <= $TimeTo && $TimeTo <= $EmpLeaveData[$leaveCounter]['time_to']) {
					$LeaveCheckFlag = 0;	
				}
			}
			if(!isset($LeaveCheckFlag))
				$LeaveCheckFlag = 1;
		}
		else
			$LeaveCheckFlag = 1;

		if($LeaveCheckFlag == 0)
			$err_l++;
		
		return $err_l;
	}
    
	// begin Niyaz
    function AddGlobalSetting_new(){
        $this->tables = array('global_setting');
        $this->fields = array('schedule_time_diff','emp_max_hours','maxhours_per_week','max_overtime','insurance_personal','insurance_subsitute');
        $this->field_values = array($this->timediff,$this->maxhours,$this->maxhours_per_week,$this->max_overtime,$this->insurance_personal,$this->insurance_subsitute);
        if($this->query_insert()){
            return true;
        }else{
            return false;
        }
    }
    
    function give_effect_to_old_data($effect_from){
        $this->tables = array('salary_main');
        $this->fields = array('MAX(id) AS ids','effect_from');
        $this->query_generate();
        $data = $this->query_fetch();
        if($data){
            $this->tables = array('salary_main');
            $this->fields = array('effect_to');
            $this->field_values = array( date('Y-m-d',strtotime($effect_from. "-1 day")));
            $this->conditions = array('id = ?');
            $this->condition_values = array($data[0]['ids']); 
            return $this->query_update();
        }else
            return true;
    }

    function add_new_salary_main($effect_from,$clone_from = null,$inc = null){
        $this->tables = array('salary_main');
        $this->fields = array('effect_from','effect_to','normal','travel','break','overtime','quality_overtime','oncall','more_time','some_other_time',
            'training_time','call_training','personal_meeting','holiday_big','holiday_big_oncall','holiday_red','holiday_red_oncall','insurance','clone_from','increment_percentage', 'week_end_travel',
            'voluntary', 'complementary', 'complementary_oncall', 'more_oncall', 'standby', 'w_dismissal', 'w_dismissal_oncall');
        $this->field_values = array($effect_from,'0000-00-00',$this->normal,$this->travel,$this->break,$this->overtime,$this->qual_overtime,$this->oncall,$this->more_time,$this->some_other_time,
            $this->training_time,$this->call_training,$this->personal_meeting,$this->holiday_big,$this->holiday_big_oncall,$this->holiday_red,$this->holiday_red_oncall,$this->insurance_personal,$clone_from,$inc, $this->week_end_travel,
            $this->voluntary, $this->complementary, $this->complementary_oncall, $this->more_oncall, $this->standby, $this->work_for_dismissal, $this->work_for_dismissal_oncall);
        if($this->query_insert()){
            $this->salary_main_last_id = $this->get_id();
            return true;
        }else
            return FALSE;
    }
    function check_overlap(){
        $this->tables = array('salary_main');
        $this->fields = array('id','effect_from','effect_to');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }
    
    function getsalary_main($ids = null){
        $this->tables = array('salary_main');
        $this->fields = array('MAX(id) AS ids');
        $this->query_generate();
        $data = $this->query_fetch();
        $this->tables = array('salary_main');
        $this->fields = array('id','effect_from','effect_to','normal','travel','break','overtime','quality_overtime','oncall','more_time','some_other_time','training_time','call_training','personal_meeting','holiday_big','holiday_big_oncall','holiday_red','holiday_red_oncall','insurance', 'week_end_travel', 'voluntary', 'complementary', 'complementary_oncall', 'more_oncall', 'standby', 'w_dismissal', 'w_dismissal_oncall');
        $this->conditions = array('id = ?');
        if($ids != null){
            $this->condition_values = array($ids);
        }else{
           $this->condition_values = array($data[0]['ids']); 
        }
        $this->query_generate();
        $data1 = $this->query_fetch();
        return $data1 ? $data1[0] : array();
    }
    
    function  get_salary_main_dates(){
        $this->tables = array('salary_main');
        $this->fields = array('id','effect_from');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }
    
    function delete_salary_main($ids){
        $this->tables = array('salary_main');
        $this->conditions = array('id = ?');
        $this->condition_values = array($ids);
        return $this->query_delete();
    }
    
    function check_overlap_edit($ids){
        $this->tables = array('salary_main');
        $this->fields = array('id','effect_from','effect_to');
        $this->conditions = array('AND','id <> ?');
        $this->condition_values = array($ids);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data : array();
    }
    
    function edit_salary_main($effect_from, $effect_to, $ids){
        $this->tables = array('salary_main');
        $this->fields = array('effect_from','normal','travel','break','overtime','quality_overtime','oncall','more_time','some_other_time','training_time','call_training','personal_meeting',
            'holiday_big','holiday_big_oncall','holiday_red','holiday_red_oncall','insurance', 'week_end_travel', 'voluntary', 'complementary', 'complementary_oncall', 'more_oncall', 'standby', 'w_dismissal', 'w_dismissal_oncall');
        $this->field_values = array($effect_from, $this->normal, $this->travel,$this->break,$this->overtime,$this->qual_overtime,$this->oncall,$this->more_time,$this->some_other_time,$this->training_time,$this->call_training,$this->personal_meeting,
            $this->holiday_big,$this->holiday_big_oncall,$this->holiday_red,$this->holiday_red_oncall,$this->insurance_personal, $this->week_end_travel, $this->voluntary, $this->complementary, $this->complementary_oncall, $this->more_oncall, $this->standby, $this->work_for_dismissal, $this->work_for_dismissal_oncall);
        
        $this->fields[] = 'effect_to';
        $this->field_values[] = ($effect_to == '' || $effect_to == NULL ? '0000-00-00' : $effect_to);
        $this->conditions = array('id = ?');
        $this->condition_values = array($ids);
        return $this->query_update();
    }
    
    function edit_default_start_time_and_day_company(){
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('start_day');
        $this->field_values = array($this->start_day);
        $this->conditions = array('id = ?');
        $this->condition_values = array($_SESSION['company_id']);
        return $this->query_update();
    }
    
    function get_default_start_time_day(){
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('start_day');
        $this->conditions = array('id = ?');
        $this->condition_values = array($_SESSION['company_id']);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data ? $data[0] : array();
    }
    
    function get_timeslots_by_customer_date($customer, $date){
				
            $this->tables = array('timetable');
            $this->fields = array('id', 'employee', 'customer', 'date', 'time_from', 'time_to');
            $this->conditions = array('AND', 'customer = ?', 'date = ?'); 
            $this->condition_values = array($customer, $date);
            $this->group_by = array('time_from', 'time_to');
            $this->query_generate();
            $data = $this->query_fetch();
            return $data;
    } 
    
    function check_exist_template($customer, $template_name){
            $this->tables = array('schedule_template');
            $this->fields = array('tid');
            $this->conditions = array('AND', 'customer = ?', 'temp_name = ?'); 
            $this->condition_values = array($customer, $template_name);
            $this->query_generate();
            $data = $this->query_fetch();
            return !empty($data) ? $data[0]['tid'] : FALSE;
    }
    
    function check_exist_template_id($customer, $template_id){
            $this->tables = array('schedule_template');
            $this->fields = array('tid');
            $this->conditions = array('AND', 'customer = ?', 'tid = ?'); 
            $this->condition_values = array($customer, $template_id);
            $this->query_generate();
            $data = $this->query_fetch();
            return !empty($data) ? $data[0]['tid'] : FALSE;
    }
    
    function delete_scedule_template_slots($template_id, $customer){ 
            $this->tables = array('schedule_copy');
            $this->conditions = array('AND', 'tid = ?', 'customer = ?');
            $this->condition_values = array($template_id, $customer);
            return $this->query_delete();
    }
    
    function delete_schedule_template($template_id){ 
            $this->tables = array('schedule_copy');
            $this->conditions = array('tid = ?');
            $this->condition_values = array($template_id);
            if($this->query_delete()){
                $this->tables = array('schedule_template');
                $this->conditions = array('tid = ?');
                $this->condition_values = array($template_id);
                return $this->query_delete();
            }else
                return FALSE;
    }
    
    function create_new_template($customer, $template_name, $from_date = '', $to_date = '', $created_user = NULL){
            $this->tables = array('schedule_template');
            $this->fields = array('customer', 'Added_date', 'temp_name', 'from_date', 'to_date', 'created_user');
            $this->field_values = array($customer, date('Y-m-d'), addslashes($template_name), $from_date, $to_date, $created_user);
            return $this->query_insert() ? $this->get_id() : FALSE;
    }
    
    function update_template_main($template_id, $from_date, $to_date){
            $this->tables = array('schedule_template');
            $this->fields = array('from_date', 'to_date');
            $this->field_values = array($from_date, $to_date);
            $this->conditions = array('tid = ?');
            $this->condition_values = array($template_id);
            return $this->query_update();
    }
    
    function SaveMultipleSlotDatasToTemplate($slot_datas){
            $this->tables = array('schedule_copy');
            $this->fields = array('tid','employee','customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp', 'relation_id', 'fkkn', 'alloc_comment', 'cust_comment');
            $this->field_values = $slot_datas;
            return $this->query_insert();
    }
    
    function getTemplateSlots($template_id){
            require_once('class/employee.php');
            $obj_employee = new employee();
            $this->tables = array('schedule_copy` as `s', 'schedule_template` as `t');
            $this->fields = array('t.customer AS template_customer', 's.id', 's.tid', 's.employee', 's.customer', 's.fkkn', 's.date', 's.time_from', 's.time_to', 's.type', 's.status', 's.comment', 's.alloc_emp', 's.relation_id', 
                    '(SELECT first_name FROM customer where username = s.customer) AS cust_first_name', 
                    '(SELECT last_name FROM customer where username = s.customer) AS cust_last_name', 
                    '(SELECT first_name FROM employee where username = s.employee) AS emp_first_name', 
                    '(SELECT last_name FROM employee where username = s.employee) AS emp_last_name', 
                    '(SELECT color FROM employee where username = s.employee) AS emp_color');
            $this->conditions = array('AND', 's.tid = ?', 's.tid = t.tid'); 
            $this->condition_values = array($template_id);
            $this->order_by = array('s.date', 's.time_from', 's.time_to');
            $this->query_generate();
            $slots = $this->query_fetch();
            if(!empty($slots)){
                foreach ($slots as $key => $slot) {
                    $tmp_array = array(
                        'slot'      => $slot['time_from'] . '-' . $slot['time_to'], 
                        'slot_hour' => $obj_employee->time_difference($slot['time_from'], $slot['time_to'], 100), 
                        'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 
                        'emp_name'  => $slot['emp_first_name'] . ' ' . $slot['emp_last_name']);

                    $slots[$key] = array_merge($slots[$key], $tmp_array);
                }
            }
            return $slots;
    }
    
    function save_template_slots_to_timetable($slot_datas){
            
            if(empty($slot_datas)) return false;

            $this->tables = array('timetable');
            $this->fields = array('employee','customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp','fkkn');
            $this->field_values = $slot_datas;
            return $this->query_insert();
    }
    
    function get_template_main_details($template_id){
            $this->tables = array('schedule_template');
            $this->fields = array('customer', 'Added_date', 'temp_name');
            $this->conditions = array('tid = ?');
            $this->condition_values = array($template_id);
            $this->query_generate();
            $data = $this->query_fetch();
            return $data;
    }
    
    function get_all_customer_templates() {
        $this->sql_query = "SELECT tid, customer, Added_date, temp_name FROM schedule_template WHERE 1 ORDER BY `temp_name`  asc";
        $kndata = $this->query_fetch();
        return $kndata;
    }
    
    function check_exist_employee_template_id($employee){
            $this->tables = array('schedule_template_employee');
            $this->fields = array('tid');
            $this->conditions = array('AND', 'employee = ?'); 
            $this->condition_values = array($employee);
            $this->query_generate();
            $data = $this->query_fetch();
            return !empty($data) ? $data[0]['tid'] : FALSE;
    }
    
    function delete_employee_schedule_template_slots($template_id, $employee){ 
            $this->tables = array('schedule_copy_employee');
            $this->conditions = array('AND', 'tid = ?', 'employee = ?');
            $this->condition_values = array($template_id, $employee);
            return $this->query_delete();
    }
    
    function create_new_employee_template($employee, $template_name, $from_date = '', $to_date = '', $created_user = NULL){
            $this->tables = array('schedule_template_employee');
            $this->fields = array('employee', 'Added_date', 'from_date', 'to_date', 'created_user');
            $this->field_values = array($employee, date('Y-m-d'), $from_date, $to_date, $created_user);
            return $this->query_insert() ? $this->get_id() : FALSE;
    }
    
    function update_employee_template_main($template_id, $from_date, $to_date){
            $this->tables = array('schedule_template_employee');
            $this->fields = array('from_date', 'to_date', 'modified_date', 'modified_user');
            $this->field_values = array($from_date, $to_date, date('Y-m-d'), $_SESSION['user_id']);
            $this->conditions = array('tid = ?');
            $this->condition_values = array($template_id);
            return $this->query_update();
    }
    
    function SaveMultipleSlotDatasToEmployeeTemplate($slot_datas){
            $this->tables = array('schedule_copy_employee');
            $this->fields = array('tid','employee','customer', 'date', 'time_from', 'time_to', 'type', 'status', 'comment', 'alloc_emp', 'relation_id', 'fkkn', 'alloc_comment', 'cust_comment');
            $this->field_values = $slot_datas;
            return $this->query_insert();
    }
    
    function getEmployeeTemplateSlots($template_id){
            if ($template_id == FALSE)                return array();
            require_once('class/employee.php');
            $obj_employee = new employee();
            $this->tables = array('schedule_copy_employee` as `s', 'schedule_template_employee` as `t');
            $this->fields = array('t.employee AS template_employee', 's.id', 's.tid', 's.employee', 's.customer', 's.fkkn', 's.date', 's.time_from', 's.time_to', 's.type', 's.status', 's.comment', 's.alloc_emp', 's.relation_id', 
                    '(SELECT first_name FROM customer where username = s.customer) AS cust_first_name', 
                    '(SELECT last_name FROM customer where username = s.customer) AS cust_last_name', 
                    '(SELECT first_name FROM employee where username = s.employee) AS emp_first_name', 
                    '(SELECT last_name FROM employee where username = s.employee) AS emp_last_name', 
                    '(SELECT color FROM employee where username = s.employee) AS emp_color');
            $this->conditions = array('AND', 's.tid = ?', 's.tid = t.tid'); 
            $this->condition_values = array($template_id);
            $this->order_by = array('s.date', 's.time_from', 's.time_to');
            $this->query_generate();
            $slots = $this->query_fetch();
            if(!empty($slots)){
                foreach ($slots as $key => $slot) {
                    $tmp_array = array(
                        'slot'      => $slot['time_from'] . '-' . $slot['time_to'], 
                        'slot_hour' => $obj_employee->time_difference($slot['time_from'], $slot['time_to'], 100), 
                        'cust_name' => $slot['cust_first_name'] . ' ' . $slot['cust_last_name'], 
                        'emp_name'  => $slot['emp_first_name'] . ' ' . $slot['emp_last_name']);

                    $slots[$key] = array_merge($slots[$key], $tmp_array);
                }
            }
            return $slots;
    }
    
    function get_employee_template_main_by_id($template_id){
        
            if($template_id == FALSE) return array();
            
            $this->tables = array('schedule_template_employee');
            $this->fields = array('tid', 'employee', 'from_date', 'to_date');
            $this->conditions = array('AND', 'tid = ?'); 
            $this->condition_values = array($template_id);
            $this->query_generate();
            $data = $this->query_fetch();
            return !empty($data) ? $data[0] : array();
    }
    
    function delete_employee_schedule_template($template_id){ 
            $this->tables = array('schedule_template_employee');
            $this->conditions = array('tid = ?');
            $this->condition_values = array($template_id);
            return $this->query_delete();
    }
}
?>