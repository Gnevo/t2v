<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

/*$soc_sec = "7123456789";
$flg = TRUE;
while($flg) {
    $flg = FALSE;
    $soc_sec = "" . rand(0000000000, 9999999999) . "";
    $temp = '212121212';
//    echo $soc_sec . "<br>";
//    echo $temp . "<br>";
    $mult_array = '';
    for ($i = 0; $i < strlen($soc_sec) - 1; $i++) {

        $mult = $soc_sec[$i] * $temp[$i];
        $mult_array.= $mult;
    }
//    echo $mult_array . "<br>";
    $sum = array_sum(str_split($mult_array));
    $last_dig = substr($sum, -1);
    if ($last_dig != '0')
        $sub = 10 - $last_dig;
    else
        $sub = 0;

    if ($sub != substr($soc_sec, -1)) {
        $flg = TRUE;
    }  else {
        $flg = FALSE;
        echo "<Center><B><U>Security Number</U></B></br>".$soc_sec."</Center>";
    }
}*/

//----------------------------------------------------json test---------------------------------------
/*$string = '{"foo": "bar", "cool": "attr"}';
$result = json_decode($string, true);
echo "<pre>".print_r($result, 1)."</pre>";
//echo "<pre>".print_r($_REQUEST, 1)."</pre>";
//echo json_encode(array("A" => $_REQUEST['tags'], "B" => $_REQUEST['tagmode'], "C" => $_REQUEST['format']));
echo "<pre>".print_r($_REQUEST, 1)."</pre>";
$string = $_REQUEST['json'];
$result = json_decode($string, true);
echo "<pre>".print_r($result, 1)."</pre>";
*/
//------------------------------------------------json test---------------endz---------------------------------------------------

//-------------------------------sorting in multidiamensional array---------------------------------------------------------
/*$vals = array(
    array('id' => 0, 'val1' => 1, 'val2' => 2.0),
    array('id' => 1, 'val1' => 15, 'val2' => 20.0),
    array('id' => 2, 'val1' => 15, 'val2' => 5.5),
    array('id' => 3, 'val1' => 15, 'val2' => 55.1),
    array('id' => 4, 'val1' => 2, 'val2' => 22.3),
    array('id' => 5, 'val1' => 20, 'val2' => 70.8),
    array('id' => 6, 'val1' => 2, 'val2' => 8.2)
    );

echo "<pre>B4: ".print_r($vals, 1)."</pre>";
usort($vals, 'sortfn');

function sortfn($a, $b)
{
    if($a['val1'] == $b['val1'])
        return ($a['val2'] > $b['val2']);
    else
        return ($a['val1'] > $b['val1']);
}

echo "<pre>After: ".print_r($vals, 1)."</pre>";*/
//-------------------------------sorting in multidiamensional array----------endz-----------------------------------------------

//-------------------------------get months between dates-----------------------------------------------
/*$startDate = '2013-05-15';
$endDate   = '2013-05-22';

echo "Start date: $startDate <br/>";
echo "End date: $endDate <br/><br/>";

$startDate = strtotime(date('Y-m-01',strtotime($startDate)));
$endDate   = strtotime(date('Y-m-t',strtotime($endDate)));
$currentDate = $endDate;

echo "<u>Year Months in between these</u><br/>";

while ($currentDate >= $startDate) {
    echo date('Y|m',$currentDate).'<br/>';
    $currentDate = strtotime( date('Y-m-01',$currentDate).' -1 month');
}*/
//-------------------------------get months between dates-------------endz----------------------------------
/*
require_once('class/setup.php');
require_once('class/employee.php');
$employee = new employee();

$date_from = '2013-11-01';
$date_to = '2014-04-30';
$diff = abs($employee->date_difference($date_from, $date_to));
$tot_week = floor($diff / (7 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (7 * 24 * 60 * 60));
$tot_day = floor($diff / (24 * 60 * 60)) == 0 ? 1 : floor($diff / (24 * 60 * 60)+1);

echo "<pre>".print_r(array($date_from, $date_to, $diff, $tot_day, $tot_week), 1)."</pre>";
echo round(5609 / 25,1);
//echo "<pre>".print_r($ctest, 1)."</pre>";
/*
$a = array('a', 'x', 't');
$b = array('4', 'n');
echo "<pre>".print_r($a, 1)."</pre>";
echo "<pre>".print_r($b, 1)."</pre>";
echo "<pre>".print_r(array_merge($a, $b), 1)."</pre>";*/

/*
require_once('class/equipment.php');
$equipment = new equipment();
//$time_1 = '0.5';
//$time_2 = '5.15';
$time_1 = 7.05;
$time_2 = 5.00;
$time_sum = $equipment->time_sum($time_1, $time_2);
$time_diff = $employee->time_difference($time_1, $time_2);
echo "<pre>".print_r(array($time_1, $time_2, $time_sum, $time_diff), 1)."</pre>";
echo $equipment->time_user_format(0.05, 100);*/
//-------------------------------google calender-----------------------------------------------
/*$app_dir = getcwd();
require_once($app_dir.'/class/setup.php');
require_once $app_dir.'/google-api-php-client/src/Google_Client.php';
require_once $app_dir.'/google-api-php-client/src/contrib/Google_CalendarService.php';
session_start();

echo "<pre>My session: ".print_r($_SESSION, 1)."</pre>";
$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");

// Visit https://code.google.com/apis/console?api=calendar to generate your
// client id, client secret, and to register your redirect uri.
$client->setClientId('361312406079.apps.googleusercontent.com');
$client->setClientSecret('RO81JNNksvw6LHn8kdTrgFiO');
$client->setRedirectUri('http://192.168.0.234/works/app/t2v/cirrus/testshamsu.php');
$client->setDeveloperKey('AIzaSyBazvM3N82St5YLKpjMlT55hBUeAIZS-48');
$cal = new Google_CalendarService($client);
if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  $calList = $cal->calendarList->listCalendarList();
  print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";


$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}*/
//-------------------------------google calender-  endz----------------------------------------------


//-------------------------------url encode decode---------------------------------------
/*$url = 'params=%7B%22autoplay%22%3Atrue%2C%22autorewind%22%3Atrue%2C%22default_hd%22%3Afalse%2C%22dtsg%22%3A%22AQAZ5evb%22%2C%22inline_player%22%3Afalse%2C%22lsd%22%3Anull%2C%22min_progress_update%22%3A300%2C%22pixel_ratio%22%3A1%2C%22preload%22%3Afalse%2C%22source%22%3A%22lookback%22%2C%22start_index%22%3A0%2C%22start_muted%22%3Afalse%2C%22use_spotlight%22%3Afalse%2C%22video_data%22%3A%5B%7B%22hd_src%22%3A%22https%3A%5C%2F%5C%2Flookbackvideo4-a.akamaihd.net%5C%2Fhvideo-ak-frc3%5C%2Fv%5C%2Ft55%5C%2F1671231_689074031137939_32541_n.mp4%3Foh%3D4ba5a724ff6af0e7a266c9753ff3d2d0%26oe%3D52F3E0BD%26__gda__%3D1391716907_7a47a85cd1e4794459076975432e2bd1%22%2C%22is_hds%22%3Afalse%2C%22index%22%3A0%2C%22rotation%22%3A0%2C%22sd_src%22%3A%22https%3A%5C%2F%5C%2Flookbackvideo4-a.akamaihd.net%5C%2Fhvideo-ak-frc3%5C%2Fv%5C%2Ft54%5C%2F1663636_689074031137939_30762_n.mp4%3Foh%3D82c052fbd8063a7505c7e07fe12a7776%26oe%3D52F37B66%26__gda__%3D1391717808_6fe0a0c0b83d130f900390f62ef645c7%22%2C%22thumbnail_src%22%3A%22https%3A%5C%2F%5C%2Ffbcdn-vthumb-a.akamaihd.net%5C%2Fhvthumb-ak-ash3%5C%2Ft15%5C%2F1095540_689074047804604_689074031137939_31055_327_b.jpg%22%2C%22thumbnail_height%22%3A540%2C%22thumbnail_width%22%3A960%2C%22video_duration%22%3A62%2C%22video_id%22%3A%22689074031137939%22%7D%5D%7D&width=960&height=540&user=100001060467960&log=no&div_id=id_52f1bc3e8e4790956242703&swf_id=swf_id_52f1bc3e8e4790956242703&browser=Firefox+20.0&tracking_domain=https%3A%2F%2Fpixel.facebook.com&post_form_id=&string_table=https%3A%2F%2Fs-static.ak.facebook.com%2Fflash_strings.php%2Ft96637%2Fen_US';
echo 'Url : '.$url;
$encode_url = urlencode($url);
echo '<br/>Encode_url : '.$encode_url;;
//echo '<br/>double Encode_url : '.urlencode($encode_url);
$decode_url = urldecode($url);
echo '<br/>Decode_url : '.$decode_url;*/
//-------------------------------url encode decode----------endz-----------------------------

/*$first_slot_date = '2013-12-30';
$from_week = '01';
echo $paste_start_date = date('Y-m-d', strtotime(date('o', strtotime($first_slot_date)) . "W" . $from_week . '1'));*/
/*$year = date('Y', strtotime('-1 month', strtotime(date('Y-m-d'))));
$month = (int)date('m', strtotime('-1 month', strtotime(date('Y-m-d'))));
echo $year. '===='. $month;*/

//-------------------------------pdf sick details report starts---------------------------------------
/*require_once ('plugins/pdf_sick_details_report.class.php');
$pdf = new PDF_sick_report();
$pdf->AddPage();
$pdf->report_header();
$pdf->content_table(array());
$pdf->signing_part();
$pdf->Page_footer_content();
$pdf->Output();*/
/*$array = array ('3'=> 'a', '1b' => 'b', 'c', 'd'); 
echo ($array[1]); 

$a = 10;
	$b = 20;
	$c = 4;
	$d = 8;
	$e = 1.0;
	$f = $c + $d * 2;
	$g = $f % 20;
	$h = $b - $a + $c + 2;
	$i = $h << $c;
	$j = $i * $e;
	print $j;*/
//-------------------------------pdf sick details report endz---------------------------------------
//-------------------------------Code Context begins--------------------------------------
/*
    echo '<br/>final:'.squareCount($_GET['a'], $_GET['b'], $_GET['c']);
   function squareCount1($input1, $input2, $input3)
	{
		$total_rows = (int) $input1;
		$total_column = (int) $input2;
		$jumbing_columns = $input3;
		
		if($total_rows < 1 || $total_column < 1 || $jumbing_columns > 1000000)
			return 0;
		
		if($jumbing_columns>1000){
			$jumbing_columns = (int) ($jumbing_columns/1000000);
		}
		
		$starting_positions_have_max_jumpings = 0;
		$largest_jumbing_count = 0;
		for($i = 0 ; $i<$total_rows ; $i++){
			for($j = 0 ; $j<$total_column ; $j++){
				$max_no_of_jumpings = 0;
				
				if($i+$jumbing_columns < $total_rows){
					$max_no_of_jumpings++;
                                }
					
				if($i-$jumbing_columns >= 0){
					$max_no_of_jumpings++;
                                }
					
				if($j+$jumbing_columns < $total_column){
					$max_no_of_jumpings++;
                                }
					
				if($j-$jumbing_columns >= 0){
					$max_no_of_jumpings++;
                                }
                                echo "$i - $j => $max_no_of_jumpings<br/>";
					
				if($max_no_of_jumpings > $largest_jumbing_count){
					$largest_jumbing_count = $max_no_of_jumpings;
					$starting_positions_have_max_jumpings = 1;
				} else if($max_no_of_jumpings == $largest_jumbing_count)
					$starting_positions_have_max_jumpings++;
			}
		}
		
		return $starting_positions_have_max_jumpings;
	}
        
        function squareCount($input1, $input2, $input3)
        {
            $return_result = 0;
            if ((($input1 - 0.5) >= $input3) && (($input2 - 0.5) >= $input3))
            {
                $return_result = 4;
            }
            else if (((($input1 - 0.5) >= $input3) && (($input2 - 0.5) < $input3)) || ((($input1 - 0.5) < $input3) && (($input2 - 0.5) >= $input3)))
            {
                $return_result = 2;
            }
            else
            {
                $return_result = $input1 * $input2;
            }
            return $return_result;
        }
        
        */
/*$next_month_start_date = date('Y-m-d', strtotime($_GET['year'] .'-'. $_GET['month'] . '-01' . " +1 month"));
$temp_year = date('Y', strtotime($next_month_start_date));
$temp_month = date('m', strtotime($next_month_start_date));
echo "<pre>".print_r(array($next_month_start_date, $temp_year, $temp_month), 1)."</pre>";

$this_year = $_GET['year'];
$next_year = $this_year+1;
$month_last_days[$this_year] = ($this_year % 400 == 0 || ($this_year % 100 != 0 && $this_year % 4 == 0)) ? array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31) : array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
$month_last_days[$next_year] = ($next_year % 400 == 0 || ($next_year % 100 != 0 && $next_year % 4 == 0)) ? array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31) : array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
echo "<pre>".print_r($month_last_days, 1)."</pre>";
*/

/*
//regex
$subject = "5,6,7,";
$pattern = '/7,/';


if (preg_match($pattern,$subject))
    echo 'true';
else 
    echo 'false';*/


/*
$tmp_calculation_start_month = 4;
$calculation_period_length = 3;
$calculation_period_month_start_date = 15;
$month = 8;
$year = 2014;
$flag_found_calculation_period = FALSE;
$is_month_starting_first_date = $calculation_period_month_start_date == 1 ? TRUE : FALSE;
$is_month_starting_last_date = in_array($calculation_period_month_start_date, array(28, 29, 30, 31)) ? TRUE : FALSE;

$inp_values = array(
    '$tmp_calculation_start_month' => $tmp_calculation_start_month,
    '$calculation_period_length' => $calculation_period_length,
    '$calculation_period_month_start_date' => $calculation_period_month_start_date,
    '$month' => $month,
    '$year' => $year,
    '$is_month_starting_first_date' => ($is_month_starting_first_date ? 'TRUE' : 'FALSE'),
    '$is_month_starting_last_date' => ($is_month_starting_last_date ? 'TRUE' : 'FALSE')
);
echo "<pre>Input values: ".print_r($inp_values, 1)."</pre>";

$contract_calculation_values = array();
$contract_calculation_previous_values = array();
if(!$is_month_starting_first_date){
    $pre_month_start = $tmp_calculation_start_month - $calculation_period_length;
    $pre_year_start = $year;
    if($pre_month_start < 1){
        $pre_month_start = 12 + $pre_month_start;   //$pre_month_start is a minus or 0 value
        $pre_year_start--;
    }
    
    $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($pre_year_start.'-'.$pre_month_start.'-'.$calculation_period_month_start_date));
    if($is_month_starting_last_date){
        $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($year.'-'.$tmp_calculation_start_month.'-01'));
        $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
    }else
        $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($year.'-'.$tmp_calculation_start_month.'-'.$calculation_period_month_start_date. ' -1 day'));
}

while(!$flag_found_calculation_period){
    $tmp_calculation_end_month = $tmp_calculation_start_month + $calculation_period_length - 1;
    if($tmp_calculation_end_month > 12){
        if(($tmp_calculation_start_month <= $month && $month <= 12) || (1 <= $month && $month <= ($tmp_calculation_end_month-12))){
            $flag_found_calculation_period = TRUE;
            $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
            $contract_calculation_values['end_month'] = $tmp_calculation_end_month-12;
            $contract_calculation_values['start_year'] = $year;
            $contract_calculation_values['end_year'] = $year+1;
        } 
        else if(!$is_month_starting_first_date) { //for keeping previous calculation period
            $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
            $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month-12;
            $contract_calculation_previous_values['start_year'] = $year;
            $contract_calculation_previous_values['end_year'] = $year+1;
        }
    }else {
        if($tmp_calculation_start_month <= $month && $month <= $tmp_calculation_end_month){
            $flag_found_calculation_period = TRUE;
            $contract_calculation_values['start_month'] = $tmp_calculation_start_month;
            $contract_calculation_values['end_month'] = $tmp_calculation_end_month;
            $contract_calculation_values['start_year'] = $year;
            $contract_calculation_values['end_year'] = (!$is_month_starting_first_date && $tmp_calculation_end_month == 12) ? ($year+1) : $year;
        }
        else if(!$is_month_starting_first_date) { //for keeping previous calculation period
            $contract_calculation_previous_values['start_month'] = $tmp_calculation_start_month;
            $contract_calculation_previous_values['end_month'] = $tmp_calculation_end_month;
            $contract_calculation_previous_values['start_year'] = $year;
            $contract_calculation_previous_values['end_year'] = ($tmp_calculation_end_month == 12) ? ($year+1) : $year;
        }
    }
    if($flag_found_calculation_period){
        if($is_month_starting_first_date)
            $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-01'));
        else
            $contract_calculation_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_values['start_year'].'-'.$contract_calculation_values['start_month'].'-'.$calculation_period_month_start_date));

        if($is_month_starting_first_date)
            $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$contract_calculation_values['end_month'].'-01'));
        else{
            $tmp_calc_next_month = $contract_calculation_values['end_month'] >= 12 ? 1: ($contract_calculation_values['end_month']+1);
            if($is_month_starting_last_date){
                $contract_calculation_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
                $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_date']. ' -1 day'));
            }else{
                $contract_calculation_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
            }
        }
    }
    else if(!$is_month_starting_first_date) { //for keeping previous calculation period
        $contract_calculation_previous_values['start_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['start_year'].'-'.$contract_calculation_previous_values['start_month'].'-'.$calculation_period_month_start_date));

        $tmp_calc_next_month = $contract_calculation_previous_values['end_month'] >= 12 ? 1: ($contract_calculation_previous_values['end_month']+1);
        if($is_month_starting_last_date){
            $contract_calculation_previous_values['end_date'] = date('Y-m-t', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-01'));
            $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_date']. ' -1 day'));
        }else{
            $contract_calculation_previous_values['end_date'] = date('Y-m-d', strtotime($contract_calculation_previous_values['end_year'].'-'.$tmp_calc_next_month.'-'.($calculation_period_month_start_date-1)));
        }
    }
    $tmp_calculation_start_month = ($tmp_calculation_end_month < 12) ? ($tmp_calculation_end_month+1) : ($tmp_calculation_end_month-12+1);
}
if(date('m', strtotime($contract_calculation_values['end_date'])) == $month)
        $contract_calculation_values['calculation_end_date'] = $contract_calculation_values['end_date'];
else
        $contract_calculation_values['calculation_end_date'] = date('Y-m-t', strtotime("$year-$month-01"));
    
        
echo "<pre>contract_calculation_previous_values: ".print_r($contract_calculation_previous_values, 1)."</pre>";
echo "<pre>Result set: ".print_r($contract_calculation_values, 1)."</pre>";
*/

//echo $date = '2014-01-30';
//echo date('Y-m-d', strtotime(date('Y-m-t', strtotime('2014-02-05')). ' -1 day'));
//$updated_date = date('Y-m-d', strtotime($date. ' +1 month'));
//echo "<pre>".print_r(array($date, $updated_date), 1)."</pre>";



/*echo microtime(true).'<br/>';
$milliseconds = round(microtime(true) * 1000);
echo 'Ms: '.$milliseconds.'<br/>';

$t = explode(".",microtime(true));
echo "<pre>".print_r($t, 1)."</pre>";
echo date("Y-m-d H:i:s",$t[0]).substr((string)$t[1],1,4);
//echo date("Y-m-d H:i:s",$t[1]).substr((string)$t[0],1,4);
echo '<br/><br/>strtotime: '.strtotime('2015-02-04');*/

/*require_once ('class/setup.php');
$obj_smarty     = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml'), FALSE);
echo "_SESSION<pre>".print_r($_SESSION, 1)."</pre>";*/
//echo phpinfo();
/*
for($i = 1990 ; $i <= 2025 ; $i++){
    echo $i. ' == '. date("W", mktime(0,0,0,12,31,$i));
    echo '<br/>';
}
*/

/*$total_table_sum = 502.40;
$total_table_sum = round($total_table_sum, 2);
$oresavrundning = round(round($total_table_sum) - $total_table_sum, 2);

echo sprintf('%.02f', $oresavrundning);
echo "<pre>".print_r(array($total_table_sum, $oresavrundning, $total_table_sum+$oresavrundning), 1)."</pre>";
*/
/*
for($i= 1; $i<10 ; $i++){
    $date = '2015-08-'.$i;
    echo $date.'  => '. date('N', strtotime($date)).'<br/>';
}
*/

/*require_once ('class/setup.php');
require_once ('class/root_operation.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","messages.xml", "user.xml","button.xml", 'tooltip.xml', 'contract.xml', 'reports.xml', 'mail.xml'),FALSE);
$obj_rt_op = new root_operation();

echo "<pre>".print_r($_SESSION, 1)."</pre>";*/

//$obj_rt_op->change_customer_user_name('maha001', 'maha015');
//$obj_rt_op->change_customer_user_name('maha001', 'maha016');//company 14 Hamed Maisar

/*
$obj_return         = new stdClass();
$obj_return->selected_date = 'abc';
$obj_return->swap_copied_slot = NULL;
$obj_return->selected_day_slots = '';
$obj_return->login_user_role = 123;
$obj_return->values = array(
            Array
                (
                    'id' => 49312,
                    'employee' => null,
                    'customer' => 'anst007',
                    'fkkn' => 1,
                    'created_status' => '',
                    'type' => 0,
                    'alloc_emp' => 'dodo001',
                    'comment' => '',
                    'alloc_comment' => null,
                    'cust_comment' => null,
                    'tl_flag' => 1,
                ),

            Array
                (
                    'id' => 49313,
                    'employee' => 'anfr005',
                    'customer' => 'anst007',
                    'fkkn' => 1,
                    'date' => '2015-10-07',
                    'cust_name' => null,
                    'emp_name' => 'Annelie Franconeri',
                    'tl_flag' => 1
                )

        );
echo json_encode($obj_return);
$obj_return = traverse_all_elements($obj_return);
echo '<br/><br/><br/>';
echo json_encode($obj_return);
function traverse_all_elements($data){
    if(!empty($data)){
        foreach($data as $key => $value){
//            echo $key .'==' .$value.'<br>';
            if(is_object($value)){
                if(is_object($data))
                    $data->$key = traverse_all_elements($value);
                else
                    $data[$key] = traverse_all_elements($value);
            }
            else if(is_array($value)){
                if(is_object($data))
                    $data->$key = traverse_all_elements($value);
                else
                    $data[$key] = traverse_all_elements($value);
            }
            else {
                if(is_null($value)) {
                    if(is_object($data))
                        $data->$key = '';
                    else
                        $data[$key] = '';
                }
            }
        }
    }
    return $data;
}
*/

/*$date = '2015-12-01';
//echo $date2 = date('Y-m-d', strtotime($date . ' +13 day'));
$date_last = '2015-11-30';

$datefrom = strtotime($date_last, 0);
$dateto = strtotime($date, 0);
echo $difference = floor(($dateto - $datefrom) / 86400);

echo '<br/>';
$starting_day_number = 9;
echo $day_2_14_remaining_no_of_days = 14-$starting_day_number;
echo $day_2_14_end_date = $date_14 = date('Y-m-d', strtotime($date . ' +'.$day_2_14_remaining_no_of_days.' day'));*/

/*require_once ('class/setup.php');
require_once ('class/root_operation.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","messages.xml", "user.xml","button.xml", 'tooltip.xml', 'contract.xml', 'reports.xml', 'mail.xml'),FALSE);
$obj_rt_op = new root_operation();

$obj_rt_op->create_secondary_dummy_logins();*/

//$app_dir = getcwd();
//require_once ($app_dir . '/class/php_Session.php');
//echo "<pre>".print_r($_SESSION, 1)."</pre>";
//echo "<pre>".print_r($_COOKIE, 1)."</pre>";

/*
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

echo random_color();*/

/*require_once ('class/setup.php');
require_once ('class/equipment.php');
require_once('class/employee.php');
$smarty = new smartySetup(array(),FALSE);
$obj_eq = new equipment();
$obj_employee = new employee();

//date_default_timezone_set('CET');

$start_time = new DateTime;
$start_time->setTimezone(new DateTimeZone('CET'));
echo $current_date_time = $start_time->format('Y-m-d G:i:s');

echo '<br/>';
echo date('Y-m-d H:i:s', strtotime($current_date_time));
echo '<br/>';
echo date('Y-m-d H:i:s').'<br/>';

$app_dtime = '2016-03-14 17.30';
$app_time = strtotime($app_dtime);
//echo date('Y-m-d H:i:s', $app_time);

$cur_dtime = '2016-03-14 11.30';
$cur_time = strtotime($cur_dtime);
//echo date('Y-m-d H:i:s', $cur_time);

echo $time_diff = $obj_eq->time_difference(date('H.i', $cur_time), date('H.i', $app_time));

$date_b4 = 2;

echo '<br/>';
echo $final = $time_diff/$date_b4;

echo '<br/>';
var_dump(intval($final) == $final);

echo '<br/>************************************<br/>';
$app_dtime = '2016-03-21 17.30';
$app_time = strtotime($app_dtime);
//echo date('Y-m-d H:i:s', $app_time);

$cur_dtime = '2016-03-15 10.30';
$cur_time = strtotime($cur_dtime);
//echo date('Y-m-d H:i:s', $cur_time);

$date_diff = $obj_employee->date_difference(date('Y-m-d', $cur_time), date('Y-m-d', $app_time));
echo $date_diff = $date_diff / (24 * 60 * 60);  // must b greater than zero

$date_b4 = 1;

echo '<br/>';
echo $final = $date_diff/$date_b4;

echo '<br/>';
var_dump(intval($final) == $final); //check day matched
echo '<br/>';

var_dump(date('H.i', $app_time) == date('H.i', $cur_time)); //check time matched
*/

/*error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('configs/config.inc.php');
global $db;
// open database-connection
$dbHandle = @mysql_connect("localhost",$db['username'],$db['password']);
$dbSel = @mysql_select_db($db['database_master'],$dbHandle);
if(!$dbHandle || !$dbSel){
    echo 'ERROR';
}
$res = mysql_query("SELECT * FROM company",$dbHandle);
echo mysql_affected_rows($dbHandle);
while($row = mysql_fetch_array($res)){
    echo "<pre>".print_r($row, 1)."</pre>";
//    $row = mysql_fetch_assoc($res);
}
    
*/

/*$app_dir = getcwd();
require_once ($app_dir . '/class/general.php');
require_once ($app_dir . '/class/employee.php');
$obj_general = new general();
$obj_employee = new employee();
$date1 = new DateTime('2016-01-11');
$date2 = new DateTime('2016-03-10');
$diff = $obj_general->diffInMonths($date1, $date2);
echo '<br/>'.$diff;
echo '<br/>';
echo $new_start_date = date('Y-m-d', strtotime('2016-03-10' . ' +1 day'));
echo '<br/>';
echo $new_end_date = date('Y-m-'.(date('d', strtotime('2016-01-10'))), strtotime($new_start_date . ' +'.($diff-1).' month'));

echo '<br/>';
$new_diff = $obj_employee->date_difference('2016-01-11', '2016-01-15');
echo $new_tot_day = abs(floor($new_diff / (24 * 60 * 60)));*/

/*$a = array('a', 'b', 'c');
$b = array_merge($a, array('d', 'e', 'f'));
echo "<pre>".print_r($b, 1)."</pre>";*/

/*ob_clean();
$app_dir = getcwd();
require_once($app_dir.'/plugins/F_pdf.class.php');
require_once($app_dir.'/plugins/fpdi/fpdi.php');
require_once($app_dir.'/class/setup.php');
require_once($app_dir.'/configs/config.inc.php');

$smarty_obj = new smartySetup(array(),FALSE);

$pdf = new FPDI();
$pdf->AliasNbPages();
$pdf->AddPage();        //page1
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 50, 50);

//$pdf->Image($smarty_obj->url.'images/t2v_billing_logo.png', 18, $pdf->GetY());
$pdf->Image($smarty_obj->url.'images/btn_cancel.gif', 18, $pdf->GetY());

$pdf->SetFont('Arial', 'B', 16);
$pdf->SetXY(18, $pdf->GetY() + 20);
$pdf->Cell(180, 5, 'Arion Infotech', 0, 1, 'C', FALSE);
$pdf->Output(); */
?>
<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
/*require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/company.php');
require_once('class/employee.php');
require_once('class/general.php');
require_once('class/mail.php');
$smarty_obj    = new smartySetup(array("company.xml", "user.xml", "mail.xml", 'forms.xml', "messages.xml"),FALSE);
$company_obj    = new company();
$obj_employee   = new employee();
$obj_general = new general();

global $preference, $company;

$current_date_static = date('Y-m-d');
$contract_end_date = date('Y-m-d', strtotime('+1 year -1 day'));
$companies = $company_obj->company_list();

//echo "<pre>".print_r($companies, 1)."</pre>"; exit();
echo "Date Range : $current_date_static -> $contract_end_date <br /><br />";
foreach($companies as $single_company){
//    echo $single_company['db_name'].'<br/>';
    
    if($single_company['contract_auto_renewal'] == 1){
        echo "<br /><br />================Company : ".$single_company['name']." ( ".$single_company['db_name']." )=============== <br />";
        echo "================================================================== <br />";
        $customer = new customer();
        $customer->select_db($single_company['db_name']);
        
        $current_date = $current_date_static;
        while($current_date <= $contract_end_date){
            $contracts = $customer->get_customer_contracts_end_with_the_date($current_date);
    //        echo "<pre>".print_r($contracts, 1)."</pre>";

            $mail_content = '';
            if(!empty($contracts)){
                foreach($contracts as $cont){
                    if($cont['have_future_contracts'] == 1)                continue;

                    //calculate_per_day_hour - <current contract>
                    $diff = $obj_employee->date_difference($cont['date_from'], $cont['date_to']);
                    $tot_day = abs(floor($diff / (24 * 60 * 60)))+1;
                    $per_day_hour = ($cont['hour'] / $tot_day);

                    $month_end_day_of_contract_to = date('t', strtotime($cont['date_to']));
                    $day_of_contract_start = date('d', strtotime($cont['date_from']));
                    $day_of_contract_end = date('d', strtotime($cont['date_to']));

                    $new_start_date = $new_end_date = $new_hour = '';

                    //Feb 1 - Mar 31
                    if($day_of_contract_start == 1 && $day_of_contract_end == $month_end_day_of_contract_to){
                        $new_start_date = date('Y-m-d', strtotime($cont['date_to'] . ' +1 day'));

                        $date1 = new DateTime($cont['date_from']);
                        $date2 = new DateTime($cont['date_to']);
                        $month_diff = $obj_general->diffInMonths($date1, $date2);
                        $new_end_date = date('Y-m-t', strtotime($new_start_date . ' +'.($month_diff-1).' month'));

                        $new_diff = $obj_employee->date_difference($new_start_date, $new_end_date);
                        $new_tot_day = abs(floor($new_diff / (24 * 60 * 60)))+1;
                        $new_hour = round($per_day_hour * $new_tot_day, 1);
                    }
                    //Jan 11- Mar 10
                    else if($day_of_contract_start == ($day_of_contract_end + 1) && date('Y|m', strtotime($cont['date_from'])) != date('Y|m', strtotime($cont['date_to']))){
                        $new_start_date = date('Y-m-d', strtotime($cont['date_to'] . ' +1 day'));

                        $date1 = new DateTime($cont['date_from']);
                        $date2 = new DateTime($cont['date_to']);
                        $month_diff = $obj_general->diffInMonths($date1, $date2);
                        $new_end_date = date('Y-m-'.$day_of_contract_end, strtotime($new_start_date . ' +'.($month_diff-1).' month'));

                        $new_diff = $obj_employee->date_difference($new_start_date, $new_end_date);
                        $new_tot_day = abs(floor($new_diff / (24 * 60 * 60)))+1;
                        $new_hour = round($per_day_hour * $new_tot_day, 1);
                    }
                    //else part (not have a sequence relation) like, Feb 17 - June 05 
                    else {
                        $new_start_date = date('Y-m-d', strtotime($cont['date_to'] . ' +1 day'));
                        $new_end_date = date('Y-m-d', strtotime($new_start_date . ' +'.($tot_day-1).' day'));
                        $new_hour = $cont['hour'];
                    }

                    $contract_period_details = $customer->get_ful_contract_detail($cont['id']);
        //            echo "<pre>".print_r($contract_period_details, 1)."</pre>";


                    $fkkn = $cont['fkkn'];
                    if($fkkn == 1){
                        $customer->b_fname  = $contract_period_details[0]['first_name'];
                        $customer->b_lname  = $contract_period_details[0]['last_name'];
                    }else{
                        $customer->kn_name  = $contract_period_details[0]['kn_name'];
                        $customer->kn_address = $contract_period_details[0]['kn_address'];
                        $customer->kn_postno= $contract_period_details[0]['kn_postno'];
                        $customer->b_iss    = $contract_period_details[0]['iss'];
                        $customer->b_sol    = $contract_period_details[0]['sol']; 
                        $customer->b_kn_ref_num = $contract_period_details[0]['kn_reference_no']; 
                        $customer->b_box    = $contract_period_details[0]['kn_box']; 
                    }

                    $customer->b_mobile     = $contract_period_details[0]['mobile'];
                    $customer->b_email      = $contract_period_details[0]['email'];
                    $customer->b_city       = $contract_period_details[0]['city'];
                    $customer->b_oncall     = $contract_period_details[0]['oncall'];
                    $customer->b_oncall2    = $contract_period_details[0]['oncall2'];
                    $customer->b_awake      = $contract_period_details[0]['awake'];
                    $customer->b_something  = $contract_period_details[0]['something'];

                    $customer->d_fname      = $contract_period_details[0]['first'];
                    $customer->d_lname      = $contract_period_details[0]['last'];
                    $customer->d_mobile     = $contract_period_details[0]['mob'];
                    $customer->d_email      = $contract_period_details[0]['mail'];
                    $customer->d_comment_other = $contract_period_details[0]['comments_other'];
                    $customer->d_comment_time = $contract_period_details[0]['comments_time'];
                    $customer->d_city       = $contract_period_details[0]['cities'];
                    $customer->date_from    = $new_start_date;
                    $customer->date_to      = $new_end_date;
                    $customer->user         = $cont['customer'];
                    $customer->d_document   = $contract_period_details[0]['documents'];

                    $transaction_flag = TRUE;
                    $customer->begin_transaction();
                    $id = $customer->add_customer_contract($cont['customer'], $new_hour, $new_start_date, $new_end_date, $fkkn);
                    if($id){
                        if( $customer->b_fname != "" || $customer->b_lname != "" || $customer->b_mobile!= "" || $customer->b_email!= "" || $customer->b_city!= "" || $customer->b_oncall!= "" || $customer->b_oncall2!= "" || $customer->b_awake!= "" || $customer->b_something!= "" ){
                            $customer->customer_contract_billing_insert($id, $fkkn);              
                        }  
                        if( $customer->d_fname != "" || $customer->d_lname != "" || $customer->d_mobile != "" || $customer->d_email != "" || $customer->d_city != "" || $customer->d_comment_time != "" || $customer->d_comment_other != "" || $customer->d_document != ""){
                            $customer->customer_contract_decision_insert($id, $fkkn);
                        }
                        $customer->commit_transaction();
                    } else{
                        $customer->rollback_transaction();
                        $transaction_flag = FALSE;
                    }

                    echo "Customer contract cloneID-".$cont['id']." | fkkn-$fkkn | customer-".$cont['customer']." | (id=$id) created<br/>";

                    if($transaction_flag){

                        $is_first_entry = FALSE;
                        if($mail_content == ''){
                            $is_first_entry = TRUE;
                            $mail_content .= '<table style="text-align: left;">';
                            $mail_content .= '<tr><th> '.$smarty_obj->translate['company'].' </th><td> : '.$single_company['name'].' </td></tr>';
                            $mail_content .= '</table>';
                        }

                        $fkkn_label = '';
                        switch ($fkkn){
                            case 1: $fkkn_label = $smarty_obj->translate['fk']; break;
                            case 2: $fkkn_label = $smarty_obj->translate['kn']; break;
                            case 3: $fkkn_label = $smarty_obj->translate['tu']; break;
                        }
                        if(!$is_first_entry) $mail_content .= '<hr />';

                        $mail_content .= '<table style="text-align: left;">';
    //                    $mail_content .= '<tr><th> '.$smarty_obj->translate['company'].' </th><td> : '.$single_company['name'].' </td></tr>';
                        $mail_content .= '<tr><th> '.$smarty_obj->translate['customer'].'</th><td> : '.$cont['last_name'] . ' ' . $cont['first_name']. ' </td></tr>';
                        $mail_content .= '<tr><th> '.$smarty_obj->translate['fkkn'].'</th><td> : '.$fkkn_label. ' </td></tr>';
                        $mail_content .= '<tr><th> '.$smarty_obj->translate['date_from'].'</th><td> : '.$new_start_date. ' </td></tr>';
                        $mail_content .= '<tr><th> '.$smarty_obj->translate['date_to'].'</th><td> : '.$new_end_date. ' </td></tr>';
                        $mail_content .= '<tr><th> '.$smarty_obj->translate['hours'].'</th><td> : '.$new_hour. ' </td></tr>';
                        $mail_content .= '<tr><th> '.$smarty_obj->translate['contract_rolled_from'].'</th><td> : '.$cont['date_from'] . ' '. $smarty_obj->translate['to'].' '. $cont['date_to'] . ' (' . $cont['hour'] . ' ' . $smarty_obj->translate['hours'] . ') </td></tr>';
                        $mail_content .= '</table>';
                    }

                }
            }

            if($mail_content != ''){
                echo $mail_content;
            }
            
            $current_date = date('Y-m-d', strtotime($current_date. ' +1 day'));
        }
    }
}
echo '<br/><br/><br/>Execution Completed';
exit();*/
?>
<?php
/*require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/general.php');
$obj_general = new general();

$employee_schedule_main_details['from_date']= '2015-12-02';
$employee_schedule_main_details['to_date']  = '2015-12-10';
$this_month_start_date                      = '2016-02-01';

//$employee_schedule_main_details['from_date']= '2016-03-03';
//$employee_schedule_main_details['to_date']  = '2016-03-08';
//$this_month_start_date                      = '2016-04-01';
$week_difference = $obj_general->datediff('ww', $employee_schedule_main_details['from_date'], $this_month_start_date, false);


if($week_difference >= 0){
    $template_start_day_number  = date('N', strtotime($employee_schedule_main_details['from_date']));
    $template_end_day_number    = date('N', strtotime($employee_schedule_main_details['to_date']));
    
    $template_start_week    = date('W', strtotime($employee_schedule_main_details['from_date']));
    
    $total_no_of_weeks_in_template = $obj_general->datediff('ww', $employee_schedule_main_details['from_date'], $employee_schedule_main_details['to_date'], false)+1;
    
    $new_week_to_start_circulation = '';
    $new_week_to_start_date_circulation = '';
    //Need seperate week to start new circulation of template slots
//    echo $new_week_to_start_circulation;
    //*********************************************************************
    
    echo '<br/>';

    if($template_start_day_number <= $template_end_day_number){
        $total_no_circulation_completed = (int) ($week_difference/$total_no_of_weeks_in_template);
//        $last_week_completed_circulation = $template_start_week + ($total_no_circulation_completed * $total_no_of_weeks_in_template) - 1;
//        $new_week_to_start_circulation = $last_week_completed_circulation + 1;
        $total_weeks_to_complete_circulations = $total_no_circulation_completed * $total_no_of_weeks_in_template;
        echo $new_week_to_start_circulation = date('W', strtotime($employee_schedule_main_details['from_date']." +$total_weeks_to_complete_circulations week")); 
        echo '<br/>';
        echo $new_circulation_start_date = date('Y-m-d', strtotime($employee_schedule_main_details['from_date']." +$total_weeks_to_complete_circulations week")); 
    }
    //Share the last week to begin next circulation of template slots
    else {
//        ++$total_no_of_weeks_in_template;
        $total_no_circulation_completed = (int) ($week_difference/$total_no_of_weeks_in_template);
        
        $total_weeks_to_complete_circulations = $total_no_circulation_completed * $total_no_of_weeks_in_template;
        echo $new_week_to_start_circulation = date('W', strtotime($employee_schedule_main_details['from_date']." +$total_weeks_to_complete_circulations week")); 
        echo '<br/>';
//        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
        echo $new_circulation_start_date = date('Y-m-d', strtotime($employee_schedule_main_details['from_date']." +$total_weeks_to_complete_circulations week")); 
    }
    
//    echo $total_no_circulation_completed;
//    $total_weeks_to_complete_circulations = $total_no_circulation_completed * $total_no_of_weeks_in_template;
//    echo $new_week_to_start_circulation = date('W', strtotime($employee_schedule_main_details['from_date']." +$total_weeks_to_complete_circulations week")); 
}*/



    /*$filename = "cache/Cirruslista.txt";
    $delimiter = "\t";
    $header = NULL;
    $data = array();

    
    function encode_value($val){
        return utf8_encode($val);
    }
    
    if (($handle = fopen($filename, 'r')) !== FALSE ) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {   
            if(!$header){
                $header = $row;
                foreach($header as $key => $val){
                    $header[$key] = encode_value($val);
                }
            }else{
                $data[] = array_combine($header, $row);
//                $data[] = $row;
            }
        }
        fclose($handle);
    }
    
    //encode values
    foreach($data as $key => $val){
        foreach($val as $key_index => $data_val)
            $data[$key][$key_index] = encode_value($data_val);
    }

//    echo "<pre>".print_r($header, 1)."</pre>";
    echo "<pre>".print_r($data, 1)."</pre>";*/
    
/*
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/root_operation.php');
$smarty = new smartySetup(array(), FALSE);
$obj_customer = new customer();
$obj_root_operation = new root_operation();

function encode_value($val){
    return utf8_encode($val);
}

function generate_username($first_name, $last_name, $obj_cus) {
    $first_name = strip_tags($first_name);
    $last_name = strip_tags($last_name);
    $first_remove = array();
    $last_remove = array();
    for ($i = 0; $i < strlen($first_name); $i++) {
        if ((ord(substr($first_name, $i, 1)) >= 97 && ord(substr($first_name, $i, 1)) <= 122) || (ord(substr($first_name, $i, 1)) >= 65 && ord(substr($first_name, $i, 1)) <= 90)) {
            continue;
        } else {
            $first_remove[] = substr($first_name, $i, 1);
        }
    }
    for ($i = 0; $i < count($first_remove); $i++) {
        $first_name = str_replace($first_remove[$i], "", $first_name);
    }
    for ($i = 0; $i < strlen($last_name); $i++) {
        if ((ord(substr($last_name, $i, 1)) >= 97 && ord(substr($last_name, $i, 1)) <= 122) || (ord(substr($last_name, $i, 1)) >= 65 && ord(substr($last_name, $i, 1)) <= 90)) {
            continue;
        } else {
            $last_remove[] = substr($last_name, $i, 1);
        }
    }
    for ($i = 0; $i < count($last_remove); $i++) {
        $last_name = str_replace($last_remove[$i], "", $last_name);
    }
    if ((ord(substr($first_name, 0, 1)) >= 97 && ord(substr($first_name, 0, 1)) <= 122) || (ord(substr($first_name, 0, 1)) >= 65 && ord(substr($first_name, 0, 1)) <= 90)) {
        $first_name_1 = substr($first_name, 0, 1);
    } else {
        $first_name_1 = "a";
    }
    if ((ord(substr($first_name, 1, 1)) >= 97 && ord(substr($first_name, 1, 1)) <= 122) || (ord(substr($first_name, 1, 1)) >= 65 && ord(substr($first_name, 1, 1)) <= 90)) {
        $first_name_2 = substr($first_name, 1, 1);
    } else {
        $first_name_2 = "a";
    }
    $obj_cus->first_name = $first_name_1 . $first_name_2;
    if ((ord(substr($last_name, 0, 1)) >= 97 && ord(substr($last_name, 0, 1)) <= 122) || (ord(substr($last_name, 0, 1)) >= 65 && ord(substr($last_name, 0, 1)) <= 90)) {
        $last_name_1 = substr($last_name, 0, 1);
    } else {
        $last_name_1 = "a";
    }
    if ((ord(substr($last_name, 1, 1)) >= 97 && ord(substr($last_name, 1, 1)) <= 122) || (ord(substr($last_name, 1, 1)) >= 65 && ord(substr($last_name, 1, 1)) <= 90)) {
        $last_name_2 = substr($last_name, 1, 1);
    } else {
        $last_name_2 = "0";
    }
    $obj_cus->last_name = $last_name_1 . $last_name_2;
    return $obj_cus->get_username(strtolower(substr($obj_cus->first_name, 0, 2)) . strtolower(substr($obj_cus->last_name, 0, 2)));
}

$filename = "cache/Cirruslista_copy.csv";
$delimiter = ",";
$header = NULL;
$data = array();

if (($handle = fopen($filename, 'r')) !== FALSE ) {
    while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
    {   
        if(!$header){
            $header = $row;
            foreach($header as $key => $val){
                $header[$key] = encode_value($val);
            }
        }else{
            $data[] = array_combine($header, $row);
//                $data[] = $row;
        }
    }
    fclose($handle);
}

//encode values
foreach($data as $key => $val){
    foreach($val as $key_index => $data_val){
        $data[$key][$key_index] = encode_value($data_val);
        
        if($key_index == 'SSN'){
            if(trim($data[$key][$key_index]) != '')
                $data[$key][$key_index] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($data[$key][$key_index]));
            
            $temp_gender = 1;
            if($data[$key][$key_index] != ''){
                $digit_9 = (int) substr($data[$key][$key_index], 8, 1);
                $temp_gender = ($digit_9 % 2 == 0 ? 2 : 1);
            }
            $data[$key]['Gender'] = $temp_gender;
        }
        
        if($key_index == 'Mobile'){
            $temp_mobile = NULL;
            if(trim($data[$key][$key_index]) != ''){
                $temp_mobile = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($data[$key][$key_index]));
                if (substr($temp_mobile, 0, 1) === '0'){
                    $temp_mobile = substr($temp_mobile, 1, 9999);;
                }
            }
            $data[$key]['Mobile_modified'] = $temp_mobile;
        }
    }
}


$generated_unames = array();
$generated_unames_without_digit = array();

//generate username
foreach($data as $key => $val){
//    $data[$key]['Username'] = generate_username($val['FirstName'], $val['LastName'], $obj_customer);
    $temp_uname = generate_username($val['FirstName'], $val['LastName'], $obj_customer);
    
    $uname_name_part = substr($temp_uname, 0, 4);
    $uname_digit_part = substr($temp_uname, (strlen($temp_uname) - 3), 3);
    
//    if(in_array($temp_uname, $generated_unames)){
    if(isset($generated_unames_without_digit[$uname_name_part])){
        $max_count = $generated_unames_without_digit[$uname_name_part] + 1;
        $count = sprintf('%03d', $max_count);
        $uname_digit_part = $count;
        $temp_uname = $uname_name_part . $count;
    }
    $generated_unames_without_digit[$uname_name_part] = $uname_digit_part;
    $generated_unames[] = $temp_uname;
    $data[$key]['Username'] = $temp_uname;
}


//    echo "<pre>".print_r($header, 1)."</pre>";
echo "converted data set: <pre>".print_r($data, 1)."</pre>";
echo '<br/><br/>*************************************************************************************<br/><br/>';
echo "generated_unames : <pre>".print_r($generated_unames, 1)."</pre>";
echo '<br/><br/>*************************************************************************************<br/><br/>';

$transaction_flag = $obj_root_operation->create_new_employees($data);
echo ($transaction_flag ? 'Success' : 'Failed');
*/

/*require_once('class/setup.php');
require_once('class/dona.php');
$smarty = new smartySetup(array(), FALSE);
$obj_dona = new dona();

$time_slot = '9.01';
$tmp_time_from  = $obj_dona->time_to_sixty($time_slot);
echo '<br/>'.$tmp_time_from;*/



//UUID: 12345678-1234-1234-1234-123456789012
/*$val = 'cifo';
$encoded = bin2hex($val);
$decoded = hex2bin($encoded);
echo "$val <br/> $encoded<br/>  $decoded<br/>------------------<br/>";

$encoded = base64_to_base16($val);
$decoded = base16_to_base64($encoded);
echo "$val <br/> $encoded<br/>  $decoded<br/>------------------<br/>";*/
/*

function base16_to_base64($base16) {
    return base64_encode(pack('H*', $base16));
}
function base64_to_base16($base64) {
    return implode('', unpack('H*', base64_decode($base64)));
}

//---------------------------------------

$year = 2016;
$month = 5;
$customer = 'cybr001';
$employee = 'cifo001';
$counter = 5;
echo 'UUID: '. $uuid = generate_custom_uuid($year, $month, $customer, $employee, $counter);
$decoded_data = decode_generated_uuid($uuid);
echo "<pre>Decoded values from UUID:  ".print_r($decoded_data, 1)."</pre>";

function generate_custom_uuid($year, $month, $customer, $employee, $counter){
    
    //
        // customer_alpha_part  => UUID[1] {1-6 digits}
        // customer_numeric_part=> UUID[2] {1-3 digits}
        // year                 => UUID[3]
        // month                => UUID[4]
        // employee_alpha_part  => UUID[5] {1-6 digits}
        // employee_numeric_part=> UUID[5] {7-9 digits}
        // counter              => UUID[5] {10-12 digits}
    //

    $cust_alpha_part = substr($customer, 0, 4);
    $cust_num_part = substr($customer, -3);
    $emp_alpha_part = substr($employee, 0, 4);
    $emp_num_part = substr($employee, -3);

    $encoded_cust_part = base64_to_base16($cust_alpha_part);
    $encoded_emp_part = base64_to_base16($emp_alpha_part);

    $uuid_array = array();
    $uuid_array[0] = $encoded_cust_part . '00';
    $uuid_array[1] = $cust_num_part . '0';
    $uuid_array[2] = sprintf('%04d', $year);
    $uuid_array[3] = sprintf('%04d', $month);
    $uuid_array[4] = $encoded_emp_part . $emp_num_part . sprintf('%03d', $counter);
    
//    var_dump($uuid_array);
    return implode('-', $uuid_array);
}

function decode_generated_uuid($uuid){
    $uuid_array = explode('-', $uuid);
    $year = (int) $uuid_array[2];
    $month = (int) $uuid_array[3];
    $counter = (int) substr($uuid_array[4], -3);
    
    $cust_num_part = substr($uuid_array[1], 0, 3);
    $cust_alpha_part = base16_to_base64(substr($uuid_array[0], 0, 6));
    $customer = $cust_alpha_part.$cust_num_part;
    
    $emp_num_part = substr($uuid_array[4], 6, 3);
    $emp_alpha_part = base16_to_base64(substr($uuid_array[4], 0, 6));
    $employee = $emp_alpha_part.$emp_num_part;
    
    return array(
        'year'      => $year,
        'month'     => $month,
        'customer'  => $customer,
        'employee'  => $employee,
        'counter'   => $counter
    );
    
}

$decoded_data = decode_generated_uuid('b5e72e00-0010-2016-0005-b216b2001001');
echo "<pre>Decoded values from UUID:  ".print_r($decoded_data, 1)."</pre>";*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

//header('Content-type: text/xml');
//$doc = new DOMDocument();
//$doc->loadXML($xml);
//$xml_converted = $doc->saveXML();
//echo $xml_converted;
//exit();

//$sUrl = 'https://shsmars.forsakringskassan.se:5000/shs2/FK.ASE.Tidredovisning.mars';

//phpinfo();
//$client = new SoapClient($sUrl);
////$message = xml2array($xml);
//$result = $client->exec($message);
//echo "<pre>".print_r($result, 1)."</pre>";
/*$client = new SoapClient($xml_converted);
echo "<pre>".print_r($client, 1)."</pre>";
var_dump($client->getFunctions());
var_dump($client->getTypes());*/

//$client = new SoapClient("http://footballpool.dataaccess.eu/data/info.wso?WSDL");
//$wsdl = "https://www.creditsafe.fr/getdata/service/CSFRServices.asmx?WSDL";
//$client = new SoapClient($wsdl);
//echo "<pre>".print_r($client, 1)."</pre>";
/*
class CbOrderProduct
{
    var $header;
    var $detail;

    function __construct()
    {
                $this->header = new stdClass();
                $this->detail = new stdClass();
    }
    function setheader($endpoint,$Certificaat)
    {
        $this->header->EndpointNm = $endpoint;
        $this->header->Certificaat = $Certificaat;
    }   

    function setdetail($ean,$orderreference,$clienid,$readingmethods,$retailerid)
    {
                    $this->detail->EAN =$ean;
                    $this->detail->OrderReference = $orderreference;
                    $this->detail->ClientId = $clienid;
                    $this->detail->ReadingMethods = $readingmethods;
                    $this->detail->RetailerId = $retailerid;
    }   
}

class exec0Request {

    var $arguments;

    function __construct($arguments) 
    {
        $this->arguments = $arguments;
    }
}
//phpinfo();

$order = new CbOrderProduct();
$order->setheader('123','123abc');
$order->setdetail('9789084999912','1988763767','K Koning','CR','12345');
$request = new exec0Request($order);
$client = new SoapClient("https://tst.eboekhuis.nl/cbwebs/CBWSCallEngine?WSDL");
$result = $client->exec(new SoapParam($request, "exec0Request"));*/
//phpinfo();
//header('Content-type: text/xml');
/*$doc = new DOMDocument();
$doc->loadXML($xml_org);
$xml_converted = $doc->saveXML(); 
//echo $xml_converted; 
//exit();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$sUrl);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_converted);
$sOutput = curl_exec($ch);
curl_close($ch);
echo "Output: <pre>".print_r($sOutput, 1)."</pre>";*/
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);

//echo file_get_contents("https://www.forsakringskassan.time2view.se/soap/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl");

//$cert_file = getcwd().'/cache/key.pem';
//$cert_file = getcwd().'/cache/key.pem';
//$cert_file = getcwd().'/cache/522.pem';
//echo file_get_contents($cert_file);

//$client = new SoapClient("http://192.168.0.234/works/app/t2v/cirrus-r/Nithin/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl", array('soap_version' => SOAP_1_2,'trace' => 1, 'exceptions' => true, 'connection_timeout' => 1, 'cache_wsdl' => WSDL_CACHE_NONE, 'local_cert' => $cert_file, 'passphrase' => 'helloworld' ));
//$client = new SoapClient("http://forsakringskassan.time2view.se/soap/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl", array('soap_version' => SOAP_1_2,'trace' => 1, 'exceptions' => true, 'connection_timeout' => 1, 'cache_wsdl' => WSDL_CACHE_NONE ));
//$client = new SoapClient("https://www.time2view.se/cirrus-r/cache/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl", array('soap_version' => SOAP_1_2,'trace' => 1, 'exceptions' => true, 'connection_timeout' => 1, 'cache_wsdl' => WSDL_CACHE_NONE ));
//$client = new SoapClient("https://www.time2view.se/cirrus-r/cache/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl");
//$client = new SoapClient("https://www.time2view.se/cirrus-r/cache/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl", array('soap_version' => SOAP_1_2,'trace' => 1, 'exceptions' => true, 'connection_timeout' => 1, 'cache_wsdl' => WSDL_CACHE_NONE, 'local_cert' => $cert_file, 'passphrase' => '2626946172126295'));
//echo("<br/>Dumping client object functions:<br/>");
//echo '<pre>'.print_r($client->__getFunctions(), 1).'</pre>';

/*$url = "http://www.time2view.se/cirrus-r/cache/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl";
$cert_file = dirname(__FILE__) . '/Nithin/533.pem';
$cert_password = '2626946172126295';
 
$ch = curl_init();
 
$options = array( 
    CURLOPT_RETURNTRANSFER => true,
    //CURLOPT_HEADER         => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
     
    CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
    //CURLOPT_VERBOSE        => true,
    CURLOPT_URL => $url ,
    CURLOPT_SSLCERT => $cert_file ,
    CURLOPT_SSLCERTPASSWD => $cert_password ,
);
 
curl_setopt_array($ch , $options);
 
$output = curl_exec($ch);
 
if(!$output)
{
    echo "Curl Error : " . curl_error($ch);
}
else
{
    echo htmlentities($output);
}
exit();*/


//-----------------------
$wsdl           = 'http://www.time2view.se/cirrus-r/cache/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl';
//$wsdl           = 'https://www.time2view.se/cirrus-r/testshaju.php';
//$endpoint       = 'https://shsmars.forsakringskassan.se:5000';
$endpoint       = 'https://shsmars.forsakringskassan.se:5000/shs2/FK.ASE.Tidredovisning.mars';

//$certificate    = dirname(__FILE__) . '/cache/522.p12';
$certificate    = dirname(__FILE__) . '/cache/533.pem';
$password       = '2626946172126295';

$opts = array(
    'ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false),
    'http'=>array('user_agent' => 'PHPSoapClient')
);

$context = stream_context_create($opts);

$options = array ('encoding' => 'UTF-8', 
    //'verifypeer' => false, 
    //'verifyhost' => false, 
    'soap_version' => SOAP_1_2, 
    'trace' => 1, 
    'exceptions' => 1, 
    "connection_timeout" => 180, 
    'stream_context' => stream_context_create($opts),
    'local_cert'    => $certificate,
    'passphrase'    => $password,
    'cache_wsdl'    => WSDL_CACHE_NONE
);

/*$options = array(
    'soap_version'  => SOAP_1_2,
    'stream_context'=> $context,
    //'uri'           => $wsdl,
    'location'      => $endpoint,
    'keep_alive'    => true,
    'trace'         => true,
    'exceptions'    => 1,
    'local_cert'    => $certificate,
    'passphrase'    => $password,
    'cache_wsdl'    => WSDL_CACHE_NONE
);*/

try {
    //$client = new SoapClient(NULL, $options);
    
//    libxml_disable_entity_loader(false);
//    $client = new SoapClient($wsdl, $options);
    $client = new SoapClient("https://www.time2view.se/cirrus-r/cache/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl", 
            array('soap_version' => SOAP_1_2,'trace' => 1, 'exceptions' => true, 'connection_timeout' => 1, 'cache_wsdl' => WSDL_CACHE_NONE, 'local_cert' => $certificate, 'passphrase' => '2626946172126295', 'encoding' => 'UTF-8', "connection_timeout" => 1800));
    //$header = new SoapHeader('http://schema.forsakringskassan.se/integration/isassistansersattning/tidredovisning/1', 'SkickaTidredovisningInteraction', array('Token' => 'hello'));
    //$client->__setSoapHeaders($header);
} catch(Exception $e) {
    echo "Exception1 :<pre>".print_r($e, 1)."</pre>";
    exit();
}
//exit();

//echo "hi";
//echo("<br/>Dumping client object functions:<br/>");
//echo '<pre>'.print_r($client->__getFunctions(), 1).'</pre>';
//exit();
$xml = '<?xml version="1.0" encoding="UTF-8"?><ns:Tidredovisning xmlns:ns="http://schema.forsakringskassan.se/integration/isassistansersattning/tidredovisning/1"><ns:id>91eb5e00-0010-2016-0001-69fada001002</ns:id><ns:redovisningsmanad>2016-01</ns:redovisningsmanad><ns:personSomHarAssistans><ns:personnummer>197505306634</ns:personnummer><ns:fornamn>Joel</ns:fornamn><ns:efternamn>Bergström</ns:efternamn></ns:personSomHarAssistans><ns:assistent><ns:personnummer>191212121220</ns:personnummer><ns:samordningsnummer>197503831111</ns:samordningsnummer><ns:fornamn>Olle</ns:fornamn><ns:efternamn>Ek</ns:efternamn><ns:kollektivavtal>false</ns:kollektivavtal></ns:assistent><ns:berakningsperiod><ns:fromDag>2016-01-01</ns:fromDag><ns:tomDag>2016-01-31</ns:tomDag></ns:berakningsperiod><ns:anstalldAvPersonSomHarAssistans>false</ns:anstalldAvPersonSomHarAssistans><ns:assistansanordnare><ns:anordnareNamn>Cirrus-Dem</ns:anordnareNamn><ns:organisationsnummer>5568727324</ns:organisationsnummer><ns:kontaktperson>Gilad N</ns:kontaktperson><ns:telefonnummer>0704-434964</ns:telefonnummer><ns:assistentAnstalldAvAnordnare>false</ns:assistentAnstalldAvAnordnare><ns:annanArbetsgivare><ns:arbetsgivareNamn>string</ns:arbetsgivareNamn><ns:organisationsnummer>token</ns:organisationsnummer></ns:annanArbetsgivare><ns:assistentEgenForetagare>false</ns:assistentEgenForetagare></ns:assistansanordnare><ns:tidrapport><ns:rapportRad><ns:dag>04</ns:dag><ns:fromTid>1.00</ns:fromTid><ns:tomTid>2.00</ns:tomTid><ns:aktivTid>TRUE</ns:aktivTid><ns:vanteTid>FALSE</ns:vanteTid><ns:beredskapsTid>FALSE</ns:beredskapsTid></ns:rapportRad></ns:tidrapport><ns:datumForUnderskriftAnordnare>2016-06-14+12:21</ns:datumForUnderskriftAnordnare><ns:telefonnummerAnordnare>1933211234</ns:telefonnummerAnordnare><ns:datumForUnderskriftAssistent>2016-06-14+12:21</ns:datumForUnderskriftAssistent><ns:telefonnummerAssistent>40909000</ns:telefonnummerAssistent></ns:Tidredovisning>';
//echo base64_encode($xml);
//header('Content-type: text/xml');
$doc = new DOMDocument();
$doc->loadXML($xml);
$xml_converted = $doc->saveXML();
//echo $xml_converted; exit();


$signature = 'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PFNpZ25hdHVyZSB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC8wOS94bWxkc2lnIyI+PFNpZ25lZEluZm8geG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvMDkveG1sZHNpZyMiPjxDYW5vbmljYWxpemF0aW9uTWV0aG9kIEFsZ29yaXRobT0iaHR0cDovL3d3dy53My5vcmcvVFIvMjAwMS9SRUMteG1sLWMxNG4tMjAwMTAzMTUiPjwvQ2Fub25pY2FsaXphdGlvbk1ldGhvZD48U2lnbmF0dXJlTWV0aG9kIEFsZ29yaXRobT0iaHR0cDovL3d3dy53My5vcmcvMjAwMC8wOS94bWxkc2lnI3JzYS1zaGExIj48L1NpZ25hdHVyZU1ldGhvZD48UmVmZXJlbmNlIFR5cGU9Imh0dHA6Ly93d3cuYmFua2lkLmNvbS9zaWduYXR1cmUvdjEuMC4wL3R5cGVzIiBVUkk9IiNiaWRTaWduZWREYXRhIj48VHJhbnNmb3Jtcz48VHJhbnNmb3JtIEFsZ29yaXRobT0iaHR0cDovL3d3dy53My5vcmcvVFIvMjAwMS9SRUMteG1sLWMxNG4tMjAwMTAzMTUiPjwvVHJhbnNmb3JtPjwvVHJhbnNmb3Jtcz48RGlnZXN0TWV0aG9kIEFsZ29yaXRobT0iaHR0cDovL3d3dy53My5vcmcvMjAwMS8wNC94bWxlbmMjc2hhMjU2Ij48L0RpZ2VzdE1ldGhvZD48RGlnZXN0VmFsdWU+cklwQjNnRS9vL2JWcjI2Zm90dVdCbHR6alhCNm5HMEpWY29FM1A1ZnB3Zz08L0RpZ2VzdFZhbHVlPjwvUmVmZXJlbmNlPjxSZWZlcmVuY2UgVVJJPSIjYmlkS2V5SW5mbyI+PFRyYW5zZm9ybXM+PFRyYW5zZm9ybSBBbGdvcml0aG09Imh0dHA6Ly93d3cudzMub3JnL1RSLzIwMDEvUkVDLXhtbC1jMTRuLTIwMDEwMzE1Ij48L1RyYW5zZm9ybT48L1RyYW5zZm9ybXM+PERpZ2VzdE1ldGhvZCBBbGdvcml0aG09Imh0dHA6Ly93d3cudzMub3JnLzIwMDEvMDQveG1sZW5jI3NoYTI1NiI+PC9EaWdlc3RNZXRob2Q+PERpZ2VzdFZhbHVlPmtxYlJSSnZ5ald3enAweTVEN2J4YjJGeS9xK2l0bEcyMDFWOGc5djJkalk9PC9EaWdlc3RWYWx1ZT48L1JlZmVyZW5jZT48L1NpZ25lZEluZm8+PFNpZ25hdHVyZVZhbHVlPk1uWnNtTysrSCs1VWpIbHU5ME9QMUpQZGIrVHhSNXF6NzFDQ3ZzUk0ycUJnTHRaL2Nnb0c1QUZoMWtOWHhrd0tzaEZ3MW8rQWh4WVc1SCtkNDNnSFhQOUpWNXRYRE1CTEpmc0NqbllFeFpqRDhuQTdrcVZaRlJkZGo3bnRKZFVMYm9CU1RWN3gxR1RIbHRHSW9PcHY0VGErdWQveGtMWllvcTBVMjdFVEphQkFnTEI5N2JqMkxpclhGL1lkQWFSTnAwT3dqRU51RDBkVWRUek5BSk9FaTVUdkZkTzIyNE1LTm15TzhuMUdod2kyc1AxUGZqaU9XTE80R3puSEg0Z0VRNFBsUUFkNm8zWEp1SmtYZ3VOMXlSZnIzNjhPR05YVDdWSjJpUllVSzJHV0s2KzdZWUZhc2N4SFB6ZEZaNGpMcmJNeldabGNzdUZ6citDVVJ5bGNxZz09PC9TaWduYXR1cmVWYWx1ZT48S2V5SW5mbyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC8wOS94bWxkc2lnIyIgSWQ9ImJpZEtleUluZm8iPjxYNTA5RGF0YT48WDUwOUNlcnRpZmljYXRlPk1JSUZnakNDQTJxZ0F3SUJBZ0lJYUxDWlNiaXp1ZEl3RFFZSktvWklodmNOQVFFTEJRQXdnWkV4Q3pBSkJnTlZCQVlUQWxORk1TZ3dKZ1lEVlFRS0RCOVRkbVZ1YzJ0aElFaGhibVJsYkhOaVlXNXJaVzRnUVVJZ0tIQjFZbXdwTVJNd0VRWURWUVFGRXdvMU1ESXdNRGMzT0RZeU1VTXdRUVlEVlFRREREcFRkbVZ1YzJ0aElFaGhibVJsYkhOaVlXNXJaVzRnUVVJZ0tIQjFZbXdwSUVOMWMzUnZiV1Z5SUVOQk1pQjJNU0JtYjNJZ1FtRnVhMGxFTUI0WERURTBNVEF5TURBeE16RXhNMW9YRFRFNU1UQXhPVEl4TlRrMU9Wb3dnYWt4Q3pBSkJnTlZCQVlUQWxORk1TZ3dKZ1lEVlFRS0RCOVRkbVZ1YzJ0aElFaGhibVJsYkhOaVlXNXJaVzRnUVVJZ0tIQjFZbXdwTVEwd0N3WURWUVFFREFST1pYWnZNUTR3REFZRFZRUXFEQVZIYVd4aFpERVZNQk1HQTFVRUJSTU1NVGsxT0RBM01ERXlNRFU0TVNVd0l3WURWUVFwREJ4SGFXeGhaQ0JPWlhadklDMGdRbUZ1YTBsRUlIRERwU0JyYjNKME1STXdFUVlEVlFRRERBcEhhV3hoWkNCT1pYWnZNSUlCSWpBTkJna3Foa2lHOXcwQkFRRUZBQU9DQVE4QU1JSUJDZ0tDQVFFQXhwaXJaQjZsZVJCbkwwWS9NRjdDSWdqakV4ejRrdzd0R2ZhZWlTN1djZG44QWlZM1h0Q0txSE83czJ3MVppSTlCMzd0ekNTVHdRS1BVWDFGVFh0aEFrYm16dXJUeFVoQkJYRnZ1WGxpTFVsL3NNTmh5Mk9DT3VlZ0FJSUxTN2tseFFNTktJOXladSt0c1FiSHNKSThxVVRTM09PQzJWRVNybWxicytHWGZwQ25nZUpOOEx3c1BJRTZyc0kyOHp1OVFVTXg0ckgyVUFZYmc5Q3orOVlJa3ZvZWR4S3g3OVk5VklkNHFsdWN5R3pHZkpsYlpOU0JQcWxZWGlHU2NCWThibHpLc1R4eFVBRE9IWHFLazR1S0dnN0wxVytHdGNNelBYbm9KcFpiVzNvWEUwUEkwQ1FFTVhRdGdiNThvcDQ2OTF5NlZvWHkzVFhBZi9DbW9wWVNCUUlEQVFBQm80SERNSUhBTURzR0NDc0dBUVVGQndFQkJDOHdMVEFyQmdnckJnRUZCUWN3QVlZZmFIUjBjRG92TDI5amMzQXVjbVYyYjJOaGRHbHZibk4wWVhSMWN5NXpaVEFUQmdOVkhTQUVEREFLTUFnR0JpcUZjRTRCQWpBT0JnTlZIUThCQWY4RUJBTUNCa0F3SEFZR0tvVndJZ0lCQkJJVEVEazNOVEkyTVRFNU56UXhOekl6Tmpnd0hRWURWUjBPQkJZRUZJbFZJejVDL3IyM3BURWFmeTRZUXd4UHFMWEtNQjhHQTFVZEl3UVlNQmFBRk10MWdzellZS2ZtUzZvSjFIV0hyV0IwaXpXcU1BMEdDU3FHU0liM0RRRUJDd1VBQTRJQ0FRQXNxNGpua3RoRUtwZWN3RWFSVlYxd0NJNFlUQkZmNk5XNXZFZkE1RFFxTTZQYkhiOTJqdnh3Y2FhMEdTTldiYVl6YU5YMWdxRW8zRmNZVXkrbnczdk4vZVRjUEFFZ1VzbHZTSDZkaWJDNmZ1SjFNQmU5M0dwbnI4TXB2S3hEeWFKTGdjNjR6SnUwaVV2SEd0VTlzbHB5ZVVvWWY3T3NkekpPYWltMHU2dnVpbldlWCs2R2JIYjhLYTVWVmh5RURnZXRkUEFkVjhWcFpDVjhydm0ySklaVkNKU0pCeTloRithUTlUaUNKSXJ1czZ6SXZxL2ZiYnNpTWFlVm81bUZSUjQwN3hKci8rakxkSitScjNBS0cva1VHYmFZL0djenNoZzNmbGFoUGt1RDRuWHFRcG56dGpIcHVmVUJKQkpuOFB1dDdlRzYvbHdaOXo1SGdLRHlqYkovRENLZElYZkZmQnZjenF0ZVVwcUJNZXp2aE43azVFaDRmbHg5czlyWSsrWXZCbHp1dkt0THJ5VG55eGlvZkh6dDQvcWVJSUZGbWp5TVU2Rm9vNXg4THdQQXIvdDltU1ZMckxPQm9oNld4MlJVUnJCaGIyZU5NaXhzbGYzQTYwR25hMTV3SThUZ09lSEwwcGdobWJVNTNQc29JeEVYNkpZQjBJQVh0cEZTSm5XRHlObFkxdWN3ZjZuR1RsQ3AxZUVGbGIzaHQzY3daWFZqQ3d1WFBNQVRJR1c0eVBEcm1Wd0Z5eWRPVzNVQmsrUzlQeVB1OUtqaytxU0pmek5yR1pqVVZHaXBDdlNVdVQyZ0g1L29FakRXUGEzNysyYVdjcC9qYVA1K1Rkekh0K0JwUFZ2MW9QWGl0dmk1akx4TCt5RG40bytzcVRZalg3cGFIREpvb0xVSm5RPT08L1g1MDlDZXJ0aWZpY2F0ZT48WDUwOUNlcnRpZmljYXRlPk1JSUdGRENDQS95Z0F3SUJBZ0lJY1lLYU9rajZsdEF3RFFZSktvWklodmNOQVFFTkJRQXdnWWN4Q3pBSkJnTlZCQVlUQWxORk1TZ3dKZ1lEVlFRS0RCOVRkbVZ1YzJ0aElFaGhibVJsYkhOaVlXNXJaVzRnUVVJZ0tIQjFZbXdwTVJNd0VRWURWUVFGRXdvMU1ESXdNRGMzT0RZeU1Ua3dOd1lEVlFRREREQlRkbVZ1YzJ0aElFaGhibVJsYkhOaVlXNXJaVzRnUVVJZ0tIQjFZbXdwSUVOQklIWXhJR1p2Y2lCQ1lXNXJTVVF3SGhjTk1USXhNakV6TVRBd01qTTJXaGNOTXpReE1qQXhNVEF3TWpNMldqQ0JrVEVMTUFrR0ExVUVCaE1DVTBVeEtEQW1CZ05WQkFvTUgxTjJaVzV6YTJFZ1NHRnVaR1ZzYzJKaGJtdGxiaUJCUWlBb2NIVmliQ2t4RXpBUkJnTlZCQVVUQ2pVd01qQXdOemM0TmpJeFF6QkJCZ05WQkFNTU9sTjJaVzV6YTJFZ1NHRnVaR1ZzYzJKaGJtdGxiaUJCUWlBb2NIVmliQ2tnUTNWemRHOXRaWElnUTBFeUlIWXhJR1p2Y2lCQ1lXNXJTVVF3Z2dJaU1BMEdDU3FHU0liM0RRRUJBUVVBQTRJQ0R3QXdnZ0lLQW9JQ0FRREZtQ3FsbzloZklacGpoZ3lCY3Y1TXNCaVA1NldLek4xTGhSSm1hTEpreDNpMzhBb3FEZGM0dkc2RHYzWmJJSU5ta0lxR2pVN3JqZENjdy9WY2lLbTRmNmZVTjR2Z0VIZWF6VHBQZXhIVVdUN0ZWeVFib1lNMEVYcGJvOGRMSkxEWUhLSmhnSlRuOW5sZmsvbzd3UW9Zamx4S1cxL0ZyaXFvZEIyYWV6WjdKRThCOXBXcGdxWkRPdk1NVHN3OWhIQ2hLSEJGd0tDVDZ4VzVsRlFlcVg3MGR0NGlXSWdJVHVEcWRaamRvT1NtT1p6cUNPWmlodDl1OWRUazJWVEFOblZCOXRMZkZSSXViZU9qZ1RYVzNQcmN0UWsybWo5UmNYRmFxbWtIT2l4UnJ2a1RpcDJSMVpTVW5XWFRQQlNvNno3Tk5jdjV3emxOeDBuNnJoLzhpQXdTeklKY2lkcld2NWFqKzA1SDJjZVppMFlVbmx0RGk1SzloMXcrNUtSYWM5QXcrNTZzNE5WaVpSQUMzb1FROXBpY3EyZlQ0cWJDMWVQSEpRaU9QM2Mxbm92ZkZzYnk0VEM5eXdOQTVlOTdScHNSUlhnVHJRbk9xekhqOTZlNitoUWxnVXM4aStYZGVoM1IyUlNxZndJd0ZYTXJSZzFCRGJya2FNbFZnU05qSjIxZXlJNjlQWTZoUFdueE95RW41bnBYUyt5eWNndHBQM2ZVd1dlcUNDOGRnd3hYQjA1Tk95UnRQUVdWYVJ4WWlOUTZOdnFYaXdVQUFxbHNKaitWZjlyR1FuMTQ0N2NCL3YwcmFpSHh6M2hwL1VmMFgvakdJc1lEYmlkZXd2bFlMcUtPVnFhUVh1THU3YmhQdHl2NVpHelFVYVFWa2o3QkJSem9sY3JtQVhBNVN3SURBUUFCbzNnd2RqQWRCZ05WSFE0RUZnUVV5M1dDek5oZ3ArWkxxZ25VZFlldFlIU0xOYW93RHdZRFZSMFRBUUgvQkFVd0F3RUIvekFmQmdOVkhTTUVHREFXZ0JTSWpGWkpCTTBTQTVxZFMxYVRoQ0xuc0FHZGpUQVRCZ05WSFNBRUREQUtNQWdHQmlxRmNFNEJBakFPQmdOVkhROEJBZjhFQkFNQ0FRWXdEUVlKS29aSWh2Y05BUUVOQlFBRGdnSUJBRnIvYXV5aERFOW1OYkE3Um5BNjMrODVEYXB5WmJGN3VSMGNHUWhCVXlTMWo2andXN2JRaEx1RXMvZUEvSC9GSE5PVk1VUUlEUWQyQVZ4SFlkRjlLOTNncTYvdW1Ra0puZlFOVXQ0Q0hNd1o5N01CNnI0RzljckgxYlNZeDFsS3JQWnl1M0JBdEs0S0t1WFVYd3o4bHVvbDNjclZTalZVdTBZSzU1NDh4N0FYZjhNRDBaTkZOM2RlWlNMczhDZnpHWTB4UUVHeE1MYnM4RHBOYmlJMmZseWxKc1hka2c4V3BsS3c5ZTNRRWRUazBzcVltT2VnRG1LTy9SOHJ1eFNSTTVSN0xoNStGVTFtYjlqRWN3bTFzVHVsd3RZdmk3dDdnT3E3TVhvZ1pnMlhQdTFudU1NVTJyaDVpSVdmVDRkNitBVUZwc0ZMY1JGWmdEOXJQUkJXMXAwcmgxUHdPV2ZQSUl5N2xEMWpaUEUrYVhCc1Y1b1N0Z1NrU2F0bmhnNXA5ZUZtOFFXVklBZHAzL3hKY1RKaGlIZXdzWm00S2YrZkJSZDZwbkc2MGt4L2Vsbjg1Y1FNczNnM3RoYUwvZDFCZ3YvZDMvdEJBUEZpRmRBZUxLcEUyL1VaSjBLOGJFUkxJZEpYQUx4aHlzWmVPTEZsdTdlOFVqNm1wQ1Jrdm84ZmE0dGltSUhjdjlzUHF0RCtSYlJxTGkwQlpseUMvblNqN2U2VjdSRC9nTWRhajB3Q1Y0UnE0bmxFOXBzMDJtTytEcUptcUlVYkVEME5ubDFrR1JGUjNIaXkxRzJodE5PKzN5eE5seWwvVkRLd0xZVWljK3pEQXdEVGNBL2lvUDhkeHlIU2xjbHdwU0J1ek5DSEY2cnJUT1pLS2JTS0wxMjFDdUpFMlFncjF5QkE8L1g1MDlDZXJ0aWZpY2F0ZT48WDUwOUNlcnRpZmljYXRlPk1JSUY1VENDQTgyZ0F3SUJBZ0lJWFU1NC93WU9jaTR3RFFZSktvWklodmNOQVFFTkJRQXdZekVrTUNJR0ExVUVDZ3diUm1sdVlXNXphV1ZzYkNCSlJDMVVaV3R1YVdzZ1FrbEVJRUZDTVI4d0hRWURWUVFMREJaQ1lXNXJTVVFnVFdWdFltVnlJRUpoYm10eklFTkJNUm93R0FZRFZRUUREQkZDWVc1clNVUWdVbTl2ZENCRFFTQjJNVEFlRncweE1qQXpNVFl4TWpJd05UVmFGdzB6TkRFeU16RXhNakl3TlRWYU1JR0hNUXN3Q1FZRFZRUUdFd0pUUlRFb01DWUdBMVVFQ2d3ZlUzWmxibk5yWVNCSVlXNWtaV3h6WW1GdWEyVnVJRUZDSUNod2RXSnNLVEVUTUJFR0ExVUVCUk1LTlRBeU1EQTNOemcyTWpFNU1EY0dBMVVFQXd3d1UzWmxibk5yWVNCSVlXNWtaV3h6WW1GdWEyVnVJRUZDSUNod2RXSnNLU0JEUVNCMk1TQm1iM0lnUW1GdWEwbEVNSUlDSWpBTkJna3Foa2lHOXcwQkFRRUZBQU9DQWc4QU1JSUNDZ0tDQWdFQWxNNFBhdk8zTm0xN0hiRkFoZWVSMzJsa0dJTXlDT2wxK0lzUWM2L1Q5WDN0NUJwRXFhakVkQlVNTm1XbExPRDFHSUdEZDBtVm9XVzJIZ3ZFTmcyK2oyYTVGd3l5Y0FTZEJUTXUzWHE3ZWdsQjA3MHdJSWVHSkJCcU5TR0hITHY3RG1BSzdyOXhLWDBpSUNLMDNqWjVGUWZlNWxXS2V5OVZmN1NwWlFUNGx5WHVDVk5wUHkweGlCMmFwLys2dHRoTndrbldleWRmZTlxVDVuTEVLU0w1bXBaQTZrNi85bVU0TGExT0grRVlCdDByWk9WZmZJc3grQ0JzRURZbXQ4NU4yTXN3aUwrWGtNelVoMEhQbDg2WHdEZlFlQllVU05GZXZpaHgxdHBaa0E5aDJFNTV4Q082QThSYmN6Yzd1WkFYTXNxSnVWb3E5YklqbjBZbWwyZE5lQ0dRMFp5NnFWZXo1MVkreVhnR1JqOWwzSXRENlVObjZsVU1YUG91a0ZISFFKb3ZJZzBrdFJhUU1kKy9nZ0VwZjVtRXpQZHZmVVdmNndxVmdYbUl0Vk9wQTFQQXgrTFB2ZC9SQWNRV2JlQlRJVXk1bk9Qc3BnT1lMZktHUGFBN3JyVTMzVXlpQmNTS1g4K3grRTVocEQ4aUp1czhib3Z4anNlUUVGa0JnQVpXdldMZkh1QmRJT2hNcUpEL1RXRCtQblJRNXN5eEZiRTIwNkdoNHBJTUxLWFJ0RWdsL2FaQVczQ1QzUTBqUDNDM0RjSFFIK2huNTdGYm5ibFo0dS9zMVpVTFF0TG5ETnk5cFpZMEkvT0RkMjVEYjgraFM1RlgvdEgwNjNZUVhNcWw0NEY1c1B1NEpYRFdwcXpFTDB3NzlVc0lqVlpsWjRKbmp2N1R6dmRkbnowQ0F3RUFBYU40TUhZd0hRWURWUjBPQkJZRUZJaU1Wa2tFelJJRG1wMUxWcE9FSXVld0FaMk5NQThHQTFVZEV3RUIvd1FGTUFNQkFmOHdId1lEVlIwakJCZ3dGb0FVWjRxNnN1cElISHIxTzJnM0ozSUc2NUZqeTFNd0V3WURWUjBnQkF3d0NqQUlCZ1lxaFhCT0FRRXdEZ1lEVlIwUEFRSC9CQVFEQWdFR01BMEdDU3FHU0liM0RRRUJEUVVBQTRJQ0FRQjZxN1kweS8yZmt3a3pTaUY0Vk8wWUpDS0FSVkRXUU45ZEJKWThSUVZIMVc1N3pnY1FsMFc0eXZKd1k0dVZGUFZOUmNWVVhsL3hqNnZYN3dyMzJIUFVLZkhHSytQR0o2OXYxUStYdG8veTNHczVWMUhCait1LzR1bU45L2xncXBwM0pyb0MraTQ3WjVUS2hqNGZmTi80L2lOS3Z2SVRxa2RCV2VxVUZFZE10cGVrWU9TQ20xbU1ITE5QamxDd1VHKzl4M3pPcUtLVkdhRUxRRTZabW5hdURra1VwYS9RblcxazJwSUs2Qit0c1lUbWpmaHFIS2V3OWdndnk2NmZKdUhrSWxGNEo1T0lhYUNWd1RITzUzbFAzbTd3V0l1T3JqTkxxS2lGZFBWQUVSSStzdENvalJONEtFMDBvTWFJOFd3UnVDQ2V3YkkrQlhwdFJYWVBvNXlDQUJSaldYcnNjSGRWY1ZpVWR5VXlYemNWUXdqZ2Q2eGROMTVxVEk5VjJYSG9pTkg4MGVuWTJFNWYvcWw3bG41OEdsM0FTT29hSTlrZG5pRXpvaktob2RKaFFqRFFYRnRHalhPRGJJUGlMYzRleW5iNzVjWEtLb1MzanpjVm1ISnY2TElqZUl3R1dKMXZIazZhZ09JUzk0ME5TTGhCOW9ydUZXL1Y3b2laTlVCSUhlS3hGNzRTOWFZZUV2Rjd0aUNlMklMN0hTWEJibG5yVzN0K1hobERnYWp2TVpBUUZqamhxRjIxQmt3d2FQclg5eVZjLzRLTThQektXL3pRZlBlREUrckVaMW1XV1dpSk5BZjZpMW5DOU04WGJCN0dhVFEzSUxNS0tpM3Q1UTkrc0c1VTRwQzdWdTJaT0sydHNtUlJIa1NIOXJ0dDQ0dnp4SndOc2RCclZ3PT08L1g1MDlDZXJ0aWZpY2F0ZT48L1g1MDlEYXRhPjwvS2V5SW5mbz48T2JqZWN0PjxiYW5rSWRTaWduZWREYXRhIHhtbG5zPSJodHRwOi8vd3d3LmJhbmtpZC5jb20vc2lnbmF0dXJlL3YxLjAuMC90eXBlcyIgSWQ9ImJpZFNpZ25lZERhdGEiPjx1c3JWaXNpYmxlRGF0YSBjaGFyc2V0PSJVVEYtOCIgdmlzaWJsZT0id3lzaXd5cyI+U1c1bWIzSnRZWFJwYjI0Z1pzTzJjaUJ6YVdkdVpYSnBibWNnWm5MRHBXNGdRMmx5Y25WeklIUnBaSE55WVhCd2IzSjBaWFJwYm1jc0lHZkRwR3hzWVdSbElIUnZkQzRnWVhKaVpYUnpkR2xrSUUzRHBXNWhaQy9EcFhJZ0lHRndjbWxzSURJd01UWUtWRzkwWVd3Z2RHbHRiV0Z5SUdGeVltVjBjM1JwWkRvZ0lESTRMakF3Q2xSdmRHRnNJSFJwYlcxaGNpQm1jc09sYm5aaGNtODZJQ0F3Q2c9PTwvdXNyVmlzaWJsZURhdGE+PHNydkluZm8+PG5hbWU+WTI0OVJXZHlaV1Z0Wlc1MElFRkNMRzVoYldVOVJTMWhkblJoYkN4elpYSnBZV3hPZFcxaVpYSTlOVFUyTnpBd05ETTVOQ3h2UFVSaGJuTnJaU0JDWVc1cklFRlRJRVJoYm0xaGNtc2dVM1psY21sblpTQkdhV3hwWVd3c1l6MVRSUT09PC9uYW1lPjxub25jZT5ZalpNN21HYzg4Wkg5Vk5Rb1ZJU3NDa0J4L009PC9ub25jZT48ZGlzcGxheU5hbWU+UlMxaGRuUmhiQT09PC9kaXNwbGF5TmFtZT48L3NydkluZm8+PGNsaWVudEluZm8+PGZ1bmNJZD5TaWduaW5nPC9mdW5jSWQ+PHZlcnNpb24+VUdWeWMyOXVZV3c5Tnk0eUxqRXVNU1pDWVc1clNVUmZaWGhsUFRjdU1pNHhMakVtUWtsVFVEMDNMakl1TVM0eEpuQnNZWFJtYjNKdFBYZHBialkwSm05elgzWmxjbk5wYjI0OWQybHVNVEFtZFdocFBXY3pOaTh2V1VzMU1UZHlhWEo2ZDBzMlJERlBZbWgwT0dGbU9IVW1iR1ZuWVdONWRXaHBQV2RwVm5sSE5sWkhhbkEzUVhwQ1MwRXhXR05uUmpsemRGTXJNQzhtWW1WemRGOWlaV1p2Y21VOU1UUTNNVFF6TVRjMU5TWlRiV0Z5ZEVOaGNtUmZVbVZoWkdWeVBVaGhibVJsYkhOaVlXNXJaVzRnWTJGeVpDQnlaV0ZrWlhJZ01DWT08L3ZlcnNpb24+PGVudj48YWk+PHR5cGU+VjBsT1JFOVhVdz09PC90eXBlPjxkZXZpY2VJbmZvPmQybHVNVEE9PC9kZXZpY2VJbmZvPjx1aGk+ZzM2Ly9ZSzUxN3Jpcnp3SzZEMU9iaHQ4YWY4dTwvdWhpPjxmc2liPjE8L2ZzaWI+PHV0Yj5jcjI8L3V0Yj48cmVxdWlyZW1lbnQ+PGNvbmRpdGlvbj48dHlwZT5DZXJ0aWZpY2F0ZVBvbGljaWVzPC90eXBlPjx2YWx1ZT4xLjIuNzUyLjc4LjEuMjwvdmFsdWU+PC9jb25kaXRpb24+PC9yZXF1aXJlbWVudD48L2FpPjwvZW52PjwvY2xpZW50SW5mbz48L2JhbmtJZFNpZ25lZERhdGE+PC9PYmplY3Q+PC9TaWduYXR1cmU+';
$signature_xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?><Signature xmlns="http://www.w3.org/2000/09/xmldsig#"><SignedInfo xmlns="http://www.w3.org/2000/09/xmldsig#"><CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"></CanonicalizationMethod><SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1"></SignatureMethod><Reference Type="http://www.bankid.com/signature/v1.0.0/types" URI="#bidSignedData"><Transforms><Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"></Transform></Transforms><DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"></DigestMethod><DigestValue>rIpB3gE/o/bVr26fotuWBltzjXB6nG0JVcoE3P5fpwg=</DigestValue></Reference><Reference URI="#bidKeyInfo"><Transforms><Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"></Transform></Transforms><DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"></DigestMethod><DigestValue>kqbRRJvyjWwzp0y5D7bxb2Fy/q+itlG201V8g9v2djY=</DigestValue></Reference></SignedInfo><SignatureValue>MnZsmO++H+5UjHlu90OP1JPdb+TxR5qz71CCvsRM2qBgLtZ/cgoG5AFh1kNXxkwKshFw1o+AhxYW5H+d43gHXP9JV5tXDMBLJfsCjnYExZjD8nA7kqVZFRddj7ntJdULboBSTV7x1GTHltGIoOpv4Ta+ud/xkLZYoq0U27ETJaBAgLB97bj2LirXF/YdAaRNp0OwjENuD0dUdTzNAJOEi5TvFdO224MKNmyO8n1Ghwi2sP1PfjiOWLO4GznHH4gEQ4PlQAd6o3XJuJkXguN1yRfr368OGNXT7VJ2iRYUK2GWK6+7YYFascxHPzdFZ4jLrbMzWZlcsuFzr+CURylcqg==</SignatureValue><KeyInfo xmlns="http://www.w3.org/2000/09/xmldsig#" Id="bidKeyInfo"><X509Data><X509Certificate>MIIFgjCCA2qgAwIBAgIIaLCZSbizudIwDQYJKoZIhvcNAQELBQAwgZExCzAJBgNVBAYTAlNFMSgwJgYDVQQKDB9TdmVuc2thIEhhbmRlbHNiYW5rZW4gQUIgKHB1YmwpMRMwEQYDVQQFEwo1MDIwMDc3ODYyMUMwQQYDVQQDDDpTdmVuc2thIEhhbmRlbHNiYW5rZW4gQUIgKHB1YmwpIEN1c3RvbWVyIENBMiB2MSBmb3IgQmFua0lEMB4XDTE0MTAyMDAxMzExM1oXDTE5MTAxOTIxNTk1OVowgakxCzAJBgNVBAYTAlNFMSgwJgYDVQQKDB9TdmVuc2thIEhhbmRlbHNiYW5rZW4gQUIgKHB1YmwpMQ0wCwYDVQQEDAROZXZvMQ4wDAYDVQQqDAVHaWxhZDEVMBMGA1UEBRMMMTk1ODA3MDEyMDU4MSUwIwYDVQQpDBxHaWxhZCBOZXZvIC0gQmFua0lEIHDDpSBrb3J0MRMwEQYDVQQDDApHaWxhZCBOZXZvMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxpirZB6leRBnL0Y/MF7CIgjjExz4kw7tGfaeiS7Wcdn8AiY3XtCKqHO7s2w1ZiI9B37tzCSTwQKPUX1FTXthAkbmzurTxUhBBXFvuXliLUl/sMNhy2OCOuegAIILS7klxQMNKI9yZu+tsQbHsJI8qUTS3OOC2VESrmlbs+GXfpCngeJN8LwsPIE6rsI28zu9QUMx4rH2UAYbg9Cz+9YIkvoedxKx79Y9VId4qlucyGzGfJlbZNSBPqlYXiGScBY8blzKsTxxUADOHXqKk4uKGg7L1W+GtcMzPXnoJpZbW3oXE0PI0CQEMXQtgb58op4691y6VoXy3TXAf/CmopYSBQIDAQABo4HDMIHAMDsGCCsGAQUFBwEBBC8wLTArBggrBgEFBQcwAYYfaHR0cDovL29jc3AucmV2b2NhdGlvbnN0YXR1cy5zZTATBgNVHSAEDDAKMAgGBiqFcE4BAjAOBgNVHQ8BAf8EBAMCBkAwHAYGKoVwIgIBBBITEDk3NTI2MTE5NzQxNzIzNjgwHQYDVR0OBBYEFIlVIz5C/r23pTEafy4YQwxPqLXKMB8GA1UdIwQYMBaAFMt1gszYYKfmS6oJ1HWHrWB0izWqMA0GCSqGSIb3DQEBCwUAA4ICAQAsq4jnkthEKpecwEaRVV1wCI4YTBFf6NW5vEfA5DQqM6PbHb92jvxwcaa0GSNWbaYzaNX1gqEo3FcYUy+nw3vN/eTcPAEgUslvSH6dibC6fuJ1MBe93Gpnr8MpvKxDyaJLgc64zJu0iUvHGtU9slpyeUoYf7OsdzJOaim0u6vuinWeX+6GbHb8Ka5VVhyEDgetdPAdV8VpZCV8rvm2JIZVCJSJBy9hF+aQ9TiCJIrus6zIvq/fbbsiMaeVo5mFRR407xJr/+jLdJ+Rr3AKG/kUGbaY/Gczshg3flahPkuD4nXqQpnztjHpufUBJBJn8Put7eG6/lwZ9z5HgKDyjbJ/DCKdIXfFfBvczqteUpqBMezvhN7k5Eh4flx9s9rY++YvBlzuvKtLryTnyxiofHzt4/qeIIFFmjyMU6Foo5x8LwPAr/t9mSVLrLOBoh6Wx2RURrBhb2eNMixslf3A60Gna15wI8TgOeHL0pghmbU53PsoIxEX6JYB0IAXtpFSJnWDyNlY1ucwf6nGTlCp1eEFlb3ht3cwZXVjCwuXPMATIGW4yPDrmVwFyydOW3UBk+S9PyPu9Kjk+qSJfzNrGZjUVGipCvSUuT2gH5/oEjDWPa37+2aWcp/jaP5+TdzHt+BpPVv1oPXitvi5jLxL+yDn4o+sqTYjX7paHDJooLUJnQ==</X509Certificate><X509Certificate>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</X509Certificate><X509Certificate>MIIF5TCCA82gAwIBAgIIXU54/wYOci4wDQYJKoZIhvcNAQENBQAwYzEkMCIGA1UECgwbRmluYW5zaWVsbCBJRC1UZWtuaWsgQklEIEFCMR8wHQYDVQQLDBZCYW5rSUQgTWVtYmVyIEJhbmtzIENBMRowGAYDVQQDDBFCYW5rSUQgUm9vdCBDQSB2MTAeFw0xMjAzMTYxMjIwNTVaFw0zNDEyMzExMjIwNTVaMIGHMQswCQYDVQQGEwJTRTEoMCYGA1UECgwfU3ZlbnNrYSBIYW5kZWxzYmFua2VuIEFCIChwdWJsKTETMBEGA1UEBRMKNTAyMDA3Nzg2MjE5MDcGA1UEAwwwU3ZlbnNrYSBIYW5kZWxzYmFua2VuIEFCIChwdWJsKSBDQSB2MSBmb3IgQmFua0lEMIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAlM4PavO3Nm17HbFAheeR32lkGIMyCOl1+IsQc6/T9X3t5BpEqajEdBUMNmWlLOD1GIGDd0mVoWW2HgvENg2+j2a5FwyycASdBTMu3Xq7eglB070wIIeGJBBqNSGHHLv7DmAK7r9xKX0iICK03jZ5FQfe5lWKey9Vf7SpZQT4lyXuCVNpPy0xiB2ap/+6tthNwknWeydfe9qT5nLEKSL5mpZA6k6/9mU4La1OH+EYBt0rZOVffIsx+CBsEDYmt85N2MswiL+XkMzUh0HPl86XwDfQeBYUSNFevihx1tpZkA9h2E55xCO6A8Rbczc7uZAXMsqJuVoq9bIjn0Yml2dNeCGQ0Zy6qVez51Y+yXgGRj9l3ItD6UNn6lUMXPoukFHHQJovIg0ktRaQMd+/ggEpf5mEzPdvfUWf6wqVgXmItVOpA1PAx+LPvd/RAcQWbeBTIUy5nOPspgOYLfKGPaA7rrU33UyiBcSKX8+x+E5hpD8iJus8bovxjseQEFkBgAZWvWLfHuBdIOhMqJD/TWD+PnRQ5syxFbE206Gh4pIMLKXRtEgl/aZAW3CT3Q0jP3C3DcHQH+hn57FbnblZ4u/s1ZULQtLnDNy9pZY0I/ODd25Db8+hS5FX/tH063YQXMql44F5sPu4JXDWpqzEL0w79UsIjVZlZ4Jnjv7Tzvddnz0CAwEAAaN4MHYwHQYDVR0OBBYEFIiMVkkEzRIDmp1LVpOEIuewAZ2NMA8GA1UdEwEB/wQFMAMBAf8wHwYDVR0jBBgwFoAUZ4q6supIHHr1O2g3J3IG65Fjy1MwEwYDVR0gBAwwCjAIBgYqhXBOAQEwDgYDVR0PAQH/BAQDAgEGMA0GCSqGSIb3DQEBDQUAA4ICAQB6q7Y0y/2fkwkzSiF4VO0YJCKARVDWQN9dBJY8RQVH1W57zgcQl0W4yvJwY4uVFPVNRcVUXl/xj6vX7wr32HPUKfHGK+PGJ69v1Q+Xto/y3Gs5V1HBj+u/4umN9/lgqpp3JroC+i47Z5TKhj4ffN/4/iNKvvITqkdBWeqUFEdMtpekYOSCm1mMHLNPjlCwUG+9x3zOqKKVGaELQE6ZmnauDkkUpa/QnW1k2pIK6B+tsYTmjfhqHKew9ggvy66fJuHkIlF4J5OIaaCVwTHO53lP3m7wWIuOrjNLqKiFdPVAERI+stCojRN4KE00oMaI8WwRuCCewbI+BXptRXYPo5yCABRjWXrscHdVcViUdyUyXzcVQwjgd6xdN15qTI9V2XHoiNH80enY2E5f/ql7ln58Gl3ASOoaI9kdniEzojKhodJhQjDQXFtGjXODbIPiLc4eynb75cXKKoS3jzcVmHJv6LIjeIwGWJ1vHk6agOIS940NSLhB9oruFW/V7oiZNUBIHeKxF74S9aYeEvF7tiCe2IL7HSXBblnrW3t+XhlDgajvMZAQFjjhqF21BkwwaPrX9yVc/4KM8PzKW/zQfPeDE+rEZ1mWWWiJNAf6i1nC9M8XbB7GaTQ3ILMKKi3t5Q9+sG5U4pC7Vu2ZOK2tsmRRHkSH9rtt44vzxJwNsdBrVw==</X509Certificate></X509Data></KeyInfo><Object><bankIdSignedData xmlns="http://www.bankid.com/signature/v1.0.0/types" Id="bidSignedData"><usrVisibleData charset="UTF-8" visible="wysiwys">SW5mb3JtYXRpb24gZsO2ciBzaWduZXJpbmcgZnLDpW4gQ2lycnVzIHRpZHNyYXBwb3J0ZXRpbmcsIGfDpGxsYWRlIHRvdC4gYXJiZXRzdGlkIE3DpW5hZC/DpXIgIGFwcmlsIDIwMTYKVG90YWwgdGltbWFyIGFyYmV0c3RpZDogIDI4LjAwClRvdGFsIHRpbW1hciBmcsOlbnZhcm86ICAwCg==</usrVisibleData><srvInfo><name>Y249RWdyZWVtZW50IEFCLG5hbWU9RS1hdnRhbCxzZXJpYWxOdW1iZXI9NTU2NzAwNDM5NCxvPURhbnNrZSBCYW5rIEFTIERhbm1hcmsgU3ZlcmlnZSBGaWxpYWwsYz1TRQ==</name><nonce>YjZM7mGc88ZH9VNQoVISsCkBx/M=</nonce><displayName>RS1hdnRhbA==</displayName></srvInfo><clientInfo><funcId>Signing</funcId><version>UGVyc29uYWw9Ny4yLjEuMSZCYW5rSURfZXhlPTcuMi4xLjEmQklTUD03LjIuMS4xJnBsYXRmb3JtPXdpbjY0Jm9zX3ZlcnNpb249d2luMTAmdWhpPWczNi8vWUs1MTdyaXJ6d0s2RDFPYmh0OGFmOHUmbGVnYWN5dWhpPWdpVnlHNlZHanA3QXpCS0ExWGNnRjlzdFMrMC8mYmVzdF9iZWZvcmU9MTQ3MTQzMTc1NSZTbWFydENhcmRfUmVhZGVyPUhhbmRlbHNiYW5rZW4gY2FyZCByZWFkZXIgMCY=</version><env><ai><type>V0lORE9XUw==</type><deviceInfo>d2luMTA=</deviceInfo><uhi>g36//YK517rirzwK6D1Obht8af8u</uhi><fsib>1</fsib><utb>cr2</utb><requirement><condition><type>CertificatePolicies</type><value>1.2.752.78.1.2</value></condition></requirement></ai></env></clientInfo></bankIdSignedData></Object></Signature>';
$ocspResponse = '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';
$ocspResponse_xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?><Signature xmlns="http://www.w3.org/2000/09/xmldsig#"><SignedInfo xmlns="http://www.w3.org/2000/09/xmldsig#"><CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"></CanonicalizationMethod><SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"></SignatureMethod><Reference Type="http://www.bankid.com/signature/v1.0.0/types" URI="#bidSignedData"><Transforms><Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"></Transform></Transforms><DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"></DigestMethod><DigestValue>FvLlDYxvJyfeJSgZkJGSglk/wkaCOQ+Bgrb2G+Ae/4w=</DigestValue></Reference><Reference URI="#bidKeyInfo"><Transforms><Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"></Transform></Transforms><DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"></DigestMethod><DigestValue>fwTUOp9rvf/UzHOvic2kWjX6vogwi4eqcJ2qRbZQJng=</DigestValue></Reference></SignedInfo><SignatureValue>k45Z4LYEW2WMES2EHe6yOVT1uzhOAOBCUzDdqcnL1aDksNQaDuVvUqc9buv6eqpT77dTgu43btf0KAyetEombdYGhFOLZaj/0LH+loPFPFav1WMdoIXlib9AWrjy3/pWhIpUb+S2cAYV+//nWFdbtl6KKTNoNV1soSQzaaLNZcWvomULJQi4HXIvqByT6r6s/RZKEScxMlGm1h5CteL45caB3WVmYEQGnItC6v2v+51cT4KAHj3XA52Rj/VHPTWKBJ1Ke5YBhfohvhd2Jnz6FBc2+o9eZzjDuF8/txMfUJpMEIXyfZgILfje50n4qCPKKs9wq7xF2H+3vFZYg/2Klw==</SignatureValue><KeyInfo xmlns="http://www.w3.org/2000/09/xmldsig#" Id="bidKeyInfo"><X509Data><X509Certificate>MIIFTjCCAzagAwIBAgIIdThHFQJNP1UwDQYJKoZIhvcNAQELBQAweDELMAkGA1UEBhMCU0UxHTAbBgNVBAoMFFRlc3RiYW5rIEEgQUIgKHB1YmwpMRUwEwYDVQQFEwwxMTExMTExMTExMTExMzAxBgNVBAMMKlRlc3RiYW5rIEEgQ3VzdG9tZXIgQ0ExIHYxIGZvciBCYW5rSUQgVGVzdDAeFw0xNTEwMDQyMjAwMDBaFw0xNzEwMDQyMTU5NTlaMIGsMQswCQYDVQQGEwJTRTEdMBsGA1UECgwUVGVzdGJhbmsgQSBBQiAocHVibCkxDTALBgNVBAQMBE5ldm8xDjAMBgNVBCoMBUdpbGFkMRUwEwYDVQQFEwwxOTU4MDcwMTIwNTgxMzAxBgNVBCkMKigxNTEwMDUgMTAuMjMpIEdpbGFkIE5ldm8gLSBCYW5rSUQgcMOlIGZpbDETMBEGA1UEAwwKR2lsYWQgTmV2bzCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAOLw78vgcPHCVfAC9pNObhYEdLja7ZlMAMNNoOUw2ptQFeWgAUrKK9DocHi9NA23FRIYOM1gHxz5L2zudZIfHAThGP6niX8UcP6MrZRsuPe+VUmnIT9Q2a61ZFqdIMtbkjvBTtExNyNE8fGE16haR8tiMrcutDwCGOm4ZdKOYFzVm5ke0CdRgJ0kimmE0wOizXNNrHHTdmRmoUZ3o0qaJPIy4Vf92oo/QSamjA/FCw0xmv1ruSx8Pb/xllfG4/HNQiySwvKG7BKrLFGcxnAhbfHkpmPDayC0MYHQY29nk78O7xzQXmfT256z0gS0tjP04RHbanSS5ku4lbNgFnF+8qUCAwEAAaOBpjCBozA+BggrBgEFBQcBAQQyMDAwLgYIKwYBBQUHMAGGImh0dHA6Ly9jcGFjdC50ZXN0LnBraXNlcnZpY2VzLmNvbS8wEQYDVR0gBAowCDAGBgQqAwQFMA4GA1UdDwEB/wQEAwIGQDAdBgNVHQ4EFgQUTfx8JtOjzQZo/HR40FRdK0g+gL4wHwYDVR0jBBgwFoAUYHp9p1mDjJ+ksRfqDUNDlUPmmf0wDQYJKoZIhvcNAQELBQADggIBAERjCecds/aUQRMJhzk+wTnYHNus5a6L/Eere1sg2fzMRMdmSxwUnK/3XS6vhzl0bKaHjB/rtIQ62yZXWkZrGgMUCC5svS9DbkWneQY4xXG+FDn3bqAWULfbZ68PH7gM8nIXiLb39MyT2JxHXB/+edw6xhkwDVQDddTw+A37yILImtmSqAnV3MaaX3xaM+7DERP2Oh7LqYpGwTdDoAVSAgtWBHHd+GRgxglvcEh3h7hjKDYXW2P37CZ3Y9n5WveuxJv4zXeTxsYkVDSgvJQ/stCucq9IItJUJPFzeEyLbw6NAw05tkigRkTheKuVDEG5I9SEEmUqcMUW7/hMXyJz9m7O62+070MDP1c8HNaRUdo9O7BjlaaWxE8CxU1SwWOrApQNWCLc5JjL5wL1UFCDpfZJzEX/YjbvIOggvlK4lFNyUlXYf/Rm05lqrI/ACvRB/ph+6AVL2uHmkw9LhBV3+y8QV5fHjr2611UIr6Xi5WDROks5eAD9t6FHGdh1mbYMDgLpNTzTzghVDPaAn9HIDA/PPAXybL3McLi3zo3R6rzvzfr+1cwGggKKZeqqNkn4Ww8NTiXd5Bwg/mi/q7nC/U7xEfVGK25fyoxNgfflm+uokJ3wrRj5tDqHh0ax9NWpAt3g/cr2CbO8M+NROPh4ce7ODuQuAw28czvG/zf4ojvv</X509Certificate><X509Certificate>MIIF3jCCA8agAwIBAgIIFnZVyehmXYwwDQYJKoZIhvcNAQENBQAwbjELMAkGA1UEBhMCU0UxHTAbBgNVBAoMFFRlc3RiYW5rIEEgQUIgKHB1YmwpMRUwEwYDVQQFEwwxMTExMTExMTExMTExKTAnBgNVBAMMIFRlc3RiYW5rIEEgQ0EgdjEgZm9yIEJhbmtJRCBUZXN0MB4XDTExMDkyMjE0MjExNFoXDTM0MTIwMTE0MjExNFoweDELMAkGA1UEBhMCU0UxHTAbBgNVBAoMFFRlc3RiYW5rIEEgQUIgKHB1YmwpMRUwEwYDVQQFEwwxMTExMTExMTExMTExMzAxBgNVBAMMKlRlc3RiYW5rIEEgQ3VzdG9tZXIgQ0ExIHYxIGZvciBCYW5rSUQgVGVzdDCCAiIwDQYJKoZIhvcNAQEBBQADggIPADCCAgoCggIBAIW0DPopLEhtawVRwNrE431GVsh/HnWVsXdgOjzUsD7QD30/tfOHROQi9nLuDWkY1fEUxZ06Yq5LtROoFpkTQ6SRi2RgiUkuCNqMEwsj2eia7KhYRIk/XJkkFp1BvE62I63vtUzZzS69HAsMNPlfdLU2pIZ2And2QJ2dC0ximmFjY5k5/z7/Nk3JGBbaxLH/X6zhcNqOpr2Srv9G+lk+Gvy7hQLImNLRV+4G3malHj6QM+wDcRKvT4V+iRdvzP9o803/g+GL5qiufW6RdT+2lwGifP2d3suL79uGW1HO8qbii/i4HTxDftKdXFslFrXfR++QUU4B+v6Qyb4rF3qhDfeakgfL8uzftMtTMRlowxIb08jxCehCSaY0CMBHQTS0LtX1C/VjM6UbbpSa280zSL+xXlS7S727sJB722fzWR3/NSp3MZTbE0QAqMTENY4pfwc/lXwVn8TvANw1FIxE7ikwIBMFSo6eX2UDDz9ai6dzRrYftI44EtLTv3KV5UDWcIbsRBvlgBQqquphcuRVv1a6Xo9xeH2+o+Bsr+soumiC6zIFuUuBxB4uqsSqeVQFkIaepinwhX5CJBZLcORaMZF6I1kGvEDZOVYXOEt9PWg/SsScGM+sf2510Gz0f2omQjOL5BezdYYKNAwziz9U1Ir1VpvzkJF4SA3W05cmjjKZAgMBAAGjdjB0MB0GA1UdDgQWBBRgen2nWYOMn6SxF+oNQ0OVQ+aZ/TAPBgNVHRMBAf8EBTADAQH/MB8GA1UdIwQYMBaAFKPyeHkdK0WKyeHKlQnlnm/Oy07FMBEGA1UdIAQKMAgwBgYEKgMEBTAOBgNVHQ8BAf8EBAMCAQYwDQYJKoZIhvcNAQENBQADggIBADxhyzWSzokyG+hUCp3Ug7QZxbMLK+6IYp+8acRuTSFfr5maH3Mryd87/B2y9K3fW+FXQLpdhVHovKJOAQyv/t3CA62ZGrzhAXGqCcR9Sn44ecKRJPE9ZJbzalo4wtKRUv04W2ZgFunYTN55TsNn3bGzcIiAddMq9TMKwIjl6p5i6oIjAmt9/75Qf7qQ/1x20EUdsv+8QPIp1vlB8vAzAto+8bZFCRsdMVLRRk96CoS53v4aDYYAMxmsTbgvLqVU5/CNfVEgVeSpFVSz6flbFMBZd5LOPgli/lRJ7FWewQvrZaKgfJgdmUUvCpi0eD+/KBnsEJLbhdnK/B+iTo4A6BwoR+9XhOQyNMTB/SDtSYczJ35vFhZfKJ5/0psqXSJH/25wA4pe/34ERzQ1mgladt6JOhnWf92Jw5jdw7BFptg7lmIkDyYDU+6RyEsArCibI+28yF5/fCZCuUdwDw9iHpoodf1h8t1gfPnnmkcwGTfPg/duUgkFwKY97SzfZgR02hd7xxo5pK79czimMF2GTFw9SWSnlZK71foY25FzSUHNmuGHhFzG98AFIt0VLwiTj8tJeSjTi41if237vDNvsept+8/tt80/f45KzPNfWUB06/FGr0wfoYgZp4Pi9RRTXzDafwj7qLduaepRrLcEUpXWCGruSUylxxChdBTwVzZn</X509Certificate><X509Certificate>MIIF0zCCA7ugAwIBAgIIUYmfdtqty80wDQYJKoZIhvcNAQENBQAwbTEkMCIGA1UECgwbRmluYW5zaWVsbCBJRC1UZWtuaWsgQklEIEFCMR8wHQYDVQQLDBZCYW5rSUQgTWVtYmVyIEJhbmtzIENBMSQwIgYDVQQDDBtUZXN0IEJhbmtJRCBSb290IENBIHYxIFRlc3QwHhcNMTEwOTIyMTQxNTAzWhcNMzQxMjMxMTQwMTMzWjBuMQswCQYDVQQGEwJTRTEdMBsGA1UECgwUVGVzdGJhbmsgQSBBQiAocHVibCkxFTATBgNVBAUTDDExMTExMTExMTExMTEpMCcGA1UEAwwgVGVzdGJhbmsgQSBDQSB2MSBmb3IgQmFua0lEIFRlc3QwggIiMA0GCSqGSIb3DQEBAQUAA4ICDwAwggIKAoICAQCTqU7uxk5QzbXS6ArXIGTWNeZXz65bzdgoxb79LvYh/p7kcK25mA2tzGpO3QS1eKJJu84G9UNzm4mMl6cngnXcjxETYiEqtijrA5mfz865/X6UgOpX7DkouQ8d5eDyhJ49UrDqlrgoVMx322kM0SZ4heVeX83e1ISFiyxqZBKxh25yKYEZA4EzIrDj2ti8CRrWPHCTWaIFpcd5TyMhpUTPn4DzwPhPGWMRNxgOAeP4BSDB7R6az4rox7TPkd2sWG1ODj/0IRPhJS1dQ1B7QiNHY58RjnNThEQKwdWWMPMKPthSd+GEjL9GDafYxOsIrKFYwlYNBW3C5mbe3T+3j+Axj6W2HbgmJXPGItLucxY1kPwT9L7u5nIxaROmh1uTwYqr9puGq6soJnggES3K4PIhM6kamvnCCPXoqWCCruSEPVgyEZEi0shy+81Qseb1gc9rYgVrEnLBOIyMqaTtExaFprYbv1f/AwWtjFUi2XiSdN8aMp+kqbi+1tKJUUPLC+Crdu9fFo/8lslSdew+SnPVFeVz5COKbt6GTE4xcJeRzW5wQ0w7b+rGLWhJvwRJsS5GXvqa3Lg8EyWiLJswuTFaEwPUDvZBvyFZEZertKgZbRYvezo9/grwyB+morVrLryu9chYEYwE550uzyKtzXUzygV8FpXe9DpmpOSfGMAURQIDAQABo3YwdDAdBgNVHQ4EFgQUo/J4eR0rRYrJ4cqVCeWeb87LTsUwDwYDVR0TAQH/BAUwAwEB/zAfBgNVHSMEGDAWgBRK96NqCNoIOBcZUyjI2qbWNNhaujARBgNVHSAECjAIMAYGBCoDBAUwDgYDVR0PAQH/BAQDAgEGMA0GCSqGSIb3DQEBDQUAA4ICAQDP1DoxjEjeyG27xeai+mpxxJoqB1RDVTEY86RdNyluUKQOIbfKJMmX+DX4vTuUQS3539xzHKwpj6gk+iZVjF1UoJtGp+qurjjarOh44s++s0yWKiKrJBEloJn8o+YXFT8C7e1WtqJVoaFdDBCvohJyK20PKS7/nUG5b7J6iq3517Yvjb4D94Lt0dHNSgD2BIIHmNkpSYWgyi1seavhN5AjtfJr4p101u2SsNcLAr42A5fran9vL29HjaM2MTU8L0OxoIX8lgcpUy9wci7lHQKOiwaOcIKfCC1qM7lO5z0c4P+o0zT6183xJV3rmw22GGYd40EBqW97oqBK0Ij+Kl5suycZ4J2qK1aVciYBZsBNlbtmz/k8HuBxy9WbEePsY/61I50fBLSAkVk/Tea4j+NNHJ1imp7Bo18aLo8plb9e2iZeIDzH1u66o0RFYbHdnJD8CnPeBLVgSvEqmBS11fgHr81/tk5lJxcKejdsEftzGQxwuHw/pjkjobIkxrroXpa6iXokVyH4be16+f/dDaEkh9Rf8Lh1UEQPxxpCyISMifH5pL78DKhGnh8Vfi7EesUV1k6Y3eVCFw2CCKWcvXsJb9QqLFsDqIlWPh6bBgM4aXfpe0arDrgYRbbx8L6ouhyxAHwjtz9i0lXezWMX5f7QYREMTC5yBPNTTP2fCNsozQ==</X509Certificate></X509Data></KeyInfo><Object><bankIdSignedData xmlns="http://www.bankid.com/signature/v1.0.0/types" Id="bidSignedData"><usrVisibleData charset="UTF-8" visible="wysiwys">VGltZSBkZXRhaWxzIDIwMTUgYXVndXN0ClRvdGFsIFdvcmtpbmcxMi4wMApUb3RhbCBMZWF2ZTAK</usrVisibleData><srvInfo><name>Y249RlAgVGVzdGNlcnQgMSxuYW1lPVRlc3QgYXYgTW9iaWx0IEJhbmtJRCxzZXJpYWxOdW1iZXI9MTIzNDU2Nzgsbz1UZXN0YmFuayBBIEFCIChwdWJsKSxjPVNF</name><nonce>WI2zpoRwtotHrAUnmsdKI8E7x0M=</nonce><displayName>VGVzdCBhdiBNb2JpbHQgQmFua0lE</displayName></srvInfo><clientInfo><funcId>Signing</funcId><version>UGVyc29uYWw9Ny4wLjEuOCZCYW5rSURfZXhlPTcuMC4xLjgmQklTUD03LjAuMS44JnBsYXRmb3JtPXdpbjY0Jm9zX3ZlcnNpb249d2luNyZ1aGk9ZzB0eGNLUFo5d250MXBHUllpb1dJUDltNWgyUyZsZWdhY3l1aGk9Z2pBNnBCWHFsVG5GMVAxUFBDbXh0RE9UZFdMayZiZXN0X2JlZm9yZT0xNDQ2NjI0NzM3Jg==</version><env><ai><type>V0lORE9XUw==</type><deviceInfo>d2luNw==</deviceInfo><uhi>g0txcKPZ9wnt1pGRYioWIP9m5h2S</uhi><fsib>1</fsib><utb>cs1</utb><requirement><condition><type>CertificatePolicies</type><value>1.2.3.4.5</value></condition></requirement></ai></env></clientInfo></bankIdSignedData></Object></Signature>';
try {
    
    $assi_signature_obj = new stdClass();
    $assi_signature_obj->signature = $signature;
    $assi_signature_obj->ocspResponse = $ocspResponse;
    
    $employer_signature_obj = new stdClass();
    $employer_signature_obj->signature = $signature;
    $employer_signature_obj->ocspResponse = $ocspResponse;
    
    
    $SoapCallParameters = new stdClass();
    $SoapCallParameters->tidredovisning = base64_encode($xml);
    $SoapCallParameters->{'assistent-signatur'} = $assi_signature_obj;
    $SoapCallParameters->{'anordnare-signatur'} = $employer_signature_obj;
    
//    $return = $client->SkickaTidredovisning($SoapCallParameters);
//    $return = $client->__soapCall("SkickaTidredovisning",array('parameters' => $SoapCallParameters));
    $return = $client->__call("SkickaTidredovisning",array('parameters' => $SoapCallParameters));
    
   echo $client->__getLastRequest();
   echo("<br/>Returning value of __soapCall() call: ");
   echo "<pre>".print_r($return, 1)."</pre>";

}
 catch (SoapFault $exception) {
     
    echo $exception->getMessage();
    echo "<br/>Exception2 :<pre>".print_r($exception, 1)."</pre>";
     
    echo("<br/>Dumping request headers:<br/>");
    echo '<pre>'.print_r($client->__getLastRequestHeaders(), 1).'</pre>';

    echo("<br/>Dumping request:<br/>");
    echo '<code>' . nl2br(htmlspecialchars($client->__getLastRequest(), true)) . '</code>' . "<br/>\n";
//    echo '<code>' . highlight_string($client->__getLastRequest(), true) . '</code>' . "<br/>\n";

    /*echo("<br/>Dumping response headers:<br/>");
    echo '<pre>'.print_r($client->__getLastResponseHeaders(), 1).'</pre>';

    echo("<br/>Dumping response:<br/>");
    echo '<code>' . nl2br(htmlspecialchars($client->__getLastResponse(), true)) . '</code>' . "<br/>\n";     */
   
 }
   /*echo("<br/>Dumping request headers:<br/>");
   echo '<pre>'.print_r($client->__getLastRequestHeaders(), 1).'</pre>';

   echo("<br/>Dumping request:<br/>");
   echo '<pre>'.print_r(htmlspecialchars($client->__getLastRequest(), ENT_NOQUOTES), 1).'</pre>';

   echo("<br/>Dumping response headers:<br/>");
   echo '<pre>'.print_r($client->__getLastResponseHeaders(), 1).'</pre>';

   echo("<br/>Dumping response:<br/>");
   echo '<pre>'.print_r(htmlspecialchars($client->__getLastResponse(), ENT_NOQUOTES), 1).'</pre>';*/
?>