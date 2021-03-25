<?php
/*
 * created by: dona
 * purpose : Closing the ticket with the status Löst to Stängt
 * the cron will be run on every day
 */
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/support_new.php');
$smarty_obj = new smartySetup(array("mail.xml", "support.xml"),FALSE);

$support = new support();
$support->update_tickets_noreplay();
?>