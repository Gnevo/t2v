<?php
/**
 * Description of work
 * @author dona
 */
require_once('configs/config.inc.php');
require_once ('class/db.php');

class work extends db {

    //variable diclaration
	var $id = '';
	var $root_id = '';
    var $name = '';
    var $icon = '';
    var $description = '';
    
    function __construct() {

        parent::__construct();
    }
    
    function works_add() {

        if ($this->name != NULL ) {

            $this->tables = array('work');
            $this->fields = array('name', 'root_id','description','icon');
            $this->field_values = array($this->name, $this->root_id, $this->description,$this->icon);
          
			if ($this->query_insert()) {
           
                return TRUE;
            } else {

                return FALSE;
            }
        } else {

            return FALSE;
        }
    }
	function get_sub_works($root_id = 0) {

        $this->tables = array("work");
        $this->fields = array("id", "name", "root_id");
        $this->conditions = array("root_id = ?");
        $this->condition_values = array($root_id);
        //$this->orderBy = array("weight", "name");
        $this->query_generate();
        $result = $this->query_fetch();
		//print_r($result);
        return $result;
    }
	function get_work_options($works) {

           foreach ($works as $work) {
			
            $sel = "";
           
            $options .= "<option value=\"" . $work['id'] . "\" " . $sel . ">" . $this->str . $work['name'] . "</option>";

            if ($root_work = $this->get_sub_works($work['id'])) {

                $this->str .= "-";
                $options .= $this->get_work_options($root_work);
            }
        }
        $this->str = substr($this->str, 0, -1);
        return $options;
    }
 function work_list() {

        $this->tables = array('work');
        $this->fields = array('name','id');
        //$this->conditions = array();
        $this->query_generate();
        $datas = $this->query_fetch();
       // $datas = $this->makeArray($result);
		
        if (!empty ($datas))
            return $datas;
        else
            return FALSE;
    }
	 function makeArray($datas = array()){
        
        $data_array = array();
        foreach ($datas as $data){
            
            $data_array[$data['id']] = $data['name'];
        }
        return $data_array;
    }
	function resize_image($source, $dest) {
            
            $size = getimagesize($source);
            $width_orig = $size[0];
            $height_orig = $size[1];
            $width = 64;
            $height = 64;
          
            $dimg = imagecreatetruecolor($width, $height);
            $stype = $size[2];
            // [[ print_r(get_defined_constants()); ]]  =>  [IMAGETYPE_GIF] => 1 [IMAGETYPE_JPEG] => 2  [IMAGETYPE_PNG] => 3   
            switch ($stype) {
                case 1:
                    $simg = imagecreatefromgif($source);
                    imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagegif($dimg, $dest, 100);
                    break;
                case 2:
                    $simg = imagecreatefromjpeg($source);
                    imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagejpeg($dimg, $dest, 100);
                    break;
                case 3:
                    $simg = imagecreatefrompng($source);
                    imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagepng($dimg, $dest, 100);
                    break;
            }
			imagedestroy($simg);
            imagedestroy($dimg);
        }
        function get_work_name($id)
        {
            $this->tables = array('work');
            $this->fields = array('name');
            $this->conditions = array('id = ?');
            $this->condition_values = array($id);
            $this->query_generate();
            //echo $this->sql_query;
            $result = $this->query_fetch();
            //print_r($result);
            if (!empty ($result))
                return $result;
            else
                return FALSE;
        }
        
}

?>
