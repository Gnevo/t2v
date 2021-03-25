<?php
$con = mysql_connect('localhost','time2vie_cirrusr','aDmuWIehQRnP');
mysql_select_db('time2vie_cirrus8',$con);
$query = "SELECT * FROM customer";
$data = mysql_query($query);

while($row = mysql_fetch_array($data)){
    $mobile = $row['mobile'];
    if($mobile != ""){
        $mob = substr($mobile,0,1);
        if($mob == 0){
            $mobile = substr($mobile,1);
        }
        if(strstr($mobile,'-')){
            $mobile = str_replace("-", "", $mobile);
            //echo "<br>".$mobile;
        }
        if(strstr($mobile,' ')){
            $mobile = str_replace(" ", "", $mobile);
           // echo "<br>".$mobile;
        }
        $query_1 = "UPDATE customer SET mobile=".$mobile." WHERE username='".$row['username']."'";
        mysql_query($query_1);
    }
}
?>
