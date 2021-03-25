<?php
	require_once('class/export.php');

	class dummy extends export {
		protected $signed = array();
                //using in line 121 export_lon.php
		public function getSigned() {
                        //echo "hi";
			if (!count($this->signed)) {
				$this->tables = array('report_signing');
				$this->fields = array('employee,signin_employee,signin_tl,signin_sutl');
				$this->conditions = array('date BETWEEN "' . $this->year . '-' . $this->month . '-01" AND "' . $this->year . '-' . $this->month . '-31"');
                                $this->query_generate();
                                //echo $this->sql_query;
                                //print_r($this->employees);
				foreach ($this->query_fetch() as $row) {
					//if (array_key_exists($row['employee'],$this->employees)) {
					// check if the report was signed by a teamleader or super-teamleader
					if(!empty($row['signin_employee']) && (!empty($row['signin_tl']) || !empty($row['signin_sutl']))) {
						$this->signed[$row['employee']] = $row['employee'];
					}
				}
			}
                        //print_r($this->signed);
			return $this->signed;
		}

		public function getNotSigned() {
			$not = array();

			$this->getSigned();
			foreach ($this->employees as $employee => $employee_data) {
				if (!array_key_exists($employee,$this->signed)) {
					$not[$employee] = $employee;
				}
			}

			return $not;
		}

		public function numEmployees() {
			return count($this->employees);
		}

		public function numSigned() {
			$this->getSigned();
			return count($this->signed);
		}
	}
?>
