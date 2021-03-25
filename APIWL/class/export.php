<?php
	require_once('class/db.php');

	class export extends db {
		protected $year;
		protected $month;
		protected $employees = array();
		var $employees_sms = array();
                var $employees_mail = array();
		protected $customers = array();
		protected $codes = array();

		public function __construct($year=null,$month=null) {
			parent::__construct();

			$this->year = $year;
			$this->month = $month;

			// Get all employees.
			$this->tables = array('employee');
                        $this->order_by = array('LOWER(last_name)','LOWER(first_name)');
                        $this->query_generate();
 
			$employees = array();
			foreach ($this->query_fetch() as $employee) {
                            
				$data = $employee;
				unset($data['username']);

				$employees[$employee['username']] = $data;
                                
			}
        
                     

			// Get inconvenient time declarations.
			$inconvenient = array();
			$this->tables = array('inconvenient_timing');
			$this->conditions = array(
				'AND',
				array(
					'OR',
					'effect_from <= "' . $year . '-' . $month . '-01"',
					'effect_from >= "' . $year . '-' . $month . '-01" AND "' . $year . '-' . $month . '-31"',
				),
				array(
					'OR',
					'effect_to IS NULL',
					'effect_to BETWEEN "' . $year . '-' . $month . '-01" AND "' . $year . '-' . $month . '-31"'
				)
			);
			foreach ($this->query_fetch() as $entry) {
				$data = $entry;
				unset($data['id']);

				$inconvenient[$entry['id']] = $data;
			}

			// Get export configuration.
			$config = array();
			$this->tables = array('export_config');
			foreach ($this->query_fetch() as $entry) {
				$data = $entry;
				unset($data['internal']);

				$config[$entry['internal']] = $data;

				if (array_key_exists($entry['internal'],$inconvenient)) {
					$this->codes[$entry['external']] = $inconvenient[$entry['internal']]['name'];
				} else {
					$this->codes[$entry['external']] = $entry['external'];
				}
			}

			// Get all work hours.
			$this->tables = array('timetable');
			$this->conditions = array(
				'AND',
				'date BETWEEN "' . $year . '-' . $month . '-1" AND "' . $year . '-' . $month . '-31"', // Cannot use condition_values because those will be escaped!
				'customer IS NOT NULL','customer != \'\'',
                                'status IN(1,2)'
			);
			$this->order_by = array('date','time_from');
                       
                        $this->query_generate();
                        
                        
			foreach ($this->query_fetch() as $shift) {
				$datas = array();

				$data = $shift;
				unset($data['employee']);
				unset($data['date']);
				unset($data['time_from']);

				$do_id = 0;
                                if(!empty ($config))
                                    $data['external'] = $config[$do_id]['external'];

				if ($shift['type'] == 0) {
					// Check inconvenient times.
					foreach ($inconvenient as $id => $entry) {
						// Check if this $shift is within the from/to dates of the $entry.
						if (
							array_key_exists($id,$config) &&
							strtotime($shift['date'] . ' ' . $shift['time_from']) >= strtotime($entry['effect_from'] . ' ' . $entry['time_from']) &&
							(empty($entry['effect_to']) || strtotime($shift['date'] . ' ' . $shift['time_to']) <= strtotime($entry['effect_to'] . ' ' . $entry['time_to'])) &&
							in_array(date('N',strtotime($shift['date'])),explode(',',$entry['days'])) &&
							$shift['time_from'] >= $entry['time_from'] &&
							$shift['time_to'] <= $entry['time_to']
						) {
							$do_id = $id;
						}
					}
				}

				if ($do_id == 0 && array_key_exists(- $shift['type'],$config)) {
					$do_id = - $shift['type'];
				}
                                if(!empty ($config)){
                                    if ($config[$do_id]['method'] == 'REPLACE') {
                                            $data['external'] = $config[$do_id]['external'];
                                    } else if ($config[$do_id]['method'] == 'ADD') {
                                            $data2 = $data;
                                            $data2['external'] = $config[$do_id]['external'];
                                            $datas[] = $data2;
                                    }
                                }

				$datas[] = $data;

				// fkkn : 1-FK, 2-KN
				// type : 0-Normal, 1-Travel, 2-Break, 3-on call
				// status : 0-forbidden, 1-active, 2-leave, 3-Priliminary
                                
				if (!array_key_exists($shift['employee'],$this->employees)) {
					$this->employees[$shift['employee']] = $employees[$shift['employee']];
				}

				$this->employees[$shift['employee']]['shifts'][$shift['date']][$shift['time_from']][] = $data;
			}
                        
                        
			// Get all customers.
			$this->tables = array('customer');
			foreach ($this->query_fetch() as $customer) {
				$data = $customer;
				unset($data['username']);

				$this->customers[$customer['username']] = $data;
			}
		}
                
           /*********************************** Niyas Begin ***********************************/     
            function send_sms_export( $month, $year) {
                    $send_count = 0;
                    $sms_count = count($this->employees_sms);
                    foreach ($this->employees_sms as $recipient) {
                        $this->tables = array('employee');
                        $this->fields = array('username');
                        $this->conditions = array('mobile = ?');
                        $this->condition_values = array($recipient);
                        $this->query_generate();
                        $datas_emp = $this->query_fetch();
                        if(!empty($datas_emp)){
                            if($this->export_lon_sms_add($datas_emp[0]['username'], $month, $year) == 1){
                                $send_count = $send_count + 1;
                            }
                        }    
                    }
                    if($send_count == $sms_count){
                        return 1;
                    }else{
                        return 0;
                    }
            }

            function export_lon_sms_add($emp, $month, $year){
                $this->tables = array('export_lon_sms');
                $this->fields = array('employee','`month`','`year`');
                $this->field_values = array($emp,$month,$year);
                if($this->query_insert()){
                    return 1;
                }else{
                    return 0;
                }
            }
            
            
            function send_mail_export( $month, $year) {
                    $send_count = 0;
                    $sms_count = count($this->employees_mail);
//                    echo "<pre>". print_r($this->employees_mail, 1)."</pre>";
                        foreach ($this->employees_mail as $recipient) {
                            
                            
                                if($this->export_lon_mail_add($recipient, $month, $year) == 1){
                                    $send_count = $send_count + 1;
                                }
                               
                        }
                        if($send_count == $sms_count){
                            return 1;
                        }else{
                            return 0;
                        }
            }
            function export_lon_mail_add($emp, $month, $year){
                $this->tables = array('export_lon_mail');
                $this->fields = array('employee','`month`','`year`');
                $this->field_values = array($emp,$month,$year);
                if($this->query_insert()){
                    return 1;
                }else{
                    return 0;
                }
            }
            /*********************************** Niyas End ***********************************/       
	}
?>