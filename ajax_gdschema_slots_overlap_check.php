<?php

require_once('class/setup.php');
$overlapped_slots = 'success';
if (isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != "") {
    $multiple_slots = explode(",", trim($_REQUEST['multiple']));
    $total_slot_count = count($multiple_slots);
    for ($i = 0; $i < $total_slot_count; $i++) {
        $left_slot = explode('-', trim($multiple_slots[$i]));
        for ($j = 0; $j < $total_slot_count; $j++) {

            if ($i != $j) {
                $right_slot = explode('-', trim($multiple_slots[$j]));
                if (($left_slot[0] > $left_slot[1]) && ($right_slot[0] > $right_slot[1])) {
                    $overlapped_slots = $left_slot[0] . '-' . $left_slot[1] . ' & ' . $right_slot[0] . '-' . $right_slot[1];
                    break;
                } elseif ($left_slot[0] > $left_slot[1]) {
                    if (($left_slot[0] > $right_slot[0] && $left_slot[0] < $right_slot[1]) || (24.00 > $right_slot[0] && 24.00 < $right_slot[1])) {
                        $overlapped_slots = $left_slot[0] . '-' . $left_slot[1] . ' & ' . $right_slot[0] . '-' . $right_slot[1];
                        break;
                    }
                } elseif ($right_slot[0] > $right_slot[1]) {
                    if (($left_slot[0] > $right_slot[0] && $left_slot[0] < 24.00) || ($left_slot[1] > $right_slot[0] && $left_slot[1] < 24.00)) {
                        $overlapped_slots = $left_slot[0] . '-' . $left_slot[1] . ' & ' . $right_slot[0] . '-' . $right_slot[1];
                        break;
                    }
                    
                } elseif (($left_slot[0] > $right_slot[0] && $left_slot[0] < $right_slot[1]) || ($left_slot[1] > $right_slot[0] && $left_slot[1] < $right_slot[1])) {
                    $overlapped_slots = $left_slot[0] . '-' . $left_slot[1] . ' & ' . $right_slot[0] . '-' . $right_slot[1];
                    break;
                }
            }
        }
        if ($j != $total_slot_count)
            break;
    }
    /*
      if($i != $total_slot_count){
      //       echo $overlapped_slots = $multiple_slots[$i]." & ".$multiple_slots[$j];
      echo $overlapped_slots;
      }else{
      echo "0";
      } */
}
echo $overlapped_slots;
?>
