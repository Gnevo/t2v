<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/equipment.php');
$obj_equipment = new equipment();
$obj_customer  = new customer();
$smarty        = new smartySetup(array("common.xml"), FALSE);

$document_path = $obj_customer->get_folder_name($_SESSION['company_id']) . "/document_archive/";
$document_url = $smarty->url . $document_path;
$documents = array(
  'session_status' => $session_check,
  'unsigned' => array(), 
  'signed' => array()
);

$documents_array = $obj_equipment->get_public_document_archive();

foreach ($documents_array as $document) {
  $document['file_url'] = '';
  if(isset($document['file_name']) && $document['file_name']) {
    $document['file_url'] = $document_url . $document['file_name'];
  }
  if((int)$document['signed_id']) {
    $documents['signed'][] = $document;
  } else {
    $documents['unsigned'][] = $document;
  }
}
//echo '<pre>' . print_r($documents, 1) . '</pre>';
echo json_encode($documents);