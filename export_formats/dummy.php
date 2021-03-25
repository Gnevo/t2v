<?php
	require_once('class/export.php');

	class dummy extends export {
		protected $signed = array();
                //using in line 121 export_lon.php
		public function getSigned() {
                        //echo "hi";
			if (!count($this->signed)) {
				$this->tables = array('report_signing');
				$this->fields = array('employee,customer,signin_employee,signin_tl,signin_sutl');
				$this->conditions = array('date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31"');
                                $this->query_generate();
                                //echo $this->sql_query;
                                //print_r($this->employees);
				foreach ($this->query_fetch() as $row) {
					//if (array_key_exists($row['employee'],$this->employees)) {
					// check if the report was signed by a teamleader or super-teamleader
					if(!empty($row['signin_employee']) && (!empty($row['signin_tl']) && !empty($row['signin_sutl']))) {
                                                if(array_key_exists($row['employee'], $this->signed)){
                                                        if($row['customer']){
                                                            if(!in_array($row['customer'], $this->signed[$row['employee']]))
                                                                array_push ($this->signed[$row['employee']], $row['customer']);
                                                        }
                                                        else{
                                                            $this->tables = array('timetable');
                                                            $this->fields = array('distinct customer as customer');
                                                            $this->conditions = array('date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31" AND employee = "'.$row['employee'].'"');
                                                            $this->query_generate();
                                                            foreach ($this->query_fetch() as $row1) {
                                                                if(!in_array($row1['customer'], $this->signed[$row['employee']]))
                                                                    array_push ($this->signed[$row['employee']], $row1['customer']);
                                                            }
                                                        }
                                                    
                                                }
                                                else{
                                                        if($row['customer']){
                                                            $this->signed[$row['employee']] = array($row['customer']);
                                                        }else{
                                                            $this->tables = array('timetable');
                                                            $this->fields = array('distinct customer as customer');
                                                            $this->conditions = array('date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31" AND employee = "'.$row['employee'].'"');
                                                            $this->query_generate();
                                                            $temp = array();
                                                            foreach ($this->query_fetch() as $row1) {
                                                                $temp[] = $row1['customer'];
                                                            }
                                                            $this->signed[$row['employee']] = $temp;
                                                        }
                                                        
                                                }
					}
				}
			}
//                        echo "<pre>\n".print_r($this->signed , 1)."</pre>";
                        
			return $this->signed;
		}

		public function getNotSigned() {
			$not = array();

			$this->getSigned();
//                        echo "<pre>\n".print_r($this->employees , 1)."</pre>";
			foreach ($this->employees as $employee => $employee_data) {
                            if (!array_key_exists($employee,$this->signed)) {
                                
                                $this->tables = array('timetable');
                                $this->fields = array('distinct customer as customer');
				$this->conditions = array('employee = "'.$employee.'" AND date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31" AND customer !="" AND customer IS NOT NULL');
                                $this->query_generate();
                                $temp_cust = array();
                                foreach ($this->query_fetch() as $row) {
                                    $temp_cust[] = $row['customer'];
				}
                                if(!empty($temp_cust))
                                    $not[$employee] = $temp_cust;
                            }else{
                                $signed_customers = "'";
                                $signed_customers .= implode("','", $this->signed[$employee]);
                                $signed_customers .= "'";
                                $this->tables = array('timetable');
                                $this->fields = array('distinct customer as customer');
				$this->conditions = array('employee = "'.$employee.'" AND date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31" AND customer !="" AND customer IS NOT NULL AND customer NOT IN('.$signed_customers.')');
                                $this->query_generate();
                                $temp_cust = array();
                                foreach ($this->query_fetch() as $row) {
                                    $temp_cust[] = $row['customer'];
				}
                                if(!empty($temp_cust))
                                    $not[$employee] = $temp_cust;
                            }
                            
			}
//                        
                        
			return $not;
                        
		}
                
                public function getSignedEmployee() {
                        //echo "hi";
                        $this->signed = array();
			if (!count($this->signed)) {
				$this->tables = array('report_signing');
				$this->fields = array('employee,customer,signin_employee,signin_tl,signin_sutl');
				$this->conditions = array('date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31"');
                                $this->query_generate();
                                //echo $this->sql_query;
                                //print_r($this->employees);
				foreach ($this->query_fetch() as $row) {
					//if (array_key_exists($row['employee'],$this->employees)) {
					// check if the report was signed by a teamleader or super-teamleader
					if(!empty($row['signin_employee'])) {
                                                if(array_key_exists($row['employee'], $this->signed)){
                                                        if($row['customer']){
                                                            if(!in_array($row['customer'], $this->signed[$row['employee']]))
                                                                array_push ($this->signed[$row['employee']], $row['customer']);
                                                        }
                                                        else{
                                                            $this->tables = array('timetable');
                                                            $this->fields = array('distinct customer as customer');
                                                            $this->conditions = array('date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31" AND employee = "'.$row['employee'].'"');
                                                            $this->query_generate();
                                                            foreach ($this->query_fetch() as $row1) {
                                                                if(!in_array($row1['customer'], $this->signed[$row['employee']]))
                                                                    array_push ($this->signed[$row['employee']], $row1['customer']);
                                                            }
                                                        }
                                                    
                                                }
                                                else{
                                                        if($row['customer']){
                                                            $this->signed[$row['employee']] = array($row['customer']);
                                                        }else{
                                                            $this->tables = array('timetable');
                                                            $this->fields = array('distinct customer as customer');
                                                            $this->conditions = array('date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31" AND employee = "'.$row['employee'].'"');
                                                            $this->query_generate();
                                                            $temp = array();
                                                            foreach ($this->query_fetch() as $row1) {
                                                                $temp[] = $row1['customer'];
                                                            }
                                                            $this->signed[$row['employee']] = $temp;
                                                        }
                                                        
                                                }
					}
				}
			}
//                        echo "<pre>\n".print_r($this->signed , 1)."</pre>";
                        
			return $this->signed;
		}
                
                public function getNotSignedEmployee() {
			$not = array();

			$this->getSignedEmployee();
//                        echo "<pre>\n".print_r($this->employees , 1)."</pre>";
			foreach ($this->employees as $employee => $employee_data) {
                            if (!array_key_exists($employee,$this->signed)) {
                                
                                $this->tables = array('timetable');
                                $this->fields = array('distinct customer as customer');
				$this->conditions = array('employee = "'.$employee.'" AND date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31" AND customer !="" AND customer IS NOT NULL');
                                $this->query_generate();
                                $temp_cust = array();
                                foreach ($this->query_fetch() as $row) {
                                    $temp_cust[] = $row['customer'];
				}
                                if(!empty($temp_cust))
                                    $not[$employee] = $temp_cust;
                            }else{
                                $signed_customers = "'";
                                $signed_customers .= implode("','", $this->signed[$employee]);
                                $signed_customers .= "'";
                                $this->tables = array('timetable');
                                $this->fields = array('distinct customer as customer');
				$this->conditions = array('employee = "'.$employee.'" AND date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31" AND customer !="" AND customer IS NOT NULL AND customer NOT IN('.$signed_customers.')');
                                $this->query_generate();
                                $temp_cust = array();
                                foreach ($this->query_fetch() as $row) {
                                    $temp_cust[] = $row['customer'];
				}
                                if(!empty($temp_cust))
                                    $not[$employee] = $temp_cust;
                            }
                            
			}
//                        
                        
			return $not;
                        
		}

                public function getSigned_for_list_report() {
                    /**
                        * @author: Shamsudheen <shamsu@arioninfotech.com>
                        * for: getting all signed employees
                        * used-in: employee work report listing -> unsigned employees  
                    */
			if (!count($this->signed)) {
				$this->tables = array('report_signing');
				$this->fields = array('employee,customer,signin_employee,signin_tl,signin_sutl');
				$this->conditions = array('date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31"');
                                $this->query_generate();
                                //echo $this->sql_query;
                                //print_r($this->employees);
				foreach ($this->query_fetch() as $row) {
					//if (array_key_exists($row['employee'],$this->employees)) {
					// check if the report was signed by a teamleader or super-teamleader
					if(!empty($row['signin_employee']) && (!empty($row['signin_tl']) && !empty($row['signin_sutl']))) {
                                                if(array_key_exists($row['employee'], $this->signed)){
                                                    
                                                        array_push ($this->signed[$row['employee']], $row['customer']);
                                                    
                                                }
                                                else{
                                                        $this->signed[$row['employee']] = array($row['customer']);
                                                }
					}
				}
			}
//                        echo "<pre>\n".print_r($this->signed , 1)."</pre>";
                        
			return $this->signed;
		}
                
		public function getNotSigned_for_list_report() {
                    /**
                        * @author: Shamsudheen <shamsu@arioninfotech.com>
                        * for: getting all unsigned employees
                        * used-in: employee work report listing -> unsigned employees  
                    */
			$not = array();
			$this->getSigned_for_list_report();
//                        echo "<pre>\n".print_r($this->signed , 1)."</pre>";
//                        echo "<pre>\n".print_r($this->employees , 1)."</pre>";
			foreach ($this->employees as $employee => $employee_data) {
                            $not[$employee]['employee_details'] = array('employee' => $employee, 'first_name' => $employee_data['first_name'], 'last_name' => $employee_data['last_name']);
                            if (!array_key_exists($employee,$this->signed)) {
                                
                                $this->tables = array('timetable` as `t', 'customer` as `c');
                                $this->fields = array('distinct t.customer as customer', 'c.first_name', 'c.last_name');
				$this->conditions = array('t.employee = ? AND t.date BETWEEN ? AND ? AND t.customer !="" AND t.customer IS NOT NULL AND c.username = t.customer');
				$this->condition_values = array($employee, $this->year.'-'.$this->month.'-01', $this->year .'-'. $this->month .'-31');
                                $this->query_generate();
                                $temp_cust = array();
                                foreach ($this->query_fetch() as $row) {
                                    $temp_cust[] = $row;
				}
                                $not[$employee]['customers'] = $temp_cust;
                            }else{
                                $signed_customers = "'" . implode("','", $this->signed[$employee]) . "'";
                                $this->tables = array('timetable` as `t', 'customer` as `c');
                                $this->fields = array('distinct t.customer as customer', 'c.first_name', 'c.last_name');
				$this->conditions = array('t.employee = ? AND t.date BETWEEN ? AND ? AND t.customer !="" AND t.customer IS NOT NULL AND t.customer NOT IN('.$signed_customers.') AND c.username = t.customer');
				$this->conditions = array($employee, $this->year .'-'. $this->month .'-01', $this->year .'-'. $this->month .'-31');
                                $this->query_generate();
                                $temp_cust = array();
                                foreach ($this->query_fetch() as $row) {
                                    $temp_cust[] = $row;
				}
                                $not[$employee]['customers'] = $temp_cust;
                            }
			}
			return $not;
		}

		public function numEmployees() {
			return count(array_keys($this->employees));
		}

		public function numSigned() {
			$this->getSigned();
			return count(array_keys($this->signed));
		}
	}
?>