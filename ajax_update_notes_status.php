<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("messages.xml","notes.xml"), FALSE);
require_once('class/notes.php');
$notes = new notes();

$notes->id = $_POST['id'];
$notes->status = $_POST['status'];

if($notes->update_note_status())
{
    $smarty->assign('id', $_POST['id'] );
    $smarty->assign('status', $_POST['status']);
}

$smarty->display('ajax_update_notes_status.tpl');
?>