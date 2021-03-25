<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml"), FALSE);
$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new customer();
$employee = new employee();
$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$month = $pram[$totparam-1];
$year = $pram[$totparam-2];
$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

if($month == 1)
{
	$week_num_start = date('W',  strtotime($year."-".$month."-01"));	
}
else
{
	$week_num_start = date('W',  strtotime($year."-".$month."-01"));
	$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

//if($month == 12)
//{	
//    echo $days;
//	$days = $days-1;
//	//echo $i, ': ', (date('L', strtotime("$year-01-01")) ? 'Yes' : 'No'), '<br       />';
//}
$val = $week_num_start;
$week_num_end = date('W',  strtotime($year."-".$month."-".$days));
if($week_num_end == "01"){
    
    for($i=$days;$days>=$i;$i--){
        $week_num_end = date('W',  strtotime($year."-".$month."-".$i));
        if($week_num_end != "01"){
            break;
        }
    }
    $week_num_end;
//   $week_num_end = date('W',  strtotime($year."-".$month."-".$days)); 
}
//if(date('L', strtotime("$year-01-01")) && $month == 12)
//{
//	$week_num_end += 1;
//        
//}	
for($i=0;$i<(($week_num_end+1)-$week_num_start);$i++){
	$result[$i] =  ceil($val);
	//$result[$i] = array('week' => $val,'data' => array('sun' => array(),'mon' => array(),'tue' => array(),'wed' => array(),'thu' => array(),'fri' => array(),'sat' => array())); //, 'data' => array('name' => '', 'mon' =>array('time' =>'','leave' =>'0'),'tue'=>array('time' =>'','leave' =>'0'),'wed'=>array('time' =>'','leave' =>'0'),'thu'=>array('time' =>'','leave' =>'0'),'fri'=>array('time' =>'','leave' =>'0'),'sat'=>array('time' =>'','leave' =>'0'),'sun'=>array('time' =>'','leave' =>'0')));
	$val++;
}
$str = '';
if(count($result) > 0)
{
	for($r=0;$r<count($result);$r++)	
	{
		if($result[$r] != 53)
		{
			$str .= '<option value="'.$result[$r].'">'.$result[$r].'</option>'; // This is for hiding the 53 week no on selec drop down
				
		}
		
	}
}
if(date('W',  strtotime($year."-".$month."-".$days) == '01')){
    $old_val = $r-1;
    $new_val = $result[$old_val]+1;
    $str .= '<option value="'.$new_val.'">'.$new_val.'</option>'; // Gives new year week num to giv last values of december month
}
echo '<select name="week" id="week" style="width:50px;">'.$str.'</select>';
exit;
?>