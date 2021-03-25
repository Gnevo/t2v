<?php

/**
 * @author: Shamsudheen <shamsu@arioninfotech.com>
 * @for: defining all basic user defined functions 
*/

class general {
    
    function utf8_string_array_encode(&$array){
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: ut8_encode all array values
         */
        $func = function(&$value,&$key){
            if(is_string($value)){
                $value = utf8_encode($value);
            } 
            if(is_string($key)){
                $key = utf8_encode($key);
            }
            if(is_array($value)){
                utf8_string_array_encode($value);
            }
        };
        array_walk($array,$func);
        return $array;
    }
    
    function utf8_string_array_decode(&$array){
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: ut8_decode all array values
         */
        $func = function(&$value,&$key){
            if(is_string($value)){
                $value = utf8_decode($value);
            } 
            if(is_string($key)){
                $key = utf8_decode($key);
            }
            if(is_array($value)){
                utf8_string_array_decode($value);
            }
        };
        array_walk($array,$func);
        return $array;
    }
    
    function get_months_between_dates($startDate, $endDate, $return_date_format){
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: to getting all months between 2 dates
         * @param: $return_date_format - indicates return format of results (Y|m, Y-m-01, Y-m-t)
         */
        
        $startDate = strtotime(date('Y-m-01',strtotime($startDate)));
        $endDate   = strtotime(date('Y-m-t',strtotime($endDate)));
        $currentDate = $endDate;
        $return_dates = array();
        while ($currentDate >= $startDate) {
            $return_dates[] = date($return_date_format,$currentDate);
            $currentDate = strtotime( date('Y-m-01',$currentDate).' -1 month');
        }
        return $return_dates;
    }

    function traverse_all_elements_set_null_to_empty($data) {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (is_object($value)) {
                    if (is_object($data))
                        $data->$key = $this->traverse_all_elements_set_null_to_empty($value);
                    else
                        $data[$key] = $this->traverse_all_elements_set_null_to_empty($value);
                }
                else if (is_array($value)) {
                    if (is_object($data))
                        $data->$key = $this->traverse_all_elements_set_null_to_empty($value);
                    else
                        $data[$key] = $this->traverse_all_elements_set_null_to_empty($value);
                }
                else {
                    if (is_null($value)) {
                        if (is_object($data))
                            $data->$key = '';
                        else
                            $data[$key] = '';
                    }
                }
            }
        }
        return $data;
    }
    
    function random_color_part() {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    function random_color() {
        return '#'. $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
    
    function diffInMonths($date1, $date2) {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: no of months between dates
         * @param: $date1, $date2 - should be DateTime object
         */
        /*$diff = $date1->diff($date2);
        $months = $diff->y * 12 + $diff->m + $diff->d / 30;
        return (int) round($months);*/
        
        // Count months from year and month diff
        $diff = $date2->diff($date1)->format('%y') * 12 + $date2->diff($date1)->format('%m');
        // If there is some day leftover, count it as the full month
        if ($date2->diff($date1)->format('%d') > 0) $diff++;
        // The month count isn't still right in some cases. This covers it.
        if ($date1->format('d') >= $date2->format('d')) $diff++;
        return (int) round($diff);
    }
    
    function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
        /*
          $interval can be:
          yyyy - Number of full years
          q - Number of full quarters
          m - Number of full months
          y - Difference between day numbers
          (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
          d - Number of full days
          w - Number of full weekdays
          ww - Number of full weeks
          h - Number of full hours
          n - Number of full minutes
          s - Number of full seconds (default)
         */

        if (!$using_timestamps) {
            $datefrom = strtotime($datefrom, 0);
            $dateto = strtotime($dateto, 0);
        }
        $difference = $dateto - $datefrom; // Difference in seconds

        switch ($interval) {

            case 'yyyy': // Number of full years

                $years_difference = floor($difference / 31536000);
                if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom) + $years_difference) > $dateto) {
                    $years_difference--;
                }
                if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto) - ($years_difference + 1)) > $datefrom) {
                    $years_difference++;
                }
                $datediff = $years_difference;
                break;

            case "q": // Number of full quarters

                $quarters_difference = floor($difference / 8035200);
                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($quarters_difference * 3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }
                $quarters_difference--;
                $datediff = $quarters_difference;
                break;

            case "m": // Number of full months

                $months_difference = floor($difference / 2678400);
                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }
                $months_difference--;
                $datediff = $months_difference;
                break;

            case 'y': // Difference between day numbers

                $datediff = date("z", $dateto) - date("z", $datefrom);
                break;

            case "d": // Number of full days

                $datediff = floor($difference / 86400);
                break;

            case "w": // Number of full weekdays

                $days_difference = floor($difference / 86400);
                $weeks_difference = floor($days_difference / 7); // Complete weeks
                $first_day = date("w", $datefrom);
                $days_remainder = floor($days_difference % 7);
                $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
                if ($odd_days > 7) { // Sunday
                    $days_remainder--;
                }
                if ($odd_days > 6) { // Saturday
                    $days_remainder--;
                }
                $datediff = ($weeks_difference * 5) + $days_remainder;
                break;

            case "ww": // Number of full weeks

                $datediff = floor($difference / 604800);
                break;

            case "h": // Number of full hours

                $datediff = floor($difference / 3600);
                break;

            case "n": // Number of full minutes

                $datediff = floor($difference / 60);
                break;

            default: // Number of full seconds (default)

                $datediff = $difference;
                break;
        }

        return $datediff;
    }
    
    function getIsoWeeksInYear($year) {
        $date = new DateTime;
        $date->setISODate($year, 53);
        return ($date->format("W") === "53" ? 53 : 52);
    }

    function base16_to_base64($base16) {
        return base64_encode(pack('H*', $base16));
    }

    function base64_to_base16($base64) {
        return implode('', unpack('H*', base64_decode($base64)));
    }
    
    function generate_custom_uuid($year, $month, $customer, $employee, $counter = 1) {

        /*
         * customer_alpha_part  => UUID[1] {1-6 digits}
         * customer_numeric_part=> UUID[2] {1-3 digits}
         * year                 => UUID[3]
         * month                => UUID[4]
         * employee_alpha_part  => UUID[5] {1-6 digits}
         * employee_numeric_part=> UUID[5] {7-9 digits}
         * counter              => UUID[5] {10-12 digits}
         */

        $cust_alpha_part = substr($customer, 0, 4);
        $cust_num_part = substr($customer, -3);
        $emp_alpha_part = substr($employee, 0, 4);
        $emp_num_part = substr($employee, -3);

        $encoded_cust_part = $this->base64_to_base16($cust_alpha_part);
        $encoded_emp_part = $this->base64_to_base16($emp_alpha_part);

        $uuid_array = array();
        $uuid_array[0] = $encoded_cust_part . '00';
        $uuid_array[1] = $cust_num_part . '0';
        $uuid_array[2] = sprintf('%04d', $year);
        $uuid_array[3] = sprintf('%04d', $month);
        $uuid_array[4] = $encoded_emp_part . $emp_num_part . sprintf('%03d', $counter);

        //    var_dump($uuid_array);
        return implode('-', $uuid_array);
    }

    function decode_generated_uuid($uuid) {
        $uuid_array = explode('-', $uuid);
        $year = (int) $uuid_array[2];
        $month = (int) $uuid_array[3];
        $counter = (int) substr($uuid_array[4], -3);

        $cust_num_part = substr($uuid_array[1], 0, 3);
        $cust_alpha_part = $this->base16_to_base64(substr($uuid_array[0], 0, 6));
        $customer = $cust_alpha_part . $cust_num_part;

        $emp_num_part = substr($uuid_array[4], 6, 3);
        $emp_alpha_part = $this->base16_to_base64(substr($uuid_array[4], 0, 6));
        $employee = $emp_alpha_part . $emp_num_part;

        return array(
            'year' => $year,
            'month' => $month,
            'customer' => $customer,
            'employee' => $employee,
            'counter' => $counter
        );
    }

    function format_mobile($phone){
        //example format: 070 122 22 02
        
        $phone = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($phone));
        $phone = substr($phone, 0, 1) == '0' ? substr($phone, 1) : $phone;  //truncate 0 from beginning
        if(strlen($phone) > 1){
            $length_mobile_display = ceil((strlen($phone) - 5) / 2);
            $temp_phone = '';
            $pos = 5;
            for ($i = 0; $i < $length_mobile_display; $i++) {
                $temp_phone .= " " . substr($phone, $pos, 2);
                $pos += 2;
            }
            $phone = "0" . substr($phone, 0, 2) . " " . substr($phone, 2, 3) . $temp_phone;
        }
        return $phone;
    }
    
    function format_phone($phone){
        //example format: +46704 43 49 56
        
        $phone = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($phone));
        $phone = substr($phone, 0, 3) == '+46' ? substr($phone, 3) : $phone; //truncate +46 from beginning
    
        if(strlen($phone) > 1){
            $length_mobile_display = ceil((strlen($phone) - 3) / 2);
            $temp_mobile = '';
            $pos = 3;
            for ($i = 0; $i < $length_mobile_display; $i++) {
                $temp_mobile .= " " . substr($phone, $pos, 2);
                $pos += 2;
            }
            $phone = "+46" . substr($phone, 0, 3) . $temp_mobile;
        }
        return $phone;
    }
    
    function format_ssn($SSN, $include_century = FALSE){
        $SSN = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($SSN));
        if (!$include_century)
            $SSN = substr($SSN,0,6) . "-".substr($SSN,6); //example format: 556872-7320
        else
            $SSN = substr($SSN,0,8) . "-".substr($SSN,8); //example format: 19556872-7320
        return $SSN;
    }
    
    function format_orgno($orgno){
        //It doesn't include century
        //example format: 556872-7320
        $orgno = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($orgno));
        $orgno = substr($orgno,0,6) . "-".substr($orgno,6);
        return $orgno;
    }

    function going_to_startup_view($smarty_obj){
        if($smarty_obj == NULL || !is_object($smarty_obj)) return FALSE;

        $startup_url = NULL;
        if(isset($_COOKIE['startup_summery_view']) && $_COOKIE['startup_summery_view'] == 'employee')
            $startup_url = $smarty_obj->url. 'all/employee/gdschema/l/';
        else
            $startup_url = $smarty_obj->url. 'all/gdschema/l/';

        // echo $startup_url;
        header("location:" . $startup_url);
        exit();
    }

    function get_boundary_date(){
        $boundary_year           = date('Y', strtotime('-3 year')); 
        $boundary_month          = 12;
        $boundary_day            = 31;
        return $boundary_year.'-'.$boundary_month.'-'.$boundary_day;
    }

    function grouping_array_by_attribute($input_array, $grouping_attr){
        if(!is_array($input_array) || empty($input_array) || $grouping_attr == '') return array();

        $result = array();
        foreach ($input_array as $key => $value) {
            if(isset($value[$grouping_attr])){
                $result[$value[$grouping_attr]][] = $value;
            }
        }
        return $result;
    }
}
?>