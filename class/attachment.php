<?php

/**
 * Model for attachment
 * @author dona
 */
require_once('class/setup.php');
require_once('class/db.php');
require_once('configs/config.inc.php');

class attachment extends db
{
    //object properties
    public $file_name;          //File name
    public $origin_file_name;
    public $upload_date;        //Date when file was upload
    public $uploaded_by;        //Name who uploaded
    public $ids_mail;
    public $id_tickets;

    //this must be connect to DB
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Function what save file at DB
     * @return bool
     */
    public function attachment_add()
    {
        $this->tables = array('attachments');
        $this->fields = array('file_name','origin_file_name', 'uploaded_by', 'upload_date','ids_mail','id_tickets');
        $this->field_values = array($this->file_name,$this->origin_file_name, $this->uploaded_by, $this->upload_date,$this->ids_mail,$this->id_tickets);
        if ($this->query_insert()) {//if i understand correctly how your function work it must insert this data into db
            return $this->get_id();
        } else {
            return false;
        }
    }
    public function get_all_attachments(){
        $this->tables = array('attachments');
        $this->fields = array('id','origin_file_name','ids_mail');
        $this->query_generate();
        $data = $this->query_fetch();
        return $data;
    }
}