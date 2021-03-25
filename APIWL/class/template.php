
<?php
	/**
		 * Description of template
		 * @author sreerag
 	*/

 	require_once ('configs/config.inc.php');
	require_once ('class/setup.php');
	require_once ('class/db.php');
	require_once ('class/customer.php');
	require_once ('class/dona.php');
	require_once ('class/copy_paste.php');

	class template extends db {
		var $employees        = array();
		var $customers        = array();
		var $employee_details = array();
		var $customer_details = array();
		var $template_id 	  = '';

		function get_available_users_template($customer, $time_from,$time_to,$date,$shcedule_id,$except_id = NULL) {
			if ($customer == '' || $customer == NULL)
            	$customer = NULL;
	        if ($_SESSION['company_sort_by'] == 1)
	            $order_by = 'ORDER BY LOWER(e.first_name),LOWER(e.last_name)';
	        elseif ($_SESSION['company_sort_by'] == 2)
	            $order_by = 'ORDER BY LOWER(e.last_name),LOWER(e.first_name)';
			$cur_date         = strtotime($date . ' 00:00:00');
			$date_array       = explode('-', $date);
			$date_month       = $date_array[1];
			$date_year        = $date_array[0];
			$tl_customer_role = $_SESSION['user_role'];

			if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
	            $this->tables = array('team');
	            $this->fields = array('role');
	            $this->conditions = array('AND', 'customer = ?', 'employee = ?');
	            $this->condition_values = array($customer, $_SESSION['user_id']);
	            $this->query_generate();
	            $data = $this->query_fetch();
				// echo "<pre>".print_r($data, 1)."</pre>"; exit();
            	if(!empty($data))
                	$tl_customer_role = $data[0]['role'];
        	}
        	if($except_id != NULL){
        		$this->sql_query = "SELECT e.username, e.first_name, e.last_name,e.substitute FROM `employee` as `e` 
	                            INNER JOIN `team` as `tm` ON tm.employee = e.username AND tm.customer='$customer'
	                            LEFT JOIN  `schedule_copy` as `sc` ON sc.employee LIKE e.username AND ((sc.time_from >= " . (float) $time_from . " AND sc.time_from < " . (float) $time_to . ") OR (sc.time_to > " . (float) $time_from . " AND sc.time_to <= " . (float) $time_to . ") OR (sc.time_from < " . (float) $time_from . " AND sc.time_to > " . (float) $time_to . ")) AND sc.date='$date' AND sc.tid ='$shcedule_id' AND sc.id != '$except_id' where sc.employee IS NULL AND e.status = 1   ";
        	}
        	else{
        		$this->sql_query = "SELECT e.username, e.first_name, e.last_name,e.substitute FROM `employee` as `e` 
	                            INNER JOIN `team` as `tm` ON tm.employee = e.username AND tm.customer='$customer'
	                            LEFT JOIN  `schedule_copy` as `sc` ON sc.employee LIKE e.username AND ((sc.time_from >= " . (float) $time_from . " AND sc.time_from < " . (float) $time_to . ") OR (sc.time_to > " . (float) $time_from . " AND sc.time_to <= " . (float) $time_to . ") OR (sc.time_from < " . (float) $time_from . " AND sc.time_to > " . (float) $time_to . ")) AND sc.date='$date' AND sc.tid ='$shcedule_id'  where sc.employee IS NULL AND e.status = 1 ";
        	}
	        
	         $this->sql_query .= ' '. $order_by;
	         // echo $this->sql_query;
	         // exit();
	         $datas = $this->query_fetch($this->sql_query);
	         // echo "<pre>".print_r($datas,1)."</pre>";
	         // exit();
	         $employees = array();
	         foreach ($datas as $data) {
	            $employees[] = array('username' => $data['username'], 
	                'name' => $data['last_name'] . ' ' . $data['first_name'], 
	                'name_ff' => $data['first_name'] . ' ' . $data['last_name'], 
	                'ordered_name' => $_SESSION['company_sort_by'] == 1 ? $data['first_name'] . ' ' . $data['last_name'] : $data['last_name'] . ' ' . $data['first_name'], 
	                'code' => $data['code'], 
	                'substitute' => $data['substitute']);
	         }
	        return count($employees) ? $employees : array();
    	}

    	function is_valid_slot($employee, $time_from, $time_to, $date, $for_leave_cancel = FALSE) {     //$for_leave_cancel is only for leave cancel module
	        if ($employee != '') {
	            $this->tables = array('schedule_copy');
	            $this->fields = array('id');
	            if ($for_leave_cancel)
	                $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', 'status != 2');
	            else        //default condition
	                $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?');
	            $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, $employee);
	            $this->query_generate();
	            $datas = $this->query_fetch();
	            if (count($datas)) {
	                return false;
	            } else if ($for_leave_cancel) {
	                return true;
	            } else {
	                $this->tables = array('leave');
	                $this->fields = array('id');
	                $this->conditions = array('AND', array('OR', array('AND', 'time_from >= ? ', 'time_from < ?'), array('AND', 'time_to > ?', 'time_to <= ?'), array('AND', 'time_from < ?', 'time_to > ?')), 'date=?', 'employee=?', array('IN', 'status', '0,1'));
	                $this->condition_values = array((float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, (float) $time_from, (float) $time_to, $date, $employee);
	                $this->query_generate();
	                $datas = $this->query_fetch();
	                if (count($datas)) {
	                    return false;
	                } else {
	                    /* $this->tables = array('report_signing');
	                      $this->fields = array('id');
	                      $this->conditions = array('AND', 'employee = ?', 'MONTH(date) = ?', 'YEAR(date) = ?');
	                      $this->condition_values = array($employee, substr($date, 5,2), substr($date, 0,4));
	                      $this->query_generate();
	                      $signin_data = $this->query_fetch();
	                      if (!empty($signin_data)) {
	                      return false;
	                      }else{
	                      return true;
	                      } */
	                    return true;
	                }
	            }
	        } else {
	            return true;
	        }
	        //"select id from timetable where  (time_from >=(float)$time_from   and time_from < (float)$time_to) or (time_to > (float)$time_from and time_to <=(float)$time_to) (time_from<(float)$time_from and time_to>(float)$time_to) and date=$date and employee";
    	}

    	function customer_employee_slot_add($template_id,$employee, $customer, $date, $time_from, $time_to, $alloc_emp, $fkkn = '', $type = 0, $relation_id = '',$comment = null, $status = 1) {
	        if($time_from == $time_to) return true;
	        
	        $created_status = ($status == 4 ? 1 : NULL);
	        if($fkkn == ''){
	            if ($customer != '') {
	                $cust_detail = $this->get_customer_details($customer);
	                $fkkn = (!empty($cust_detail) ? $cust_detail[0]['fkkn'] : 1);
	            }else
	                $fkkn = 1;
	        }
	       
	        if ($employee == '' || $customer == '') {
	            $status = 0;
	            $relation_id = '';
	        }
	        if ($_SESSION['user_role'] == 4 && $status != 4) $status = 3; 
	        if($comment == NULL || $comment == "") $comment = NULL;

	        $this->tables = array('schedule_copy');
	        $this->fields = array('tid','employee', 'customer', 'fkkn', 'type', 'date', 'time_from', 'time_to', 'status','alloc_emp', 'comment');
	        $this->field_values = array($template_id,$employee, $customer, $fkkn, $type, $date, $time_from, $time_to, $status, $alloc_emp, $comment);
	        if ($relation_id != '') {
	            $this->fields[] = 'relation_id';
	            $this->field_values[] = $relation_id;
	        }
	        return $this->query_insert();
    	}

    	function get_customer_details($customer_name = Null) {

	        $this->tables = array('customer');
	        $this->fields = array('concat(first_name, " " ,last_name) as fullname', 'social_security', 'city', 'username', 'phone', 'mobile', 'century', 'fkkn', 'employee_contract_start_month', 'employee_contract_period_date', 'employee_contract_period_length');
	        if ($customer_name != Null) {
	            $this->conditions = array('username like ?');
	            $this->condition_values = array($customer_name);
	        }
	        $this->order_by = array('LOWER(last_name)');
	        $this->query_generate();
	        //echo $this->sql_query;
	        $datas = $this->query_fetch();
	        //print_r($datas);
	        return $datas;
    	}

    	function customer_slots_btwn_dates($customer, $sdate, $edate,$template_id ,$allowed_statuses = array()) {
	        /**
	         * @author: Shamsudheen <shamsu@arioninfotech.com> on 2014-04-08
	         * for: get customer slots between two dates
	         */
	        	// copy function from timetable class.
	        	// get customer slots b/w 2 days without considering report signing table. 
	        require_once('class/employee.php');
	        $obj_employee = new employee();

	        $this->flush();
	        $this->tables = array('schedule_copy` as `t');
	        $this->fields = array('t.id','t.tid', 't.employee', 't.customer', 't.fkkn', 't.date', 't.time_from', 't.time_to',
	            't.type', 't.status', 't.relation_id', 't.comment', 't.alloc_emp', 't.alloc_comment', 't.cust_comment',
	            '(SELECT first_name FROM customer where username = t.customer) AS cust_first_name',
	            '(SELECT last_name FROM customer where username = t.customer) AS cust_last_name',
	            '(SELECT first_name FROM employee where username = t.employee) AS emp_first_name',
	            '(SELECT last_name FROM employee where username = t.employee) AS emp_last_name',
	            '(SELECT color FROM employee where username = t.employee) AS emp_color');
	        $this->conditions = array('AND', 'customer = ?','tid = ?', array('BETWEEN', 'date', '?', '?'), array('IN', 'status', '0,1,2,4'));
	        $this->condition_values = array($customer,$template_id, $sdate, $edate);
	        if (!empty($allowed_statuses)) {
	            $this->conditions[] = array('IN', 'status', implode(',', $allowed_statuses));
	//            $this->condition_values[] = ;
	        }
	        $this->order_by = array('time_from', 'time_to');
	        $this->query_generate();
	//        echo $this->sql_query;
	//        echo "<pre>".print_r($this->condition_values, 1)."</pre>";
	        $slots = $this->query_fetch();

	        /*
	          SELECT * FROM `timetable` t  LEFT JOIN report_signing r ON (t.employee like r.employee and t.customer like r.customer  and month(r.date)= month(t.date) and year(r.date) = year(t.date) and r.employee IS NOT NULL and r.employee !='' )
	          WHERE t.customer = 'inan002' and t.date between '2014-03-01' and '2014-03-31'
	         */

	        $tl_employees = array();

	        if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
	            $temp_tl_employees = $obj_employee->employees_list_for_right_click($customer);
	            foreach ($temp_tl_employees as $temp_tl_employee) {
	                $tl_employees[] = $temp_tl_employee['username'];
	            }
	        }

	        if (!empty($slots)) {
	            foreach ($slots as $key => $slot) {
	//                $signin_flag = $obj_employee->chk_employee_rpt_signed($slot['employee'], $customer, $slot['date']);

	                $tl_flag = 1;
	                if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 7) {
	                    if (!in_array($slot['employee'], $tl_employees) && $slot['employee'] != '')
	                        $tl_flag = 0;
	                }elseif ($_SESSION['user_role'] == 3) {
	                    if ($_SESSION['user_id'] != $slot['employee'])
	                        $tl_flag = 0;
	                }

	                if ($_SESSION['company_sort_by'] == 1) {
	                    $cust_name = $slot['cust_first_name'] . ' ' . $slot['cust_last_name'];
	                    $emp_name = $slot['emp_first_name'] . ' ' . $slot['emp_last_name'];
	                } elseif ($_SESSION['company_sort_by'] == 2) {
	                    $cust_name = $slot['cust_last_name'] . ' ' . $slot['cust_first_name'];
	                    $emp_name = $slot['emp_last_name'] . ' ' . $slot['emp_first_name'];
	                }

	                $tmp_array = array(
	                    'slot' => $slot['time_from'] . '-' . $slot['time_to'],
	                    'slot_hour' => $obj_employee->time_difference($slot['time_from'], $slot['time_to'], 100),
	                    'cust_name' => $cust_name,
	                    'emp_name' => $emp_name,
	//                    'signed'    => $signin_flag, 
	                    'tl_flag' => $tl_flag);

	                $slots[$key] = array_merge($slots[$key], $tmp_array);
	            }
	        }
	        return $slots;
    	}

    	function customer_employee_slot_details($id) {
	        $this->tables = array('schedule_copy');
	        $this->fields = array('id','tid','customer', 'employee', 'fkkn', 'status', 'alloc_emp', 'time_from', 'time_to', 'type', 'date', 'relation_id', '(SELECT first_name FROM employee where username = schedule_copy.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = schedule_copy.employee) AS emp_last_name');
	        $this->conditions = array('id = ?');
	        $this->condition_values = array($id);
	        $this->query_generate();
	        $datas = $this->query_fetch();
	        return $datas[0];
   		}

   		function findout_slot_alteration_bug($source_data, $exception_ids = array(), $msg_flag = 1) {
	        /**
	         * @author: Shamsudheen <shamsu@arioninfotech.com>
	         * for: find our any bugs when a slot alter
	         * if any bugs - the message sets to SESSION message
	         * @param: $exception_ids - is used for excepting any ids for slot collide checking
	         * return type: Boolean
	         */


	        
	        if ($msg_flag == 1) {
	            require_once ('plugins/message.class.php');
	            $msg = new message();
	        }
	        $exception_id_string = '';
	        if (!empty($exception_ids)) {
	            $exception_id_string = implode(',', $exception_ids);
	        }
	        $this->sql_query = "CALL template_findout_slot_alteration_bug(:slot_tid,:employee,:customer,:date,:type,:time_from,:time_to,:fkkn,:exception_ids,@fname,@lname,@flag,@message,@cfname,@clname,@ctime_from,@ctime_to)";
	        $stmt = $this->con->prepare($this->sql_query);
	        $stmt->bindParam(':slot_tid', $source_data['slot_tid']);
	        $stmt->bindParam(':employee', $source_data['employee']);
	        $stmt->bindParam(':customer', $source_data['customer']);
	        $stmt->bindParam(':date', $source_data['date']);
	        $stmt->bindParam(':type', $source_data['type']);
	        $stmt->bindParam(':time_from', $source_data['time_from']);
	        $stmt->bindParam(':time_to', $source_data['time_to']);
	        $stmt->bindParam(':fkkn', $source_data['fkkn']);
	        $stmt->bindParam(':exception_ids', $exception_id_string);

	        $stmt->execute();
	        $stmt->closeCursor();
	        $this->sql_query = "select @flag, @message,@lname,@fname,@cfname,@clname,@ctime_from,@ctime_to";
	        $data = $this->query_fetch();
       		// echo "<pre>".print_r($data,1)."</pre>";
        	//return TRUE;
	        if (empty($data)) {
	            $msg->set_message_exact('fail', 'Sorry Its Fucked up');
	            return FALSE;
	        } 
        	else {
	            if ($data[0]['@flag'] == 1) {
	                return TRUE;
	            } 
            	else {
	                $emp_name = $_SESSION['company_sort_by'] == 1 ? $data[0]['@fname'] . " " . $data[0]['@lname'] : $data[0]['@lname'] . " " . $data[0]['@fname'];
	                $cust_name = $_SESSION['company_sort_by'] == 1 ? $data[0]['@cfname'] . " " . $data[0]['@clname'] : $data[0]['@clname'] . " " . $data[0]['@cfname'];
	                $msg->set_message('fail', $data[0]['@message']);
	                //check inconvenient possibility if it is a oncall type slot
	                if ($data[0]['@message'] == 'employee_is_inactive') {
	                    $msg->set_message_exact('fail', ' - ' . $emp_name);
	                    //check customer is inactive
	                } elseif ($data[0]['@message'] == 'customer_is_inactive') {
	                    $msg->set_message_exact('fail', ' - ' . $emp_name);
	                }
	                //check inconvenient possibility if it is a oncall type slot
	                elseif ($data[0]['@message'] == 'time_outside_oncall') {
	                    $msg->set_message_exact('fail', $source_data['date'] . ' => ' . str_pad(sprintf('%.02f', (float) $source_data['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $source_data['time_to']), 5, '0', STR_PAD_LEFT));
	                }
	                //check report signed in
	                elseif ($data[0]['@message'] == 'employee_signed_in') {
	                    $msg->set_message_exact('fail', $emp_name . ' <-> ' . $cust_name . ' => ' . $source_data['date']);
	                }
	                //check slot collide
	                elseif ($data[0]['@message'] == 'slot_collide') {
	                    $msg->set_message_exact('fail', $emp_name . ' ' . $source_data['date'] . ' ' . str_pad(sprintf('%.02f', (float) $source_data['time_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', (float) $source_data['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . str_pad(sprintf('%.02f', $data[0]['@ctime_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $data[0]['@ctime_to']), 5, '0', STR_PAD_LEFT));
	                }
	                //check leave taken
	                elseif ($data[0]['@message'] == 'employee_took_a_leave') {
	                    $msg->set_message_exact('fail', $emp_name . ' ' . $source_data['date'] . ' ' . str_pad(sprintf('%.02f', $data[0]['@ctime_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $data[0]['@ctime_to']), 5, '0', STR_PAD_LEFT));
	                }
	                // check non_preferred_time
	                elseif ($data[0]['@message'] == 'slot_collide_with_non_preferred_time') {
	                    $msg->set_message_exact('fail', $emp_name . ' ' . $source_data['date'] . ' ' . str_pad(sprintf('%.02f', $data[0]['@ctime_from']), 5, '0', STR_PAD_LEFT) . '-' . str_pad(sprintf('%.02f', $data[0]['@ctime_to']), 5, '0', STR_PAD_LEFT));
	                }
	                //check leave taken
	                elseif ($data[0]['@message'] == 'team_error') {
	                    $obj_smarty     = new smartySetup(array('messages.xml'), FALSE);
	                    $msg->set_message_exact('fail', $emp_name . ' ' . $obj_smarty->translate['is_not_team_member_of'] . ' ' . $cust_name);
	                }
	                return FALSE;
            	}
        	}
		}

		function update_slot_details($slot_id, $slot_details = array()) {

		        if(empty($slot_details)) return FALSE;
		        
		        $process_flag = TRUE;
		        $old_slot_det = $this->customer_employee_slot_details($slot_id);
		        if(empty($old_slot_det))
		            $process_flag = FALSE;
		        else if($old_slot_det['status'] == 2)   //restrict to edit leave slots
		            $process_flag = FALSE;
	        
		        if($process_flag){
		            $status = $old_slot_det['status'];
		            if ($status != 3 && $slot_details['employee'] != '' && $slot_details['customer'] != '')
		                $status = 1;
		            else if($status != 3 && ($slot_details['employee'] == '' || $slot_details['customer'] == ''))
		                $status = 0;

		            $this->tables = array('schedule_copy');
		            $this->fields = array('customer', 'employee', 'date', 'time_from', 'time_to', 
		                'fkkn', 'type', 'status');
		            $this->field_values = array($slot_details['customer'], $slot_details['employee'], $slot_details['date'], $slot_details['time_from'], $slot_details['time_to'],
		                $slot_details['fkkn'], $slot_details['type'], $status);
		            
		            if(array_key_exists('comment', $slot_details)){
		                $this->fields[] = 'comment';
		                $this->field_values[] = $slot_details['comment'];
		            }
		            $this->conditions = array('id = ?');
		            $this->condition_values = array($slot_id);
		            $process_flag = $this->query_update();
		        }
	        return $process_flag;
    	}

    	function schema_manual_entry_time_slots_multiAdd($template_id,$selected_date, $sketch_slots, $from_week, $to_week, $from_option, $sel_days, $saveTimeslot, $dont_show_flag, $allow_N_to_O_convertion = FALSE, $allow_split_slot = FALSE) {
    		if (empty($sketch_slots))
            return FALSE;

	        require_once ('plugins/message.class.php');
			require_once ('class/employee.php');
	        $msg = new message();
	        $obj_dona = new dona();
	        $obj_customer = new customer();
	        $obj_emp = new employee();

	        $first_slot_date = $selected_date;
	        $from_week = str_pad($from_week, 2, '0', STR_PAD_LEFT);
	        $to_week = str_pad($to_week, 2, '0', STR_PAD_LEFT);
	//        $allow_N_to_O_convertion = FALSE;
	//        $allow_split_slot = FALSE;
	        $normal_slot_types = array('0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16');
	        $oncall_slot_types = array('3', '9', '13', '14', '17');

	        $obj_dona->begin_transaction();
	        $obj_customer->begin_transaction();
	        $obj_emp->begin_transaction();
	        $assign_flag = true;

	        $already_checked_signing_dates = array();   //format: array( 'employee_name' => array( 'customer_name' => array( 'Y-m' => 1)))
	        foreach ($sketch_slots as $sketch_slot){
	        	$sketch_employee = $sketch_slot['employee'] != '' ? $sketch_slot['employee'] : NULL;
//            	$paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_week . '1'));
				$paste_start_date          = $first_slot_date;
				$paste_year                = substr($to_week, 0, 4);
				$paste_week                = str_pad(substr($to_week, 5), 2, '0', STR_PAD_LEFT);
				$paste_end_date            = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
				$paste_date                = $paste_start_date;
				$time_flag                 = 1;         //flag for checking oncall period availability
				$time_flag_next            = 1;    //flag for checking oncall period availability
				
				$slot_split_time_flag      = 0;
				$slot_split_time_flag_next = 0;

				while (strtotime($paste_date) <= strtotime($paste_end_date)){
					if (in_array((date('N', strtotime($paste_date)) % 7), $sel_days)){
						if ($sketch_slot['customer'] != '' && $sketch_slot['employee'] != '' && !isset($already_checked_signing_dates[$sketch_slot['employee']][$sketch_slot['customer']][date('Y-m', strtotime($paste_date))])) {
	                        // if ($this->chk_employee_rpt_signed($sketch_slot['employee'], $sketch_slot['customer'], $paste_date, TRUE) == 1) {
	                        //     $assign_flag = FALSE;
	                        //     $obj_customer->rollback_transaction();
	                        //     $obj_dona->rollback_transaction();
	                        //     return false;
	                        // }
	                            $already_checked_signing_dates[$sketch_slot['employee']][$sketch_slot['customer']][date('Y-m', strtotime($paste_date))] = 1;
	                    }
					
						if ($sketch_slot['time_from'] >= $sketch_slot['time_to']) {      
	                        $next_day = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
	                        if ($sketch_slot['customer'] != '' && $sketch_slot['employee'] != '' && !isset($already_checked_signing_dates[$sketch_slot['employee']][$sketch_slot['customer']][date('Y-m', strtotime($next_day))])) {
	                            /*if ($this->chk_employee_rpt_signed($sketch_slot['employee'], $sketch_slot['customer'], $next_day, TRUE) == 1) {
	                                $assign_flag = FALSE;
	                                $obj_customer->rollback_transaction();
	                                $obj_dona->rollback_transaction();
	                                return false;
	                            }*/
	                                $already_checked_signing_dates[$sketch_slot['employee']][$sketch_slot['customer']][date('Y-m', strtotime($next_day))] = 1;
	                        }

	                        $time_flag = 0;
	                        $time_flag_next = 0;
	                        $inconv_timings = $obj_emp->get_inconvenient_on_a_day_for_customer($paste_date, $sketch_slot['customer'], 3);
	                        $inconv_timings_next = $obj_emp->get_inconvenient_on_a_day_for_customer($next_day, $sketch_slot['customer'], 3);
	                        if (!empty($inconv_timings)) {
	                            foreach ($inconv_timings as $inconv_timing) {
	                                if (($sketch_slot['time_from'] >= $inconv_timing['time_from'] && $sketch_slot['time_from'] < $inconv_timing['time_to']) &&
	                                        (24 > $inconv_timing['time_from'] && 24 <= $inconv_timing['time_to'])) {
	                                    $time_flag = 1;
	                                }

	                                if ($allow_split_slot) {
	                                    if (($inconv_timing['time_from'] >= $sketch_slot['time_from'] && $inconv_timing['time_from'] <= 24) ||
	                                            ($inconv_timing['time_to'] >= $sketch_slot['time_from'] && $inconv_timing['time_to'] <= 24)) {
	                                        $slot_split_time_flag = 1;
	                                    }
	                                }
	                            }
	                        }
	                        if (!empty($inconv_timings_next)) {
	                            foreach ($inconv_timings_next as $inconv_timing) {
	                                if ((0 >= $inconv_timing['time_from'] && 0 < $inconv_timing['time_to']) &&
	                                        ($sketch_slot['time_to'] > $inconv_timing['time_from'] && $sketch_slot['time_to'] <= $inconv_timing['time_to'])) {
	                                    $time_flag_next = 1;
	                                }

	                                if ($allow_split_slot) {
	                                    if (($inconv_timing['time_from'] >= 0 && $inconv_timing['time_from'] <= $sketch_slot['time_to']) ||
	                                            ($inconv_timing['time_to'] >= 0 && $inconv_timing['time_to'] <= $sketch_slot['time_to'])) {
	                                        $slot_split_time_flag_next = 1;
	                                    }
	                                }
	                            }
	                        }
	                    }

	                    //if the time slot is on same day
	                    else {
	                        $time_flag = 0;
	                        $inconv_timings = $obj_emp->get_inconvenient_on_a_day_for_customer($paste_date, $sketch_slot['customer'], 3);
	                        if (!empty($inconv_timings)) {
	                            foreach ($inconv_timings as $inconv_timing) {
	                                if (($sketch_slot['time_from'] >= $inconv_timing['time_from'] && $sketch_slot['time_from'] < $inconv_timing['time_to']) &&
	                                        ($sketch_slot['time_to'] > $inconv_timing['time_from'] && $sketch_slot['time_to'] <= $inconv_timing['time_to'])) {
	                                    $time_flag = 1;
	                                }

	                                if ($allow_split_slot) {
	                                    if (($inconv_timing['time_from'] >= $sketch_slot['time_from'] && $inconv_timing['time_from'] <= $inconv_timing['time_to']) ||
	                                            ($inconv_timing['time_to'] >= $sketch_slot['time_from'] && $inconv_timing['time_to'] <= $inconv_timing['time_to'])) {
	                                        $slot_split_time_flag = 1;
	                                    }
	                                }
	                            }
	                        }
	                    }

	                    $calculated_slot_type = $sketch_slot['type'];
	                    $split_flag = FALSE;
	                    if (in_array($sketch_slot['type'], $normal_slot_types)) { //normal slot
	                        if ($time_flag == 1 && $time_flag_next == 1) {    //if both are on oncall boundary
	                            if ($allow_N_to_O_convertion)
	                                $calculated_slot_type = 3;
	                            else
	                                $calculated_slot_type = $sketch_slot['type']; //updated in 2014-06-07
	                        }
	                        else if ($slot_split_time_flag == 1 || $slot_split_time_flag_next == 1) {
	                            if ($allow_split_slot) {
	                                $calculated_slot_type = 3;
	                                $split_flag = TRUE;
	                            }
	                        } 
	                        else {
	                            $calculated_slot_type = $sketch_slot['type'];  //updated in 2014-06-07
	                        }
	                    } 
	                    else if (in_array($sketch_slot['type'], $oncall_slot_types) && $time_flag == 1 && $time_flag_next == 1) {  //oncall slot
	                        $calculated_slot_type = $sketch_slot['type']; //updated in 2014-06-07
	                    }
	                     else {
	                        $msg->set_message('fail', 'time_outside_oncall');
	                        $msg->set_message_exact('fail', str_pad(sprintf('%.02f', (float) $sketch_slot['time_from']), 5, '0', STR_PAD_LEFT) . ' - ' . str_pad(sprintf('%.02f', (float) $sketch_slot['time_to']), 5, '0', STR_PAD_LEFT) . ' => ' . $paste_date);
	                        $obj_customer->rollback_transaction();
	                        $obj_dona->rollback_transaction();
	                        $obj_emp->rollback_transaction();
	                        return false;
	                    }

	                    if ($sketch_slot['time_from'] >= $sketch_slot['time_to']) { //if the slot enters next day
	                        $cur_date = strtotime($paste_date . ' 00:00:00');
	                        $next_date = date('Y-m-d', ($cur_date + 24 * 3600));

	                        if (!$this->is_valid_slot($sketch_employee, $sketch_slot['time_from'], 24, $paste_date)) {
	                            $msg->set_message('fail', 'employee_not_available');
	                            $msg->set_message_exact('fail', sprintf('%.02f', round((float) $sketch_slot['time_from'], 2)) . '-' . sprintf('%.02f', round((float) 24, 2)) . ' => ' . $paste_date);
	                            $assign_flag = false;
	                            break;
	                        } else if (!$this->is_valid_slot($sketch_employee, 0, $sketch_slot['time_to'], $next_date)) {
	                            $msg->set_message('fail', 'employee_not_available');
	                            $msg->set_message_exact('fail', sprintf('%.02f', round((float) 0.00, 2)) . '-' . sprintf('%.02f', round((float) $sketch_slot['time_to'], 2)) . ' => ' . $paste_date);
	                            $assign_flag = false;
	                            break;
	                        } else {
	                            if ($split_flag) {
	                                $result_flag = TRUE;
	                                $inconv_timings = $obj_emp->get_collided_inconvenients_on_a_day_for_customer($paste_date, $sketch_slot['customer'], $sketch_slot['time_from'], 24, 3);
	                                $intervals = array();
	                                if (!empty($inconv_timings)) {
	                                    $total_count = count($inconv_timings);
	                                    $last_time_to = $sketch_slot['time_from'];
	                                    foreach ($inconv_timings as $key => $inconv_timing) {
	                                        $cur_time_from = $cur_time_to = $cur_time_type = '';
	                                        if ($inconv_timing['time_from'] <= $last_time_to) {
	                                            if ($key != 0 && $inconv_timing['time_from'] != $last_time_to) {
	                                                $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
	                                                $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
	                                                $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
	                                            }
	                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
	                                            $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
	                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
	                                        } else if ($inconv_timing['time_from'] > $last_time_to) {
	                                            //                                    if($key == 0){
	                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
	                                            $cur_time_to = $inconv_timing['time_from'];
	                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
	                                            //                                    }

	                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
	                                            $cur_time_to = $inconv_timing['time_to'];
	                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
	                                        }

	                                        $last_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
	                                        if ($key == $total_count - 1 && $inconv_timing['time_to'] < 24) {
	                                            $cur_time_from = $last_time_to;
	                                            $cur_time_to = 24;
	                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
	                                        }
	                                    }
	                                } else {
	                                    $cur_time_from = $sketch_slot['time_from'];
	                                    $cur_time_to = 24;
	                                    $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $paste_date);
	                                }

	                                $next_day_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
	                                $inconv_timings_next = $obj_emp->get_collided_inconvenients_on_a_day_for_customer($next_day_date, $sketch_slot['customer'], 0, $sketch_slot['time_to'], 3);
	                                if (!empty($inconv_timings_next)) {
	                                    $total_count = count($inconv_timings_next);
	                                    $last_time_to = 0;
	                                    foreach ($inconv_timings_next as $key => $inconv_timing) {
	                                        $cur_time_from = $cur_time_to = $cur_time_type = '';
	                                        if ($inconv_timing['time_from'] <= $last_time_to) {
	                                            if ($key != 0 && $inconv_timing['time_from'] != $last_time_to) {
	                                                $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
	                                                $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
	                                                $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                            }
	                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
	                                            $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
	                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                        } else if ($inconv_timing['time_from'] > $last_time_to) {
	                                            //                                    if($key == 0){
	                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
	                                            $cur_time_to = $inconv_timing['time_from'];
	                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                            //                                    }
	                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
	                                            $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
	                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                        }

	                                        $last_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
	                                        if ($key == $total_count - 1 && $inconv_timing['time_to'] < $sketch_slot['time_to']) {
	                                            $cur_time_from = $last_time_to;
	                                            $cur_time_to = $sketch_slot['time_to'];
	                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                        }
	                                    }
	                                } else {
	                                    $cur_time_from = 0;
	                                    $cur_time_to = $sketch_slot['time_to'];
	                                    $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
	                                }

	                                if(!empty($intervals)){
	                                    foreach ($intervals as $interval) {
	                                        if ($interval['time_from'] == $interval['time_to'])
	                                            continue;
	                                        if ($this->customer_employee_slot_add($template_id,$sketch_employee, $sketch_slot['customer'], $interval['date'], $interval['time_from'], $interval['time_to'], $_SESSION['user_id'], 1, $interval['type'], '', $sketch_slot['comment'])) {
	                                            // if ($sketch_slot['customer'] != '' && $saveTimeslot == 1)
	                                            //     $obj_customer->add_memory_slot($sketch_slot['customer'], $interval['time_from'], $interval['time_to'], $interval['type']);
	                                        }
	                                        else {
	                                            $result_flag = FALSE;
	                                            break;
	                                        }
	                                    }
	                                }
	                                if (!$result_flag) {
	                                    $msg->set_message('fail', 'slot_operation_failed');
	                                    $assign_flag = false;
	                                    break;
	                                }
	                            } else {
	                                if ($this->customer_employee_slot_add($template_id,$sketch_employee, $sketch_slot['customer'], $paste_date, $sketch_slot['time_from'], 24, $_SESSION['user_id'], $sketch_slot['fkkn'], $calculated_slot_type, '', $sketch_slot['comment'])) {
	                                    // if ($sketch_slot['customer'] != '' && $saveTimeslot == 1)
	                                    //     $obj_customer->add_memory_slot($sketch_slot['customer'], $sketch_slot['time_from'], 24, $calculated_slot_type);

	                                    if ($this->customer_employee_slot_add($template_id,$sketch_employee, $sketch_slot['customer'], $next_date, 0, $sketch_slot['time_to'], $_SESSION['user_id'], $sketch_slot['fkkn'], $calculated_slot_type, '', $sketch_slot['comment'])) {
	                                        // if ($sketch_slot['customer'] != '' && $saveTimeslot == 1)
	                                        //     $obj_customer->add_memory_slot($sketch_slot['customer'], 0, $sketch_slot['time_to'], $calculated_slot_type);
	                                    } 
	                                    else {
	                                        $msg->set_message('fail', 'slot_operation_failed');
	                                        $assign_flag = false;
	                                        break;
	                                    }
	                                } else {
	                                    $msg->set_message('fail', 'slot_operation_failed');
	                                    $assign_flag = false;
	                                    break;
	                                }
	                            }
	                        }
	                    } 

	                    else {//if the time slot is on same day
	                        //---------------------------------------------------------------------------
	                        //checking the time is valid
	                        if ($this->is_valid_slot($sketch_employee, $sketch_slot['time_from'], $sketch_slot['time_to'], $paste_date)) {
	                            if ($split_flag) {
	                                $result_flag = TRUE;
	                                $inconv_timings = $obj_emp->get_collided_inconvenients_on_a_day_for_customer($paste_date, $sketch_slot['customer'], $sketch_slot['time_from'], $sketch_slot['time_to'], 3);
	                                $intervals = array();
	                                if (!empty($inconv_timings)) {
	                                    $total_count = count($inconv_timings);
	                                    $last_time_to = $sketch_slot['time_from'];
	                                    foreach ($inconv_timings as $key => $inconv_timing) {
	                                        $cur_time_from = $cur_time_to = $cur_time_type = '';
	                                        if ($inconv_timing['time_from'] <= $last_time_to) {
	                                            if ($key != 0 && $inconv_timing['time_from'] != $last_time_to) {
	                                                $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
	                                                $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
	                                                $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                            }
	                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
	                                            $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
	                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                        } else if ($inconv_timing['time_from'] > $last_time_to) {
	                                            //                                    if($key == 0){
	                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $last_time_to);
	                                            $cur_time_to = $inconv_timing['time_from'];
	                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                            //                                    }
	                                            $cur_time_from = ($inconv_timing['time_from'] < $sketch_slot['time_from'] ? $sketch_slot['time_from'] : $inconv_timing['time_from']);
	                                            $cur_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
	                                            $cur_time_type = in_array($calculated_slot_type, $oncall_slot_types) ? $calculated_slot_type : 3;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                        }

	                                        $last_time_to = ($inconv_timing['time_to'] <= $sketch_slot['time_to'] ? $inconv_timing['time_to'] : $sketch_slot['time_to']);
	                                        if ($key == $total_count - 1 && $inconv_timing['time_to'] < $sketch_slot['time_to']) {
	                                            $cur_time_from = $last_time_to;
	                                            $cur_time_to = $sketch_slot['time_to'];
	                                            $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                        }
	                                    }
	                                } else {
	                                    $cur_time_from = $sketch_slot['time_from'];
	                                    $cur_time_to = $sketch_slot['time_to'];
	                                    $cur_time_type = in_array($calculated_slot_type, $normal_slot_types) ? $calculated_slot_type : 0;
	                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
	                                }

	                                if(!empty($intervals)){
	                                    foreach ($intervals as $interval) {
	                                        if ($interval['time_from'] == $interval['time_to'])
	                                            continue;
	                                        if ($this->customer_employee_slot_add($template_id,$sketch_employee, $sketch_slot['customer'], $paste_date, $interval['time_from'], $interval['time_to'], $_SESSION['user_id'], $sketch_slot['fkkn'], $interval['type'], '', $sketch_slot['comment'])) {
	                                            
	                                            // if ($sketch_slot['customer'] != '' && $saveTimeslot == 1)
	                                            //     $obj_customer->add_memory_slot($sketch_slot['customer'], $interval['time_from'], $interval['time_to'], $interval['type']);
	                                        }
	                                        else {
	                                            $result_flag = FALSE;
	                                            break;
	                                        }
	                                    }
	                                }
	                                if (!$result_flag) {
	                                    $msg->set_message('fail', 'slot_operation_failed');
	                                    var_dump('expression');
	                                    $assign_flag = false;
	                                    break;
	                                }
	                            } else {
	                                if ($this->customer_employee_slot_add($template_id,$sketch_employee, $sketch_slot['customer'], $paste_date, $sketch_slot['time_from'], $sketch_slot['time_to'], $_SESSION['user_id'], $sketch_slot['fkkn'], $calculated_slot_type, '', $sketch_slot['comment'])) {
	                                    // if ($sketch_slot['customer'] != '' && $saveTimeslot == 1)
	                                    //     $obj_customer->add_memory_slot($sketch_slot['customer'], $sketch_slot['time_from'], $sketch_slot['time_to'], $calculated_slot_type);
	                                }
	                                else {
	                                    $msg->set_message('fail', 'slot_operation_failed');
	                                    var_dump('expression');
	                                    $assign_flag = false;
	                                    break;
	                                }
	                            }
	                        } 
	                        else {
	                            $msg->set_message('fail', 'employee_not_available');
	                            $msg->set_message_exact('fail', sprintf('%.02f', round((float) $sketch_slot['time_from'], 2)) . '-' . sprintf('%.02f', round((float) $sketch_slot['time_to'], 2)) . ' => ' . $paste_date);
	                            $assign_flag = false;
	                            break;
	                        }
	                 	}
	                }
	                if (date('N', strtotime($paste_date)) == 7)
                    	$paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +' . $from_option . ' week'));
                		$paste_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
				}
	        }
	        if ($assign_flag) {
            	$msg->set_message('success', 'slot_operation_success');
            	$obj_customer->commit_transaction();
            	$obj_dona->commit_transaction();
            	$obj_emp->commit_transaction();
            	return true;
        	} 
        	else {
//           	$msg->set_message('fail', 'slot_operation_failed');
            	$obj_customer->rollback_transaction();
            	$obj_dona->rollback_transaction();
            	$obj_emp->rollback_transaction();
            	return false;
        	}
		}

		function customer_employee_multi_slot_details($ids, $status = NULL) {
	        $this->tables = array('schedule_copy');
	        $this->fields = array('id','tid','customer', 'employee', 'fkkn', 'status', 'alloc_emp', 'time_from', 'time_to', 'type', 'date', 'relation_id', '(SELECT first_name FROM employee where username = schedule_copy.employee) AS emp_first_name', '(SELECT last_name FROM employee where username = schedule_copy.employee) AS emp_last_name');
	        if ($status != NULL) {
	            $this->conditions = array('AND', array('IN', 'id', $ids), 'status = ?');
	            $this->condition_values = array($status);
	        } else {
	            $this->conditions = array('AND', array('IN', 'id', $ids));
	        }
	        $this->order_by = array('date', 'time_from', 'time_to');
	        $this->query_generate();
	        $datas = $this->query_fetch();
	        return $datas;
	    }

	    function check_given_slots_copiable_between_dates($slot_details, $start_date, $end_date, $check_type, $customer = '', $employee = '', $manned = 1) {
	        $msg = new message();
	        $obj_copy_paste = new copy_paste();
	        if ($customer != '') {
	            //gettings distinct employees from slots to copy

	            $this->employees = $this->get_distinct_employees_from_given_slots($slot_details);
	            $target_slots = $this->get_employee_slot_between_dates($this->employees, $start_date, $end_date, array());
	            $obj_copy_paste->employees = $this->employees;

            	// exit('collide');

	            // echo "<pre>".print_r($target_slots,1)."</pre>";
	            // exit('g');
	            // $leave_timings = $this->get_employee_leave_between_dates($this->employees, $start_date, $end_date);
	            //check these employees are activeemployees are active
	            //echo "<pre>".print_r($target_slots,1)."</pre>";
	            
	            if (!$obj_copy_paste->check_given_employees_are_active($this->employees)) {
	                $msg->set_message('fail', 'employee_is_inactive');
	                return FALSE;
	            }
	            else if (!$obj_copy_paste->check_given_customers_are_active(array($customer))) {
	                $msg->set_message('fail', 'customer_is_inactive');
	                return FALSE;
	            } 
	            else if (!$obj_copy_paste->check_given_slots_colliding_with_target_slots($slot_details, $target_slots, $check_type)) {
	                $msg->set_message('fail', 'slot_collide');
	                return FALSE;
	            } 
	            else if (!$obj_copy_paste->check_given_slots_colliding_with_target_slots($slot_details, $leave_timings, $check_type)) {
	                $msg->set_message('fail', 'employee_took_a_leave');
	                return FALSE;
	            } 
	            else if (!$obj_copy_paste->check_employees_in_customer_team($this->employees, $customer)) {
	                $msg->set_message('fail', 'team_error');
	                return FALSE;
	            } 
	            /*else if (!$this->check_employees_signed_between_dates($this->employees, $customer, $start_date, $end_date)) {
	                
	                $msg->set_message('fail', 'employee_signed_in');
	                return FALSE;
	            }*/ 
	            else if (!$obj_copy_paste->check_oncall_slot_range_permissible($slot_details, $customer, $start_date, $end_date, $check_type)) {
	                $msg->set_message('fail', 'time_outside_oncall');
	                return FALSE;
	            } 
	            else if ($check_type != 1) {
	                if (!$obj_copy_paste->check_slots_colllide_internally($slot_details, $start_date, $end_date, $check_type)) {

	                    $msg->set_message('fail', 'copy_colliding_slots_to_same_daay');
	                    return FALSE;
	                } 
	                else {
	                    return TRUE;
	                }
	            }
	            return TRUE;
	        }
	    }

	    function get_distinct_employees_from_given_slots($slot_details) {
	        $employees = array();
	        foreach ($slot_details as $slot_detail) {
	            if (!in_array($slot_detail['employee'], $employees) && $slot_detail['employee'] != '')
	                $employees[] = $slot_detail['employee'];
	            $emp_name = $_SESSION['company_sort_by'] == 1 ? $slot_detail['emp_first_name'] . " " . $slot_detail['emp_last_name'] : $slot_detail['emp_last_name'] . " " . $slot_detail['emp_first_name'];
	            $this->employee_details[$slot_detail['employee']] = $emp_name;
	        }
	        return $employees;
	    }

	    function get_distinct_customers_from_given_slots($slot_details) {
	        $customers = array();
	        foreach ($slot_details as $slot_detail) {
	            if (!in_array($slot_detail['customer'], $customers) && $slot_detail['customer'] != '')
	                $customers[] = $slot_detail['customer'];
	        }
	        return $customers;
	    }

	    function get_employee_slot_between_dates($employees, $start_date, $end_date, $customers) {
	        $customers_string = "";

	        $employees_string = "'" . implode("','", $employees) . "'";
	        $this->sql_query = "SELECT *, (SELECT first_name FROM employee where username = schedule_copy.employee) AS emp_first_name, (SELECT last_name FROM employee where username = schedule_copy.employee) AS emp_last_name FROM schedule_copy WHERE status IN(0,1) AND employee IN(" . $employees_string . ") AND date between '" . $start_date . "' AND '" . $end_date . "' AND tid = '" . $this->template_id . "'";
	        if (!empty($customers)) {
	            $customers_string = "'" . implode("','", $customers) . "'";
	            $this->sql_query .= " AND customer IN(" . $customers_string . ")";
	        }
	        $this->sql_query;
	        $datas = $this->query_fetch();
	        return $datas;
	    }

	    function customer_employee_multiple_slot_direct_add($slot_datas) {
	        /**
	         * @author: Shamsudheen <shamsu@arioninfotech.com>
	         * for: multiple slot adding with single db request
	         * This function maily used in $employee->copy_weeks()
	         * @warning: order and length of array values should be equal/same
	         * @since: 2014-09-17
	         */
	        $input_array = array();
	        if(!empty($slot_datas)){
	            foreach($slot_datas as $slot_data){
	                if(empty($slot_data)) continue;
	                $input_array[] = array($slot_data['employee'], $slot_data['customer'], $slot_data['fkkn'], $slot_data['type'], $slot_data['date'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['status'],$slot_data['alloc_emp'], $slot_data['comment'], $slot_data['relation_id'],$slot_data['tid']);
	            }
	        }
	        // echo "<pre>".print_r($input_array,1)."</pre>";
	        // exit('fg');
	        if(empty($input_array)) return FALSE;
	        
	        $this->tables = array('schedule_copy');
	        $this->fields = array('employee', 'customer', 'fkkn', 'type', 'date', 'time_from', 'time_to', 'status','alloc_emp', 'comment', 'relation_id','tid');
	        $this->field_values = $input_array;
	        return $this->query_insert();
	    }

	    function get_datas_customer_employee_slot_add($employee, $customer, $date, $time_from, $time_to, $alloc_emp, $fkkn = NULL, $type = 0, $relation_id = NULL, $comment = null, $status = 1) {
	        /**
	         * @author: Shamsudheen <shamsu@arioninfotech.com>
	         * for: this function will return datas for adding records to timetable asper calling parameter
	         * return data logics is derived from the function $dona->customer_employee_slot_add()
	         * This function maily used in $employee->copy_weeks()
	         * @since: 2014-09-17
	         */
	        if($time_from == $time_to) return array();
	        
	        $created_status = ($status == 4 ? 1 : NULL);
	        
	        if($fkkn == NULL){
	            if ($customer != '') {
	                $cust_detail = $this->get_customer_details($customer);
	                $fkkn = (!empty($cust_detail) ? $cust_detail[0]['fkkn'] : 1);
	            }else
	                $fkkn = 1;
	        }
	       
	        if ($employee == '' || $customer == '') {
	            $status = 0;
	            $relation_id = NULL;
	        }
	        if ($_SESSION['user_role'] == 4) $status = 3; 
	        if($comment == NULL || $comment == "") $comment = NULL;
	        if($relation_id == '') $relation_id = NULL;

	        $return_array = array(
	            'employee'  => $employee, 
	            'customer'  => $customer, 
	            'fkkn'      => $fkkn, 
	            'type'      => $type, 
	            'date'      => $date, 
	            'time_from' => $time_from, 
	            'time_to'   => $time_to, 
	            'status'    => $status, 
	            'alloc_emp' => $alloc_emp, 
	            'comment'   => $comment,
	            'relation_id'=> $relation_id);
	        
	        return $return_array;
	    }

	    function check_given_slots_copiable($slot_details, $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times){
    		$msg = new message();
        	$obj_copy_paste = new copy_paste();
        	$this->employees = $this->get_distinct_employees_from_given_slots($slot_details);
        	$this->customers = $this->get_distinct_customers_from_given_slots($slot_details);
        	$target_slots  =  $this->get_employee_slot_between_dates($this->employees, $paste_start, $paste_end,array());
        	$obj_copy_paste->employees = $this->employees;
        	$obj_copy_paste->customers = $this->customers;
        	// echo "<pre>".print_r($this->employees,1)."</pre>";
	        // echo "<pre>".print_r($slot_details,1)."</pre>";
	        // echo "<pre>".print_r($target_slots,1)."</pre>";
	        // EXIT();

	        if (!$obj_copy_paste->check_given_employees_are_active($this->employees)) {
	            $msg->set_message('fail', 'employee_is_inactive');
	            return FALSE;
	        } 
	        elseif (!$obj_copy_paste->check_given_customers_are_active($this->customers)) {
	            $msg->set_message('fail', 'customer_is_inactive');
	            return FALSE;
	        } 
	        elseif (!$obj_copy_paste->check_employees_in_customer_team($this->employees, $this->customers[0])) {
	            $msg->set_message('fail', 'team_error');
	            return FALSE;
	        } 

	        /*elseif (!$this->check_employees_signed_between_dates($this->employees, $customer, $paste_start, $paste_end)) {
	            $msg->set_message('fail', 'employee_signed_in');
	            return FALSE;
	        } */

	        elseif (!$obj_copy_paste->check_given_slots_colliding_with_target_slots_datewise($slot_details, $target_slots, $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times)) {
	            $msg->set_message('fail', 'slot_collide');
	            return FALSE;
	        } 
	        elseif (!$obj_copy_paste->check_given_slots_colliding_with_target_slots_datewise($slot_details, $leave_timings, $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times)) {
	            $msg->set_message('fail', 'employee_took_a_leave');
	            return FALSE;
	        } 
	        elseif (!$obj_copy_paste->check_oncall_slot_range_permissible_datewise($slot_details, $this->customers[0], $copy_start, $copy_end, $paste_start, $paste_end, $no_of_times)) {
	            $msg->set_message('fail', 'time_outside_oncall');
	            return FALSE;
	        }
	        return TRUE;

	    }

	    //removing the whole time_slot 
	    function customer_employee_slot_remove($id) {
	        $obj_emp = new employee();
	        $slot_det = $this->customer_employee_slot_details($id);
	        $this->tables = array('schedule_copy');
	        $this->conditions = array('id = ?');
	        $this->condition_values = array($id);
	        if ($this->query_delete()) {

	            /*if ($slot_det['employee'] && $slot_det['customer'])
	                $obj_emp->removeATL($slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['customer']);*/
	            return true;
	        }
	        else
	            return false;
	    }

	    //removing employee from a particular slot
	    function remove_from_slot($id, $alloc_emp = null) {
	        $slot_det = $this->customer_employee_slot_details($id);
	        $this->tables = array('schedule_copy');
	        if ($alloc_emp == null) {
	            $this->fields = array('employee', 'status');
	            $this->field_values = array(NULL, '0');
	        } else {
	            $this->fields = array('employee', 'status', 'alloc_emp');
	            $this->field_values = array(NULL, '0', $alloc_emp);
	        }
	        $this->conditions = array('id = ?');
	        $this->condition_values = array($id);
	        if ($this->query_update()) {
	            // if ($slot_det['employee'])
	            //     // $this->removeATL($slot_det['employee'], $slot_det['date'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['customer']);
	            return true;
	        } else {
	            return false;
	        }
	    }

	    function check_overlap_slots($ids, $emp){
//            $team = new team();
            $id_slots = explode("-", $ids);
            
            // get the distinct date of the slots passed to the function
            $dates = $this->get_distinct_dates_for_slots($id_slots);
            $overlap = '';
            for($i=0;$i<count($dates);$i++){
                $this->flush();
                $this->tables = array('schedule_copy');
                $this->fields = array('time_from','time_to','date','id');
                $this->conditions = array('AND','date = ?');
                $this->condition_values[] = $dates[$i]['date'];
                $conditions = array('OR');
                for($j=0;$j<count($id_slots);$j++){
                   $conditions[] = 'id = ?';
                   $this->condition_values[] = $id_slots[$j];
                }
                $conditions[] = 'employee = ?';
                $this->condition_values[] = $emp;
                $this->conditions[] = $conditions;
                $this->query_generate();
                $data1 = $this->query_fetch();
                $array_count = count($data1);
                for($j=0;$j<$array_count;$j++){
                    $left_slot[0] = $data1[$j]['time_from'];
                    $left_slot[1] = $data1[$j]['time_to'];
                    for($k=0;$k<$array_count;$k++){
                        if($j != $k){
                            $right_slot[0] = $data1[$k]['time_from'];
                            $right_slot[1] = $data1[$k]['time_to'];
                            if(($left_slot[0] > $right_slot[0] && $left_slot[0] < $right_slot[1]) || ($left_slot[1] > $right_slot[0] && $left_slot[1] < $right_slot[1]) || ($left_slot[0] == $right_slot[0] && $left_slot[1] == $right_slot[1])){
                                $overlap = $data1[$j]['date'] . '=>' . $left_slot[0]."-".$left_slot[1]." & ".$right_slot[0]."-".$right_slot[1];
                                break; 
                           }
                        }
                    }
                    if($k != $array_count){
                        break;
                    }
                }
                if($j != $array_count){
                    break;
                }
            }
            if($i != count($dates)){
//                return 'overlap '.$overlap;
                return $overlap;
            }else{
                return 'sucess';
            }
        }

        function get_distinct_dates_for_slots($ids){
	        $this->tables = array('schedule_copy');
	        $this->fields = array('DISTINCT(date) as date');
	        $this->conditions[] = 'OR';
	        for($i=0;$i<count($ids) - 1;$i++){
	            $this->conditions[] = 'id = ?';
	            $this->condition_values[] = $ids[$i];
	        }
	        $this->query_generate();
	        $data = $this->query_fetch();
	        if($data){
	            return $data;
	        }else{
	            return array();
	        }
	    }

	    function employee_add_to_slot_multiple($ids, $select_emp, $alloc_emp) {
			//        $msg = new message();
	        $ids_array = explode(',', $ids);

	        /* $fkkn = 1;
	          if($select_emp != ''){
	          $emp_detail = $this->get_employee_detail($select_emp);
	          if(!empty($emp_detail)){
	          $fkkn = $emp_detail['fkkn'];
	          }
	          } */
	        
	        $process_flag = TRUE;
	        for ($i = 0; $i < count($ids_array); $i++) {
	            $slot_det = $this->customer_employee_slot_details($ids_array[$i]);
	            $status = $slot_det['status'];

	            if ($status != 3 && $slot_det['customer'] != '')
	                $status = 1;
	            //$this->checkATL($select_emp, $slot_det['date'], $slot_det['time_from'], $slot_det['time_to']); // removed becoz of prechecking of ATL

	            $this->tables = array('schedule_copy');
	            $this->fields = array('status', 'employee', 'alloc_emp');
	            $this->field_values = array($status, $select_emp, $alloc_emp);
	            $this->conditions = array('id = ?');
	            $this->condition_values = array($ids_array[$i]);
	            if(!$this->query_update()){
	                $process_flag = FALSE;
	                break;
	            }
	        }
	        return $process_flag;
	    }

	     /// setting up slot type fkkkn
	    function employee_fkkn_update($id, $type) {
	        $this->tables = array('schedule_copy');
	        $this->fields = array('fkkn');
	        $this->field_values = array($type);
	        $this->conditions = array('id = ?');
	        $this->condition_values = array($id);
	        return $this->query_update();
	    }

	    function employee_slot_type_update($id, $type, $time_from = '', $time_to = '', $customer = NULL) {
	        /**
	         * @author: Unknown
	         * @lastedited: Shamsudheen <shamsu@arioninfotech.com> on 17-08-2013
	         * @edited-for: include $customer parameter - used in(slot type change to personal Meeting -ajax alloc action.php)
	         * 
	         */
	        /* if ($type == 0) {
	          $status = 1;
	          $slot_det = $this->customer_employee_slot_details($id);
	          if ($slot_det['customer'] == '' || $slot_det['employee'] == '')
	          $status = 0;
	          $this->tables = array('timetable');
	          $this->fields = array('type', 'status');
	          $this->field_values = array($type, $status);
	          $this->conditions = array('id = ?');
	          $this->condition_values = array($id);
	          if ($this->query_update()) {
	          return true;
	          } else {
	          return false;
	          }
	          } else { */
	        $slot_det = $this->customer_employee_slot_details($id);
	        $slot_from = $slot_det['time_from'];
	        $slot_to = $slot_det['time_to'];
	        if ($time_from == '' && $time_to == "") {
	            $this->tables = array('schedule_copy');
	            $this->fields = array('type');
	            $this->field_values = array($type);
	            $this->conditions = array('id = ?');
	            $this->condition_values = array($id);
	            if ($this->query_update())
	                return true;
	            else
	                return false;
	        }
	        else if ($time_from == $slot_from && $time_to == $slot_to) {// for same shift only changing the type and status 1
	            $this->tables = array('schedule_copy');
	            $this->fields = array('type');
	            $this->field_values = array($type);
	            $this->conditions = array('id = ?');
	            $this->condition_values = array($id);

	            if ($customer != NULL) {
	                $this->fields[] = 'customer';
	                $this->field_values[] = $customer;
	                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
	                    $this->fields[] = 'status';
	                    $this->field_values[] = 1;
	                }
	            }

	            if ($this->query_update())
	                return true;
	            else
	                return false;
	        }
	        else if ($time_from == $slot_from && $time_to != $slot_to && $time_to < $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
	            $this->tables = array('schedule_copy');
	            if ($customer != NULL) {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
	                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
	                }
	            } else {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	            }

	            if ($this->query_insert()) {
	                $this->tables = array('schedule_copy');
	                $this->fields = array('time_from');
	                $this->field_values = array($time_to);
	                $this->conditions = array('id = ?');
	                $this->condition_values = array($id);
	                if ($this->query_update()) {
	                    return true;
	                } else {
	                    return false;
	                }
	            } else {
	                return false;
	            }
	        } else if ($time_from == $slot_from && $time_to != $slot_to && $time_to > $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
	            $this->tables = array('schedule_copy');
	            if ($customer != NULL) {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
	                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
	                }
	            } else {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	            }
	            $this->conditions = array('id = ?');
	            $this->condition_values = array($id);

	            if ($this->query_update()) {
	                return true;
	            } else {
	                return false;
	            }
	        } else if ($time_from != $slot_from && $time_to == $slot_to && $time_from > $slot_from) {// if slot add on the end --- adding new slot with new type, and status 1 and updating existing
	//                $slot_det = $this->customer_employee_slot_details($id);
	            $this->tables = array('schedule_copy');
	            if ($customer != NULL) {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
	                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
	                }
	            } else {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	            }
	            if ($this->query_insert()) {
	                $this->tables = array('schedule_copy');
	                $this->fields = array('time_to');
	                $this->field_values = array($time_from);
	                $this->conditions = array('id = ?');
	                $this->condition_values = array($id);
	                if ($this->query_update()) {
	                    return true;
	                } else {
	                    return false;
	                }
	            } else {
	                return false;
	            }
	        } else if ($time_from != $slot_from && $time_to == $slot_to && $time_from < $slot_from) {// if slot add on the end --- adding new slot with new type, and status 1 and updating existing
	//                $slot_det = $this->customer_employee_slot_details($id);
	            $this->tables = array('schedule_copy');
	            if ($customer != NULL) {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
	                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
	                }
	            } else {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	            }
	            $this->conditions = array('id = ?');
	            $this->condition_values = array($id);
	            if ($this->query_update()) {
	                return true;
	            } else {
	                return false;
	            }
	        } else if ($time_from != $slot_from && $time_to != $slot_to && $time_from < $slot_from && $time_to > $slot_to) {// if slot add on the end --- adding new slot with new type, and status 1 and updating existing
	//                $slot_det = $this->customer_employee_slot_details($id);
	            $this->tables = array('schedule_copy');
	            if ($customer != NULL) {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
	                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
	                }
	            } else {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	            }
	            $this->conditions = array('id = ?');
	            $this->condition_values = array($id);
	            if ($this->query_update()) {
	                return true;
	            } else {
	                return false;
	            }
	        } else if ($time_from != $slot_from && $time_to != $slot_to && $time_from < $slot_from && $time_to < $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
	            $this->tables = array('schedule_copy');
	            if ($customer != NULL) {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
	                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
	                }
	            } else {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	            }

	            if ($this->query_insert()) {
	                $this->tables = array('schedule_copy');
	                $this->fields = array('time_from');
	                $this->field_values = array($time_to);
	                $this->conditions = array('id = ?');
	                $this->condition_values = array($id);
	                if ($this->query_update()) {
	                    return true;
	                } else {
	                    return false;
	                }
	            } else {
	                return false;
	            }
	        } else if ($time_from != $slot_from && $time_to != $slot_to && $time_from > $slot_from && $time_to > $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
	            $this->tables = array('schedule_copy');
	            if ($customer != NULL) {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	                if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
	                    $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                    $this->field_values = array($slot_det['employee'], $customer, $type, $slot_det['date'], $time_from, $time_to, 1, $slot_det['alloc_emp'], $slot_det['fkkn']);
	                }
	            } else {
	                $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	                $this->field_values = array($slot_det['employee'], $slot_det['customer'], $type, $slot_det['date'], $time_from, $time_to, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']);
	            }
	            if ($this->query_insert()) {
	                $this->tables = array('schedule_copy');
	                $this->fields = array('time_to');
	                $this->field_values = array($time_from);
	                $this->conditions = array('id = ?');
	                $this->condition_values = array($id);
	                if ($this->query_update()) {
	                    return true;
	                } else {
	                    return false;
	                }
	            } else {
	                return false;
	            }
	        } else {// if slot adds in between updating exiting with new type and status 1 and adding new 2 slots with previous data
	//                $slot_det = $this->customer_employee_slot_details($id);
	            $this->tables = array('schedule_copy');
	            $this->fields = array('employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'status', 'alloc_emp', 'fkkn');
	            $this->field_values = array(array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $slot_det['time_from'], $time_from, $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']),
	                array($slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_to, $slot_det['time_to'], $slot_det['status'], $slot_det['alloc_emp'], $slot_det['fkkn']));
	            if ($this->query_insert()) {
	                $this->tables = array('schedule_copy');
	                $this->fields = array('time_from', 'time_to', 'type', 'status', 'fkkn');
	                $this->field_values = array($time_from, $time_to, $type, $slot_det['status'], $slot_det['fkkn']);

	                if ($customer != NULL) {
	                    $this->fields[] = 'customer';
	                    $this->field_values[] = $customer;
	                    if ($slot_det['status'] != 2 && $slot_det['employee'] != '') {
	                        $this->fields[] = 'status';
	                        $this->field_values[] = 1;
	                    }
	                }

	                $this->conditions = array('id = ?');
	                $this->condition_values = array($id);
	                if ($this->query_update()) {
	                    return true;
	                } else {
	                    return false;
	                }
	            } else {
	                return false;
	            }
	        }
	        //}
	    }

	    function employee_slot_split($id, $time_from = '', $time_to = '') {

			$slot_det  = $this->customer_employee_slot_details($id);
			$slot_from = $slot_det['time_from'];
			$slot_to   = $slot_det['time_to'];
	        if ($time_from == $slot_from && $time_to == $slot_to) {// for same shift nothing do
	            return true;
	        } else if ($time_from == $slot_from && $time_to != $slot_to) { // if slot added on the beginning -- adding new slot with new type, and status 1 and updating existing
	            $this->tables = array('schedule_copy');
	            $this->fields = array('tid','employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'fkkn', 'status', 'relation_id', 'alloc_emp');
	            $this->field_values = array($slot_det['tid'],$slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_from, $time_to, $slot_det['fkkn'], $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']);
	            if ($this->query_insert()) {
	                $this->tables = array('schedule_copy');
	                $this->fields = array('time_from');
	                $this->field_values = array($time_to);
	                $this->conditions = array('id = ?');
	                $this->condition_values = array($id);
	                return $this->query_update();
	            } else {
	                return false;
	            }
	        } else if ($time_from != $slot_from && $time_to == $slot_to) {// if slot add on the end --- adding new slot with new type, and status 1 and updating existing
	            $slot_det = $this->customer_employee_slot_details($id);
	            $this->tables = array('schedule_copy');
	            $this->fields = array('tid','employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'fkkn', 'status', 'relation_id', 'alloc_emp');
	            $this->field_values = array($slot_det['tid'],$slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_from, $time_to, $slot_det['fkkn'], $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']);
	            if ($this->query_insert()) {
	                $this->tables = array('schedule_copy');
	                $this->fields = array('time_to');
	                $this->field_values = array($time_from);
	                $this->conditions = array('id = ?');
	                $this->condition_values = array($id);
	                return $this->query_update();
	            } else {
	                return false;
	            }
	        } else {// if slot adds in between updating exiting with new type and status 1 and adding new 2 slots with previous data
	            $slot_det = $this->customer_employee_slot_details($id);
	            $this->tables = array('schedule_copy');
	            $this->fields = array('tid','employee', 'customer', 'type', 'date', 'time_from', 'time_to', 'fkkn', 'status', 'relation_id', 'alloc_emp');
	            $this->field_values = array(array($slot_det['tid'],$slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $slot_det['time_from'], $time_from, $slot_det['fkkn'], $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']),
	                array($slot_det['tid'],$slot_det['employee'], $slot_det['customer'], $slot_det['type'], $slot_det['date'], $time_to, $slot_det['time_to'], $slot_det['fkkn'], $slot_det['status'], $slot_det['relation_id'], $slot_det['alloc_emp']));
	            if ($this->query_insert()) {
	                $this->tables = array('schedule_copy');
	                $this->fields = array('time_from', 'time_to');
	                $this->field_values = array($time_from, $time_to);
	                $this->conditions = array('id = ?');
	                $this->condition_values = array($id);
	                return $this->query_update();
	            } else {
	                return false;
	            }
	        }
	    }

	    function copy_single_slot_to_multiple($template_id , $id, $from_wk, $to_wk, $from_option, $with_user, $days) {
	        require_once ('plugins/message.class.php');
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
	            $from_wk = str_pad($from_wk, 2, '0', STR_PAD_LEFT);
	            $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($data['date'])) . "W" . $from_wk . '1'));
	        }

	        $paste_year = substr($to_wk, 0, 4);
	        $paste_week = str_pad(substr($to_wk, 5), 2, '0', STR_PAD_LEFT);
	        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));

	        $copiable = true;
	        $paste_date = $paste_start_date;
	        if ($with_user == 1) {
	            while (strtotime($paste_date) <= strtotime($paste_end_date)) {
	                if (in_array((date('N', strtotime($paste_date)) % 7), $days)) {
	                    $process_params = array(
	                    	'slot_tid' =>$data['tid'],
	                        'employee' => $data['employee'],
	                        'customer' => $data['customer'],
	                        'date' => $paste_date,
	                        'type' => $data['type'],
	                        'time_from' => $data['time_from'],
	                        'time_to' => $data['time_to']);

	                    if (!$this->findout_slot_alteration_bug($process_params)) {
	                        $copiable = false;
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

	                        if (!$this->customer_employee_slot_add($template_id , $data['employee'], $data['customer'], $paste_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
	                            $msg->set_message('fail', 'insertion_failed');
	                            $this->rollback_transaction();
	                            $copiable = false;
	                            return false;
	                        }
	                    } else {

	                        if (!$this->customer_employee_slot_add($template_id , '', $data['customer'], $paste_date, $data['time_from'], $data['time_to'], $_SESSION['user_id'], $data['fkkn'], $data['type'])) {
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

	}
?>