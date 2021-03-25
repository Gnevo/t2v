<?php
/**
 * Search in tables
 * @author dona
 */
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once ('class/db.php');

class search extends db {

	function __construct() {

        parent::__construct();
    }

    function search_on_table($tables = array(), $search_text) {

    	$result = array();
    	if(is_array($tables)) {
	    	foreach($tables AS $table) {
				$search_sql = 'SELECT * FROM ' . $table . ' WHERE ';
				$fields_on_this_table =  $this->table_fields($table);
				for($i=0; $i < sizeof($fields_on_this_table); $i += 1) {
					if($i != 0) {
						$search_sql .= ' OR ';
					}
					$search_sql .= '`' . $fields_on_this_table[$i] . '` LIKE \'%' . $search_text . '%\' ';
				}
				$this->sql_query = $search_sql;
				$result[$table] = $this->query_fetch();
			}
		} else {
			$search_sql = 'SELECT * FROM ' . $table . ' WHERE ';
			$fields_on_this_table =  $this->table_fields($table);
			for($i=0; $i < sizeof($fields_on_this_table); $i += 1) {
				if($i != 0) {
					$search_sql .= ' OR ';
				}
				$search_sql .= '`' . $fields_on_this_table[$i] . '` LIKE \'%' . $search_text . '%\' ';
			}
			$this->sql_query = $search_sql;
			$result = $this->query_fetch();
		}
		return $result;
	}

	function search_on_customer_table($search_text) {
		$tables = array('');
	}

	function table_fields($table) {

		$this->sql_query = 'DESC ' . $table;
		$collum = $this->query_fetch();
		$data = array();
		for($i=0; $i < sizeof($collum); $i += 1) {
			array_push($data, $collum[$i][0]);
		}
		return $data;
	}
}
?>