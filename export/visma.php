<?php
	/*
		<?xml ?>
		<SalaryData ProgramName ExportVersion Created Type Language Imported>
			<TimeCodes>
				<TimeCode Code TimeCodeName>
			</TimeCodes>
			<SalaryDataEmployee FromDate ToDate>
				<Employee EmploymentNo FirstName Name PersonalNo FromDate ToDate>
					<NormalWorkingTimes>
						<NormalWorkingTime DateOfReport>
					</NormalWorkingTimes>
					<Times>
						<Time DateOfReport TimeCode SumOfHours TimeStart TimeEnd ProjectCode ResultUnitCode>
					</Times>
				</Employee>
			</SalaryDataEmployee>
		</SalaryData>
	*/

	require_once('class/export.php');

	class visma extends export {
		public $extension = 'tlu';
		private $document;

		public function __construct($year,$month) {
			parent::__construct($year,$month);

			$this->document = new DOMDocument();

			$salaryData = $this->document->createElement('SalaryData');
			$salaryData->setAttribute('ProgramName','Time2View');
			$salaryData->setAttribute('ExportVersion','1.0');
			$salaryData->setAttribute('Created',date('Y-m-d'));
			$salaryData->setAttribute('Type','SalaryData');
			$salaryData->setAttribute('Language','Swedish'); // TODO: Get from system settings?
			$salaryData->setAttribute('Imported',0);

			$timeCodes = $this->document->createElement('TimeCodes');
			//foreach () {
				$timeCode = $this->document->createElement('TimeCode');
				$timeCode->setAttribute('Code','');
				$timeCode->setAttribute('TimeCodeName','');
				$timeCodes->appendChild($timeCode);
			//}
			$salaryData->appendChild($timeCodes);

			$salaryDataEmployee = $this->document->createElement('SalaryDataEmployee');
			$salaryDataEmployee->setAttribute('FromDate',$year . '-' . $month . '-1');
			$salaryDataEmployee->setAttribute('ToDate',$year . '-' . $month . '-' . date('t',mktime(0,0,0,$month,1,$year)));
			foreach ($this->employees as $employee => $employee_data) {
				$employee = $this->document->createElement('Employee');
				$employee->setAttribute('EmploymentNo',$employee_data['code']);
				$employee->setAttribute('FirstName',$employee_data['first_name']);
				$employee->setAttribute('Name',$employee_data['last_name']);
				$employee->setAttribute('PersonalNo',$employee_data['social_security']);
				$employee->setAttribute('FromDate',$year . '-' . $month . '-1');
				$employee->setAttribute('ToDate',$year . '-' . $month . '-' . date('t',mktime(0,0,0,$month,1,$year)));

				$normalWorkingTimes = $this->document->createElement('NormalWorkingTimes');
				//foreach () {
					$normalWorkingTime = $this->document->createElement('NormalWorkingTime');
					$normalWorkingTime->setAttribute('DateOfReport','');
					$normalWorkingTimes->appendChild($normalWorkingTime);
				//}
				$employee->appendChild($normalWorkingTimes);

				$times = $this->document->createElement('Times');
				foreach ($employee_data['shifts'] as $shift_date => $shifts_today) {
					foreach ($shifts_today as $time_from => $shift_data) {
						$time = $this->document->createElement('Time');
						$time->setAttribute('DateOfReport',$shift_date);
						$time->setAttribute('TimeCode','');
						$time->setAttribute('SumOfHours',$shift_data['time_to'] - $time_from);
						$time->setAttribute('TimeStart',$time_from);
						$time->setAttribute('TimeEnd',$shift_data['time_to']);
						$time->setAttribute('ProjectCode',$this->customers[$shift_data['customer']]['social_security']);
						$time->setAttribute('ResultUnitCode','');
						$times->appendChild($time);
					}
				}
				$employee->appendChild($times);

				$salaryDataEmployee->appendChild($employee);
			}
			$salaryData->appendChild($salaryDataEmployee);

			$this->document->appendChild($salaryData);
		}

		public function __toString() {
			return $this->document->saveXML();
		}
	}
?>
