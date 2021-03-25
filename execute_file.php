<?php

require_once('configs/config.inc.php');

global $db;


$new_updation_query = "";

$dbHandle = mysql_connect("localhost", $db['username'], $db['password']);
$dbSel = mysql_select_db($db['database_master'], $dbHandle);

$res = mysql_query("SELECT * FROM company", $dbHandle);

while ($db_datas = mysql_fetch_array($res)) {   
    echo $db_datas['name'].$db_datas['upload_dir'];
    $create_status = chmod($db_datas['upload_dir']."/skills", 0777);
    if($create_status){
        echo "  OK<br>";
    }else{
        echo "  Fucked up<br>";
    }
    
}
?>
