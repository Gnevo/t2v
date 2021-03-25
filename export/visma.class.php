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

	class visma extends export {
		public $mime = 'text/xml';
		private $document;

		public function __construct() {
			parent::__construct();

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
			$salaryDataEmployee->setAttribute('FromDate','');
			$salaryDataEmployee->setAttribute('ToDate','');
			//foreach () {
				$employee = $this->document->createElement('Employee');
				$employee->setAttribute('EmploymentNo','');
				$employee->setAttribute('FirstName','');
				$employee->setAttribute('Name','');
				$employee->setAttribute('PersonalNo','');
				$employee->setAttribute('FromDate','');
				$employee->setAttribute('ToDate','');

				$normalWorkingTimes = $this->document->createElement('NormalWorkingTimes');
				//foreach () {
					$normalWorkingTime = $this->document->createElement('NormalWorkingTime');
					$normalWorkingTime->setAttribute('DateOfReport','');
					$normalWorkingTimes->appendChild($normalWorkingTime);
				//}
				$employee->appendChild($normalWorkingTimes);

				$times = $this->document->createElement('Times');
				//foreach () {
					$time = $this->document->createElement('Time');
					$time->setAttribute('DateOfReport','');
					$time->setAttribute('TimeCode','');
					$time->setAttribute('SumOfHours','');
					$time->setAttribute('TimeStart','');
					$time->setAttribute('TimeEnd','');
					$time->setAttribute('ProjectCode','');
					$time->setAttribute('ResultUnitCode','');
					$times->appendChild($time);
				//}
				$employee->appendChild($times);

				$salaryDataEmployee->appendChild($employee);
			//}
			$salaryData->appendChild($salaryDataEmployee);

			$this->document->appendChild($salaryData);
		}

		public function __toString() {
			return $this->document->saveXML();
		}
	}
?>
