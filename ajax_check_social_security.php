<?php
require_once('class/setup.php');
$smarty = new smartySetup(array('messages.xml'), FALSE);
$soc_sec = strip_tags($_POST['social_security']);
$temp = '212121212';
if(is_numeric($soc_sec)){
    if ($soc_sec[6] == '-') {
        $soc_sec = preg_replace('/-/', '', $soc_sec, 1);
    }
    if (strlen($soc_sec) == '10') {
        $mult_array = '';
        for ($i = 0; $i < strlen($soc_sec) - 1; $i++) {

            $mult = $soc_sec[$i] * $temp[$i];
            $mult_array.= $mult;
        }
        $sum = array_sum(str_split($mult_array));
        $last_dig = substr($sum, -1);
        if ($last_dig != '0')
            $sub = 10 - $last_dig;
        else
            $sub = 0;
        if ($sub != substr($soc_sec, -1)) {

            echo $smarty->translate['this_social_security_number_is_wrong'];
        }
    } else {

        echo $smarty->translate['this_social_security_number_is_wrong'];
    }
}else{
    echo $smarty->translate['this_social_security_number_is_wrong'];
}
?>