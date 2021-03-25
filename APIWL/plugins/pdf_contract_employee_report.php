<?php
require_once('./plugins/F_pdf.class.php');
require_once('./class/setup.php');
require_once('./configs/config.inc.php');

class PDF_Work_report extends FPDF {

	var $relations       = array();
	var $company_details = array();
	var $basic_details   = array();
 
	function __construct(){
		parent::__construct();
		$this->smarty = new smartySetup(array( "gdschema.xml", "user.xml", "messages.xml", "button.xml","month.xml", "forms.xml","reports.xml"),FALSE);

		$this->AliasNbPages();
	}
}