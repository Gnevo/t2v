<?php
require_once('configs/config.inc.php');
require_once ('class/db.php');
class material extends db {
    var $name = "";
    var $unit = "";
    var $quantity = "";
    var $date = "";
    var $status = "";
    var $price = "";
    var $customer = "";
    var $employee = "";
    
    function get_name_material()
    {
        $this->tables = array('material');
        $this->fields = array('name');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
        print_r($data);
    }
    function get_items_present($value)
    {
        $this->tables = array('material');
        $this->fields = array('name','id');
        $this->conditions = array('name LIKE ?');
        $this->condition_values = array($value.'%');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    function get_orders()
    {
        $this->tables = array('material','material_order');
        $this->fields = array('material.name AS name','material_order.employee','material_order.customer','material_order.qty','material_order.date');
        $this->conditions = array('AND','material.id = material_order.material_id');
        $this->order_by = array('material_order.id');
         $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
    function add_order($employee,$item,$qty)
    {
        echo $employee."  ",$item."  ".$qty;
        $this->tables = array('material_order');
        $this->fields = array('employee','customer','material_id','qty','date','status');
        $this->field_values = array($this->employee,$this->customer,$this->item,$this->qty,$this->date,'0');
        // $this->query_generate();
  
        //echo $this->sql_query;
          $data = $this->query_insert();
          print_r($data);
        if ($data)
            return true;
        else
            return FALSE;
    }
    
    function get_item_id($item)
    {
        $this->tables = array('material');
        $this->fields = array('id');
        $this->conditions = array('name = ?');
        $this->condition_values = array($item);
        $this->query_generate();
        //echo $this->sql_query;
        $data = $this->query_fetch();
        
        
        return $data;
        
    }
    
    function get_price_item($item_id)
    {
        $this->tables = array('material_price');
        $this->fields = array('price','MAX(date)');
        $this->conditions = array('material_id = ?');
        $this->condition_values = array($item_id);
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
    
}
?>
