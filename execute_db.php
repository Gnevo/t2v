<?php

require_once('configs/config.inc.php');

global $db;


$new_updation_query = "ALTER TABLE `employee` ADD `substitute` TINYINT(1) NOT NULL DEFAULT '0' ;
ALTER TABLE `customer` ADD `picture` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NULL DEFAULT NULL ;
ALTER TABLE `employee` ADD `picture` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NULL DEFAULT NULL ;
ALTER TABLE `privileges_general` ADD `document_archive` TINYINT(1) NOT NULL DEFAULT '0' ;
";

$dbHandle = mysql_connect("localhost", $db['username'], $db['password']);
$dbSel = mysql_select_db($db['database_master'], $dbHandle);

$res = mysql_query("SELECT * FROM company", $dbHandle);

while ($db_datas = mysql_fetch_array($res)) {
    echo $db_datas['db_name'];
    $flag = 1;
    $dbSel = mysql_select_db($db_datas['db_name'], $dbHandle);
    $new_updation_query_array = explode(";", $new_updation_query);
    array_pop($new_updation_query_array);
    foreach($new_updation_query_array as $query1){
        $res1 = mysql_query($query1, $dbHandle);
        if($res1)
            echo "    ok<br>";
        else{
            echo $query1."<br>failed<br>";
            $flag = 0;
            break;
        }
        if($flag == 0)
            break;
    }
    
}
?>
