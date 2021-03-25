<?php

require_once ('plugins/log.class.php');
require_once('configs/config.inc.php');

class db extends log{

    var $con = "";
    var $prefix = "";
    var $db_name = "";
    var $db_master = '';
    // Jim-2012-05-16: Removed values. See flush() in __construct().
    var $tables;
    var $fields;
    var $field_values;
    var $conditions;
    var $condition_values;
    var $group_by;
    var $order_by;
    var $sql_query;
    var $limit;
    //private static $m_pInstance; 
    
    function __construct() {
        // Jim-2012-05-16: This is just a comment.
        // A class helping itself to data that isn't passed to it is bad.
        // Consider implementing this as a singleton and instantiating it in class/setup.php.

         
        
        
        parent::__construct(); // Jim-2012-05-16: Call the parent constructor first, in case we want to use some inherited methods.

        global $db;
        $this->db_master = $db['database_master'];
        if (isset ($_SESSION['db_name'])) {

            $this->db_name = $_SESSION['db_name'];
        } else {

            $this->db_name = $db['database_master'];
        }
        $this->con = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $this->db_name, $db['username'], $db['password']);
        if ($db['prefix'] && $db['prefix'] != '') {
            $this->prefix = $db['prefix'];
        }

        $this->flush(); // Jim-2012-05-16: Initialize our variables.
    }

    
    /*public static function getInstance() 
    { 
        if (!self::$m_pInstance) 
        { 
            self::$m_pInstance = new db(); 
        } 

        return self::$m_pInstance; 
    } */
    
    
    function select_db($db_name) {
        global $db;
        $this->db_name = $db_name;
        $this->con = new PDO("mysql:host=$db[host];dbname=$this->db_name", $db['username'], $db['password']);		
    }

    function flush() {
        $this->sql_query = ""; // Jim-2012-05-16: Also empty out the old query string.
        $this->tables = array();
        $this->fields = array('*'); // Jim-2012-05-16: If no fields are defined, get them all.
        $this->field_values = array();
        $this->conditions = array();
        $this->condition_values = array();
        $this->group_by = array();
        $this->order_by = array();
        $this->limit = "";
    }

    function begin_transaction() {

        $this->con->beginTransaction();
    }

    function commit_transaction() {

        $this->con->commit();
    }

    function rollback_transaction() {

        $this->con->rollBack();
    }

    function get_id() {

        return $this->con->lastInsertId();
    }

    function query_fetch($mode = 0) {
        // Jim-2012-05-16: If there is no query, try to generate one.
			
		if($mode == 999)
		{
			echo $this->sql_query;			
		}
		
        if (empty($this->sql_query) && !$this->query_generate()) {
            return false;
        }
        $result = $this->con->prepare($this->sql_query);
        
        if ($mode == 0) {
            $i = 1;
            foreach ($this->condition_values as $value) {

                if (is_float($value) || is_int($value)) {
                    $result->bindValue($i, mb_strtolower(urldecode($value)), PDO::PARAM_INT);
                } else {
                    $result->bindValue($i, mb_strtolower(urldecode($value)), PDO::PARAM_STR);
                }
                $i++;
            }

            $result->execute();
        } else {
            $result->execute($this->condition_values);
        }
		
        $datas = array();
        if ($mode == 1) {

            while ($data = $result->fetch()) {

                $datas[$data[0]] = $data;
            }
        } else if ($mode == 2) {
            while ($data = $result->fetch()) {

               $datas[] = $data[0];
            }
        } else {

           // $datas = $result->fetchAll(PDO::FETCH_ASSOC); // Jim-2012-05-16: Added argument to fetch associative array in cases where numeric indexes are not used.
		 
            $datas = $result->fetchAll(PDO::FETCH_ASSOC);
			
			
        }
        $this->flush();

        return $datas;
    }

    function query_insert() {

        if ((sizeof($this->tables) && sizeof($this->fields) && sizeof($this->field_values))) {

            //geting table name
            $tmp_tables = '`' . implode('`, `', $this->tables) . '`';
            $tmp_tables = str_replace('.', '`.`', $tmp_tables);

            $log_data = 'INSERTING data into tables ' . $tmp_tables;

            //getting , separated fields
            $tmp_fields = implode(", ", $this->fields);
            $log_data .= 'fields ' . $tmp_fields;

            //getting , separated values
            $tmp_values = '?';
            if (count($this->fields) > 1) {

                for ($i = 1; $i < count($this->fields); $i++)
                    $tmp_values .= ', ?';
            }

            $values = array();
            $tmp_val_array = $this->field_values;
            $query = "INSERT INTO " . $tmp_tables . " ( " . $tmp_fields . " ) VALUES ";
            $tmp_data_values = '';
            if (is_array($tmp_val_array[0])) {

                for ($i = 0; $i < count($tmp_val_array); $i++) {
                    if ($i > 0) {

                        $query .= ", ";
                        $tmp_data_values .= ', ';
                    }
                    $query .= '( ' . $tmp_values . ' )';
                    $tmp_data_values .= '( ' . implode(', ', $tmp_val_array[$i]) . ' )';
                    $values = array_merge($values, $tmp_val_array[$i]);
                }
            } else {

                $values = $tmp_val_array;
                $tmp_data_values .= "( " . implode(', ', $tmp_val_array) . " )";
                $query .= "( " . $tmp_values . " )";
            }
            $log_data .= ' values ' . $tmp_data_values;
            $result = $this->con->prepare($query);
            echo $this->sql_query = $query;
            

            //$this->flush();

            if ($result->execute($values)) {
                if(!in_array('chat', $this->tables))
                    $this->log_write($log_data,  $this->get_company_folder_name());
                return TRUE;
            } else {

                return FALSE;
            }
        }
        else
            return false;
    }

    function query_update($mode = 0) {
        
        if (sizeof($this->tables) && sizeof($this->fields) && sizeof($this->field_values)) {

            //getting Table Name
            $tmp_tables = '`' . implode('`, `', $this->tables) . '`';
            $tmp_tables = str_replace('.', '`.`', $tmp_tables);

            $log_data = 'UPDATING data to tables ' . $tmp_tables;

            //getting Fields
            $tmp_fields = $this->fields;
            $log_data .= 'fields ' . $tmp_fields;

            //getting Values
            $tmp_data_values = implode(', ', $this->field_values);
            $log_data .= ' values ' . $tmp_data_values;
            $values = array_merge($this->field_values, $this->condition_values);

            $up_query = "";

            for ($i = 0; $i < sizeof($tmp_fields); $i++) {

                if ($i != 0) {

                    $up_query .= ", ";
                }
                if ($mode == 0)
                    $up_query .= $tmp_fields[$i] . " = ?";
                else
                    $up_query .= $tmp_fields[$i];
            }

            $query = "UPDATE " . $tmp_tables . " SET " . $up_query . " WHERE 1"; // Jim-2012-05-16: Removed "WHERE 1" condition.

            if (sizeof($this->conditions)) {
                //getting WHERE Conditions
                $tmp_conditions = $this->generate_condition($this->conditions);

                $log_tmp_conditions = str_replace('?', '%s', $tmp_conditions);
                $log_data .= ' on conditions ' . vsprintf($log_tmp_conditions, $this->condition_values); // Jim-2012-05-16: Removed temporary variable.

                $query .= " AND " . $tmp_conditions; // Jim-2012-05-16: Changed AND to WHERE in thread with changes to $query above.
            }
            $this->sql_query = $query;
			
            
            $this->flush();

            $result = $this->con->prepare($query);
            if ($result->execute($values)) {
                if(!in_array('chat', $this->tables))
                    $this->log_write($log_data,  $this->get_company_folder_name());
                return TRUE;
            } else {

                return FALSE;
            }
        }
        else
            return FALSE;
    }

    function query_delete() {

        if (sizeof($this->tables)) {

            //getting Table Name
            $tmp_tables = '`' . implode('`, `', $this->tables) . '`';
            $tmp_tables = str_replace('.', '`.`', $tmp_tables);

            $log_data = 'DELETE data from tables ' . $tmp_tables;

            $query = "DELETE FROM " . $tmp_tables . " WHERE 1"; // Jim-2012-05-16: Removed "WHERE 1" condition.

            if (sizeof($this->conditions)) {
                //getting WHERE Conditions
                $tmp_conditions = $this->generate_condition($this->conditions);

                $log_tmp_conditions = str_replace('?', '%s', $tmp_conditions);
                $log_data .= ' on conditions ' . vsprintf($log_tmp_conditions, $this->condition_values); // Jim-2012-05-16: Removed temporary variable.

                $query .= " AND " . $tmp_conditions; // Jim-2012-05-16: Changed AND to WHERE in thread with changes to $query above.
            }
            $values = $this->condition_values;

            $this->sql_query = $query;

            $this->flush();

            $result = $this->con->prepare($query);

            if ($result->execute($values)) {
                if(!in_array('chat', $this->tables))
                    $this->log_write($log_data,  $this->get_company_folder_name());
                return TRUE;
            } else {

                return FALSE;
            }
        }
        else
            return FALSE;
    }

    function query_procedure() {

        if (sizeof($this->tables)) {

            //getting Table Name
            $tmp_procedure = '`' . implode('`, `', $this->tables) . '`';
            $tmp_in_arg = implode(",", $this->field_values);
            $query = "CALL " . $tmp_procedure . "( " . $tmp_in_arg . " )";

            $this->sql_query = $query;

            $this->flush();

            $result = $this->con->prepare($query);

            return $result->execute($values);
        }
        else
            return FALSE;
    }

    function query_generate() {

        if (sizeof($this->tables) <= 4) { // Jim-2012-05-16: Removed check for negative array size. An array cannot have negative length!
            //getting , separated tables
            $tmp_tables = '`' . implode('`, `', $this->tables) . '`';

            $tmp_tables = str_replace('.', '`.`', $tmp_tables);

            if (sizeof($this->fields)) {

                //getting , separated fields
                $tmp_fields = implode(", ", $this->fields);

                $query = "SELECT " . $tmp_fields . " FROM " . $tmp_tables . " WHERE 1"; // Jim-2012-05-16: Removed "WHERE 1" condition.

                if (sizeof($this->conditions)) {
                    //getting WHERE Conditions
                    $query .= " AND " . $this->generate_condition($this->conditions); // Jim-2012-05-16: Changed AND to WHERE in thread with changes to $query above. Also removed temporary variable.
                }

                if (sizeof($this->group_by)) {

                    //getting , Separated Groupby
                    $tmp_group_by = implode(", ", $this->group_by);
                    $query .= " GROUP BY " . $tmp_group_by;
                }

                if (sizeof($this->order_by)) {

                    //getting , Separated Orderby
                    $tmp_order_by = implode(", ", $this->order_by);
                    $query .= " ORDER BY " . $tmp_order_by;
                }

                if ($this->limit) {
                    //getting Limits
                    $tmp_limit = $this->limit;
                    $query .= " LIMIT " . $tmp_limit;
                }
                //$query;
                $this->sql_query = $query;

                return TRUE;
            }
            else
                return FALSE;
        }
        else
            return FALSE;
    }
	function query_generate_leftjoin() {
		
		$query = $this->tables;
		
		$query = $query[0];		
		//print_r($this->tables);		
		$this->sql_query = $query;		
		return TRUE;				
		exit;

        if (sizeof($this->tables) <= 4) { // Jim-2012-05-16: Removed check for negative array size. An array cannot have negative length!
            //getting , separated tables
            $tmp_tables = '' . implode(' ', $this->tables) . '';

            //$tmp_tables = str_replace('.', '`.`', $tmp_tables);

            if (sizeof($this->fields)) {

                //getting , separated fields
                $tmp_fields = implode(", ", $this->fields);

                $query = "SELECT " . $tmp_fields . " FROM " . $tmp_tables . " WHERE 1"; // Jim-2012-05-16: Removed "WHERE 1" condition.

                if (sizeof($this->conditions)) {
                    //getting WHERE Conditions
                    $query .= " AND " . $this->generate_condition($this->conditions); // Jim-2012-05-16: Changed AND to WHERE in thread with changes to $query above. Also removed temporary variable.
                }

                if (sizeof($this->group_by)) {

                    //getting , Separated Groupby
              
                if (sizeof($this->order_by)) {

                    //getting , Separated Orderby
                    $tmp_order_by = implode(", ", $this->order_by);
                    $query .= " ORDER BY " . $tmp_order_by;
                }

                if ($this->limit) {
                    //getting Limits
                    $tmp_limit = $this->limit;
                    $query .= " LIMIT " . $tmp_limit;
                }      $tmp_group_by = implode(", ", $this->group_by);
                    $query .= " GROUP BY " . $tmp_group_by;
                }

                //$query;
                $this->sql_query = $query;

                return TRUE;
            }
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    function generate_condition($condition) {
        $query = ""; // Jim-2012-05-16: You cannot add to a non-existant variable. Create it first!

        if (sizeof($condition) == 1) {

            $query .= $condition[0];
        } else {

            $operator = $condition[0];

            switch ($operator) {

                case 'AND':

                    for ($i = 1; $i < sizeof($condition); $i++) {

                        if ($i != 1)
                            $query .= " AND ";

                        $item = $condition[$i];
                        if (is_array($item)) {

                            $query .= "(" . $this->generate_condition($item) . ")";
                        } else {

                            $query .= $item;
                        }
                    }
                    break;

                case 'OR':

                    for ($i = 1; $i < sizeof($condition); $i++) {

                        if ($i != 1)
                            $query .= " OR ";

                        $item = $condition[$i];
                        if (is_array($item)) {

                            $query .= "(" . $this->generate_condition($item) . ")";
                        } else {

                            $query .= $item;
                        }
                    }
                    break;

                case 'BETWEEN':

                    if (sizeof($condition) == 4) {

                        $query .= $condition[1] . " BETWEEN ";
                        $query .= $condition[2] . " AND " . $condition[3];
                    }
                    break;

                case 'IN':

                    $tmp_condition = $condition[2];
                    if (is_array($tmp_condition))
                        $tmp_condition = implode(",", $condition[2]);

                    $query .= $condition[1] . " IN ( " . $tmp_condition . " )";
                    break;

                case 'NOT IN':

                    $tmp_condition = $condition[2];
                    if (is_array($tmp_condition))
                        $tmp_condition = implode(",", $condition[2]);

                    $query .= $condition[1] . " NOT IN ( " . $tmp_condition . " )";
                    break;
            }
        }
        return $query;
    }
    
    function get_company_folder_name(){
        
        $this->tables = array($this->db_master . '.company');
        $this->fields = array('upload_dir');
        $this->conditions= array('id = ?');
        $this->condition_values = array($_SESSION['company_id']);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data[0]['upload_dir'];
   }
}

?>