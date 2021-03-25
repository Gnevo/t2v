<?php
require_once('configs/config.inc.php');
require_once ('class/db.php');
require_once ('class/general.php');

/**
    * report_signing class
    * This class includes all functions related to employee report signings
    * 
    * @author Shamsudheen <shamsu@arioninfotech.com>
    * @version - 1.0
    * @package Cirrus
    * @since - 2013-10-11
*/
class report_signing extends db {
    
    var $rpt_employee = '';
    var $signing_employee = '';
    var $signing_TL_employee = '';
    var $signing_suTL_employee = '';
    var $signing_report_date = '';
    var $signing_employee_date = '';
    var $signing_TL_date = '';
    var $signing_suTL_date = '';
    
    /**
     * Contructor sets up db class integration
    */
    function __construct() {
        
        parent::__construct();
    }
    
    function get_unsigned_employees($this_year, $this_month, $employees = '', $customers = NULL) {
        /**
         * @author: Shamsu
         * @for: getting unsigned employees in a specified year and month
        */
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;

        $fromdate = date('Y-m-d', strtotime("$this_year-$this_month-01"));
        $todate = date('Y-m-t', strtotime("$this_year-$this_month-01"));

        $this->flush();
        if($fromdate <= $boundary_date && $todate > $boundary_date){
            $this->sql_query = 'SELECT t.customer, t.employee, 
                            c.first_name as customer_fname, c.last_name as customer_lname, 
                            e.first_name as employee_fname, e.last_name as employee_lname, e.mobile as employee_mobile, 
                            r.signin_employee, r.signin_tl, r.signin_sutl
                        FROM `timetable` as `t`
                        JOIN `customer` as `c` ON (t.customer = c.username)
                        JOIN `employee` as `e` ON (t.employee = e.username)
                        LEFT JOIN  `report_signing` as r ON (t.employee = r.employee AND t.customer = r.customer AND month(r.date) = month(t.date) AND year(r.date) = year(t.date)) 
                        WHERE 1 ';
                        if($employees != ''){
                            $this->sql_query .= ' AND t.employee IN('.$employees.') ';
                        }
                        if($customers !== NULL){
                            $this->sql_query .= ' AND t.customer IN('. $customers . ') ';
                        }
                        $this->sql_query .= ' AND t.employee != "" AND t.employee IS NOT NULL 
                            AND t.customer != "" AND t.customer IS NOT NULL 
                            AND month(t.date) = ? AND year(t.date) = ?
                            AND t.status!=4
                            AND (r.signin_employee = "" OR r.signin_tl = "" OR r.signin_sutl = "" OR r.signin_employee IS NULL OR r.signin_tl IS NULL OR r.signin_sutl IS NULL)
                        GROUP BY t.customer, t.employee
                        ORDER BY LOWER(employee_lname) collate utf8_bin, LOWER(employee_fname) collate utf8_bin, LOWER(customer_lname) collate utf8_bin, LOWER(customer_fname) collate utf8_bin';

            $this->condition_values = array($this_month, $this_year);
            $real_table_data = $this->sql_query;

            $this->sql_query = 'SELECT t.customer, t.employee, 
                            c.first_name as customer_fname, c.last_name as customer_lname, 
                            e.first_name as employee_fname, e.last_name as employee_lname, e.mobile as employee_mobile, 
                            r.signin_employee, r.signin_tl, r.signin_sutl
                        FROM `backup_timetable` as `t`
                        JOIN `customer` as `c` ON (t.customer = c.username)
                        JOIN `employee` as `e` ON (t.employee = e.username)
                        LEFT JOIN  `backup_report_signing` as r ON (t.employee = r.employee AND t.customer = r.customer AND month(r.date) = month(t.date) AND year(r.date) = year(t.date)) 
                        WHERE 1 ';
                        if($employees != ''){
                            $this->sql_query .= ' AND t.employee IN('.$employees.') ';
                        }
                        if($customers !== NULL){
                            $this->sql_query .= ' AND t.customer IN('. $customers . ') ';
                        }
                        $this->sql_query .= ' AND t.employee != "" AND t.employee IS NOT NULL 
                            AND t.customer != "" AND t.customer IS NOT NULL 
                            AND month(t.date) = ? AND year(t.date) = ?
                            AND t.status!=4
                            AND (r.signin_employee = "" OR r.signin_tl = "" OR r.signin_sutl = "" OR r.signin_employee IS NULL OR r.signin_tl IS NULL OR r.signin_sutl IS NULL)
                        GROUP BY t.customer, t.employee
                        ORDER BY LOWER(employee_lname) collate utf8_bin, LOWER(employee_fname) collate utf8_bin, LOWER(customer_lname) collate utf8_bin, LOWER(customer_fname) collate utf8_bin';

            $condition_values   = array($this_month, $this_year);
            $backup_table_data  = $this->sql_query;

            $this->condition_values = array_merge($this->condition_values, $condition_values);
            $this->sql_query        = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;

        }
        else if($fromdate <= $boundary_date && $todate <= $boundary_date){
            $table_time_table     = 'backup_timetable';
            $table_report_signing = 'backup_report_signing';
            $proceed              = TRUE;
        }
        else if($fromdate > $boundary_date && $todate > $boundary_date){
            $table_time_table     = 'timetable';
            $table_report_signing = 'report_signing';
            $proceed              = TRUE;
        }
        if($proceed == TRUE){
             $this->sql_query = 'SELECT t.customer, t.employee, 
                            c.first_name as customer_fname, c.last_name as customer_lname, 
                            e.first_name as employee_fname, e.last_name as employee_lname, e.mobile as employee_mobile, 
                            r.signin_employee, r.signin_tl, r.signin_sutl
                        FROM `'.$table_time_table.'` as `t`
                        JOIN `customer` as `c` ON (t.customer = c.username)
                        JOIN `employee` as `e` ON (t.employee = e.username)
                        LEFT JOIN  `'.$table_report_signing.'` as r ON (t.employee = r.employee AND t.customer = r.customer AND month(r.date) = month(t.date) AND year(r.date) = year(t.date)) 
                        WHERE 1 ';
                        if($employees != ''){
                            $this->sql_query .= ' AND t.employee IN('.$employees.') ';
                        }
                        if($customers !== NULL){
                            $this->sql_query .= ' AND t.customer IN('. $customers . ') ';
                        }
                        $this->sql_query .= ' AND t.employee != "" AND t.employee IS NOT NULL 
                            AND t.customer != "" AND t.customer IS NOT NULL 
                            AND month(t.date) = ? AND year(t.date) = ?
                            AND t.status!=4
                            AND (r.signin_employee = "" OR r.signin_tl = "" OR r.signin_sutl = "" OR r.signin_employee IS NULL OR r.signin_tl IS NULL OR r.signin_sutl IS NULL)
                        GROUP BY t.customer, t.employee
                        ORDER BY LOWER(employee_lname) collate utf8_bin, LOWER(employee_fname) collate utf8_bin, LOWER(customer_lname) collate utf8_bin, LOWER(customer_fname) collate utf8_bin';
            $this->condition_values = array($this_month, $this_year);
        }

       $unsigned_list = $this->query_fetch();
       return $unsigned_list;
    }
    
    function get_employees_having_schedule($month, $year, $employees, $customers = NULL){
        if($month != '' && $year != ''){
            $this->sql_query = 'SELECT distinct t.employee, t.customer, e.first_name, e.last_name,e.mobile FROM `timetable` t INNER JOIN employee e 
                            ON t.employee = e.username WHERE month(t.date) = ' . $month . ' AND year(t.date) = ' . $year . ' AND t.status IN(1,2) AND 
                            t.employee IN('. $employees . ') ';
            if($customers !== NULL){
                $this->sql_query .= ' AND t.customer IN('. $customers . ') ';
            }
            $datas = $this->query_fetch();
            return $datas;
        }else{
            return array();
        }
    }
    
    function get_signed_employees($this_year, $this_month, $signing_user_level = NULL, $allowed_customers = array(), $allowed_employees = array()) {
        /**
         * @author: Shamsu
         * @for: getting signed employees in a specified year and month
        */

        // echo $this_year, $this_month;
        // exit('dfds');

        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        $proceed       = false;
        $sdate         = $this_year.'-'.$this_month.'-'.'01';
        $edate         = date("Y-m-t", strtotime($sdate));

        // echo $sdate,$edate;exit('df');

        $this->flush();
        if($sdate <= $boundary_date && $edate > $boundary_date){
            $this->sql_query = 'SELECT r.customer, r.employee, 
                                c.first_name as customer_fname, c.last_name as customer_lname, 
                                e.first_name as employee_fname, e.last_name as employee_lname, 
                                r.signin_employee, r.signin_date, r.employee_sign, 
                                e_se.first_name as signing_employee_fname, e_se.last_name as signing_employee_lname,
                                r.signin_tl, r.signin_tl_date, r.tl_sign, 
                                e_stl.first_name as signing_tl_fname, e_stl.last_name as signing_tl_lname, 
                                r.signin_sutl, r.signin_sutl_date, r.sutl_sign, 
                                e_ssutl.first_name as signing_sutl_fname, e_ssutl.last_name as signing_sutl_lname
                            FROM `report_signing` as r
                            JOIN `customer` as `c` ON (r.customer = c.username)
                            JOIN `employee` as `e` ON (r.employee = e.username)
                            LEFT JOIN  `employee` as `e_se` ON (r.signin_employee = e_se.username)
                            LEFT JOIN  `employee` as `e_stl` ON (r.signin_tl = e_stl.username)
                            LEFT JOIN  `employee` as `e_ssutl` ON (r.signin_sutl = e_ssutl.username)
                            WHERE 1 ';
                            if($signing_user_level != NULL){
                                switch ($signing_user_level){
                                    case 1: $this->sql_query .= 'AND r.signin_employee != "" AND r.signin_employee IS NOT NULL '; break;
                                    case 2: $this->sql_query .= 'AND r.signin_tl != "" AND r.signin_tl IS NOT NULL '; break;
                                    case 3: $this->sql_query .= 'AND r.signin_sutl != "" AND r.signin_sutl IS NOT NULL '; break;
                                }
                            }
                            $this->sql_query .= ' AND month(r.date) = ? AND year(r.date) = ?
                                AND r.customer IN (\''. implode('\',\'', $allowed_customers) .'\')
                                AND r.employee IN (\''. implode('\',\'', $allowed_employees) .'\')
                            ORDER BY LOWER(employee_lname) collate utf8_bin, LOWER(employee_fname) collate utf8_bin, LOWER(customer_lname) collate utf8_bin, LOWER(customer_fname) collate utf8_bin';
           $this->condition_values = array($this_month, $this_year);
           $real_table_data = $this->sql_query;

           $this->sql_query = 'SELECT r.customer, r.employee, 
                                c.first_name as customer_fname, c.last_name as customer_lname, 
                                e.first_name as employee_fname, e.last_name as employee_lname, 
                                r.signin_employee, r.signin_date, r.employee_sign, 
                                e_se.first_name as signing_employee_fname, e_se.last_name as signing_employee_lname,
                                r.signin_tl, r.signin_tl_date, r.tl_sign, 
                                e_stl.first_name as signing_tl_fname, e_stl.last_name as signing_tl_lname, 
                                r.signin_sutl, r.signin_sutl_date, r.sutl_sign, 
                                e_ssutl.first_name as signing_sutl_fname, e_ssutl.last_name as signing_sutl_lname
                            FROM `backup_report_signing` as r
                            JOIN `customer` as `c` ON (r.customer = c.username)
                            JOIN `employee` as `e` ON (r.employee = e.username)
                            LEFT JOIN  `employee` as `e_se` ON (r.signin_employee = e_se.username)
                            LEFT JOIN  `employee` as `e_stl` ON (r.signin_tl = e_stl.username)
                            LEFT JOIN  `employee` as `e_ssutl` ON (r.signin_sutl = e_ssutl.username)
                            WHERE 1 ';
                            if($signing_user_level != NULL){
                                switch ($signing_user_level){
                                    case 1: $this->sql_query .= 'AND r.signin_employee != "" AND r.signin_employee IS NOT NULL '; break;
                                    case 2: $this->sql_query .= 'AND r.signin_tl != "" AND r.signin_tl IS NOT NULL '; break;
                                    case 3: $this->sql_query .= 'AND r.signin_sutl != "" AND r.signin_sutl IS NOT NULL '; break;
                                }
                            }
                            $this->sql_query .= ' AND month(r.date) = ? AND year(r.date) = ?
                                AND r.customer IN (\''. implode('\',\'', $allowed_customers) .'\')
                                AND r.employee IN (\''. implode('\',\'', $allowed_employees) .'\')
                            ORDER BY LOWER(employee_lname) collate utf8_bin, LOWER(employee_fname) collate utf8_bin, LOWER(customer_lname) collate utf8_bin, LOWER(customer_fname) collate utf8_bin';
           $condition_values  = array($this_month, $this_year);
           $backup_table_data = $this->sql_query;
           $this->condition_values = array_merge($this->condition_values, $condition_values);

           $this->sql_query = '( ' . $real_table_data . ' )' . ' UNION ' . '( ' . $backup_table_data . ' ) ' ;
        }
        else if($sdate <= $boundary_date && $edate <= $boundary_date){
            $table_name = 'backup_report_signing';
            $proceed    = true;
        }
        else if($sdate > $boundary_date && $edate > $boundary_date){
            $table_name = 'report_signing';
            $proceed    = true;
        }
        if($proceed == true){
            $this->sql_query = 'SELECT r.customer, r.employee, 
                                c.first_name as customer_fname, c.last_name as customer_lname, 
                                e.first_name as employee_fname, e.last_name as employee_lname, 
                                r.signin_employee, r.signin_date, r.employee_sign, 
                                e_se.first_name as signing_employee_fname, e_se.last_name as signing_employee_lname,
                                r.signin_tl, r.signin_tl_date, r.tl_sign, 
                                e_stl.first_name as signing_tl_fname, e_stl.last_name as signing_tl_lname, 
                                r.signin_sutl, r.signin_sutl_date, r.sutl_sign, 
                                e_ssutl.first_name as signing_sutl_fname, e_ssutl.last_name as signing_sutl_lname
                            FROM `'.$table_name.'` as r
                            JOIN `customer` as `c` ON (r.customer = c.username)
                            JOIN `employee` as `e` ON (r.employee = e.username)
                            LEFT JOIN  `employee` as `e_se` ON (r.signin_employee = e_se.username)
                            LEFT JOIN  `employee` as `e_stl` ON (r.signin_tl = e_stl.username)
                            LEFT JOIN  `employee` as `e_ssutl` ON (r.signin_sutl = e_ssutl.username)
                            WHERE 1 ';
                            if($signing_user_level != NULL){
                                switch ($signing_user_level){
                                    case 1: $this->sql_query .= 'AND r.signin_employee != "" AND r.signin_employee IS NOT NULL '; break;
                                    case 2: $this->sql_query .= 'AND r.signin_tl != "" AND r.signin_tl IS NOT NULL '; break;
                                    case 3: $this->sql_query .= 'AND r.signin_sutl != "" AND r.signin_sutl IS NOT NULL '; break;
                                }
                            }
                            $this->sql_query .= ' AND month(r.date) = ? AND year(r.date) = ?
                                AND r.customer IN (\''. implode('\',\'', $allowed_customers) .'\')
                                AND r.employee IN (\''. implode('\',\'', $allowed_employees) .'\')
                            ORDER BY LOWER(employee_lname) collate utf8_bin, LOWER(employee_fname) collate utf8_bin, LOWER(customer_lname) collate utf8_bin, LOWER(customer_fname) collate utf8_bin';
           $this->condition_values = array($this_month, $this_year);
        }
           

       $signed_list = $this->query_fetch();
       return $signed_list;
    }
    
    function get_signed_employees_with_employer_details($this_year, $this_month, $allowed_customers = array(), $allowed_employees = array()) {
        /**
         * @author: Shamsu
         * @for: getting signed employees in a specified year and month
        */
       $this->flush();
       $this->sql_query = 'SELECT r.customer, r.employee, 
                            c.first_name as customer_fname, c.last_name as customer_lname, 
                            e.first_name as employee_fname, e.last_name as employee_lname, 
                            r.signin_employee, r.signin_date, r.employee_sign, 
                            e_se.first_name as signing_employee_fname, e_se.last_name as signing_employee_lname,
                            r.signin_tl, r.signin_tl_date, r.tl_sign, 
                            e_stl.first_name as signing_tl_fname, e_stl.last_name as signing_tl_lname, 
                            r.signin_sutl, r.signin_sutl_date, r.sutl_sign, 
                            e_ssutl.first_name as signing_sutl_fname, e_ssutl.last_name as signing_sutl_lname,
                            sed_fk.employer as employer_fk, sed_fk.signing_date as employer_sign_date_fk, sed_fk.employer_sign as employer_sign_fk, e_sed_fk.first_name as employer_fk_fname, e_sed_fk.last_name as employer_fk_lname,
                            sed_kn.employer as employer_kn, sed_kn.signing_date as employer_sign_date_kn, sed_kn.employer_sign as employer_sign_kn, e_sed_kn.first_name as employer_kn_fname, e_sed_kn.last_name as employer_kn_lname,
                            sed_tu.employer as employer_tu, sed_tu.signing_date as employer_sign_date_tu, sed_tu.employer_sign as employer_sign_tu, e_sed_tu.first_name as employer_tu_fname, e_sed_tu.last_name as employer_tu_lname
                        FROM `report_signing` as r
                        JOIN `customer` as `c` ON (r.customer = c.username)
                        JOIN `employee` as `e` ON (r.employee = e.username)
                        LEFT JOIN  `employee` as `e_se` ON (r.signin_employee = e_se.username)
                        LEFT JOIN  `employee` as `e_stl` ON (r.signin_tl = e_stl.username)
                        LEFT JOIN  `employee` as `e_ssutl` ON (r.signin_sutl = e_ssutl.username)
                        LEFT JOIN  `signing_employer` as `se_fk` ON (se_fk.customer = r.customer and se_fk.year = YEAR(r.date) and se_fk.month = MONTH(r.date) and se_fk.fkkn = 1)
                        LEFT JOIN  `signing_employer_data` as `sed_fk` ON (sed_fk.master_id = se_fk.id and sed_fk.employee = r.employee)
                        LEFT JOIN  `employee` as `e_sed_fk` ON (sed_fk.employer = e_sed_fk.username)
                        LEFT JOIN  `signing_employer` as `se_kn` ON (se_kn.customer = r.customer and se_kn.year = YEAR(r.date) and se_kn.month = MONTH(r.date) and se_kn.fkkn = 2)
                        LEFT JOIN  `signing_employer_data` as `sed_kn` ON (sed_kn.master_id = se_kn.id and sed_kn.employee = r.employee)
                        LEFT JOIN  `employee` as `e_sed_kn` ON (sed_kn.employer = e_sed_kn.username)
                        LEFT JOIN  `signing_employer` as `se_tu` ON (se_tu.customer = r.customer and se_tu.year = YEAR(r.date) and se_tu.month = MONTH(r.date) and se_tu.fkkn = 3)
                        LEFT JOIN  `signing_employer_data` as `sed_tu` ON (sed_tu.master_id = se_tu.id and sed_tu.employee = r.employee)
                        LEFT JOIN  `employee` as `e_sed_tu` ON (sed_tu.employer = e_sed_tu.username)
                        WHERE 1 ';

                        $this->sql_query .= ' AND month(r.date) = ? AND year(r.date) = ?
                            AND r.customer IN (\''. implode('\',\'', $allowed_customers) .'\')
                            AND r.employee IN (\''. implode('\',\'', $allowed_employees) .'\')
                        ORDER BY LOWER(employee_lname) collate utf8_bin, LOWER(employee_fname) collate utf8_bin, LOWER(customer_lname) collate utf8_bin, LOWER(customer_fname) collate utf8_bin';
       $this->condition_values = array($this_month, $this_year);
       $signed_list = $this->query_fetch();
       return $signed_list;
    }

    function get_report_details($passed_year,$passed_month,$passed_employee, $passed_customer){
        $obj_gen       = new general();
        $boundary_date = $obj_gen->get_boundary_date();
        if($passed_year <= date('Y',strtotime($boundary_date)))
            $this->tables = array('backup_report_signing');
        else    
            $this->tables = array('report_signing');
        $this->fields = array('id','signin_employee','signin_tl','signin_sutl');
        $this->conditions = array('AND', 'date = ?', 'employee = ?', 'customer = ?');
        $this->condition_values = array($date, $passed_employee, $passed_customer);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0];
    }

    function employer_signing_detail($year,$month,$this_customer,$this_employee,$fkkn){
        $this->flush();
        $this->sql_query = "SELECT * FROM `signing_employer` se INNER JOIN signing_employer_data sed 
                                ON se.id = sed.master_id WHERE se.customer = '" . $this_customer . "' AND se.year = $year AND se.month =$month AND se.fkkn = $fkkn  AND sed.employee = '" . $this_employee . "'";

        return $datas = $this->query_fetch()[0];
    }

    function all_employee_signing_detail_under_customer($year,$month,$this_customer){
        $this->flush();
        $this->sql_query = "SELECT * FROM `signing_employer` se INNER JOIN signing_employer_data sed 
                                ON se.id = sed.master_id WHERE se.customer = '" . $this_customer . "' AND se.year = $year AND se.month =$month AND se.fkkn = 1 ";
        
        return $datas = $this->query_fetch();
    }

    function remove_employer_signing_by_admin($year, $month, $this_customer, $this_employee, $type){
        $employer_signing_detail = $this->employer_signing_detail($year, $month, $this_customer, $this_employee, $type);

        if(!empty($employer_signing_detail)){
            $this->flush();
            $this->tables = array('signing_employer_data');
            $this->conditions = array('AND', 'master_id = ?', 'employee = ?');
            $this->condition_values = array($employer_signing_detail['master_id'], $this_employee);
            return $this->query_delete();
        } else {
            return true;
        }
    }

    function remove_employee_signing_by_admin($year, $month, $this_customer, $this_employee, $level){
        
        $process_flag = TRUE;
        switch ($level) {
            case "TL": 
                $___date = date("Y-m-d", strtotime("$year-$month-01"));
                $this->flush();
                $this->tables = array('report_signing');
                $this->fields = array('signin_tl', 'signin_tl_date', 'tl_sign', 'tl_ocs');
                $this->field_values = array('', NULL, NULL, NULL);
                $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?');
                $this->condition_values = array($this_employee, $this_customer, $___date);
                $process_flag = $this->query_update();
                break;
            case "SUTL": 
                $___date = date("Y-m-d", strtotime("$year-$month-01"));
                $this->flush();
                $this->tables = array('report_signing');
                $this->fields = array('signin_sutl', 'signin_sutl_date', 'sutl_sign', 'sutl_ocs');
                $this->field_values = array('', NULL, NULL, NULL);
                $this->conditions = array('AND', 'employee = ?', 'customer = ?', 'date = ?');
                $this->condition_values = array($this_employee, $this_customer, $___date);
                $process_flag = $this->query_update();
                break;
        }

        return $process_flag;
    }

}
?>