<?php
function insert_email(){
        $this->tables = array('email');
        $this->fields = array( '`from`', '`to`', 'subject', 'message');
        $this->field_values = array( $this->from, $this->to, $this->subject, $this->message);
        if ($this->query_insert())
            return TRUE;
        else
            return FALSE;
}
function get_mail($id_mail,$met= null){
        $this->tables = array('mail');
        $this->fields = array('root_id', '`from`', '`to`', 'subject', 'message', 'attachments', 'status');
        $this->conditions = array('id = ?');
        $this->condition_values = array($id_mail);
        $this->query_generate();
        $data = $this->query_fetch();
        if($met != null){
            $this->tables = array('employee');
            $this->fields = array('first_name','last_name');
            if($met == 1){
                $this->conditions = array('username = ?');
                $this->condition_values = array($data[0]['from']);
            }
            else{
                $this->conditions = array('username = ?');
                $this->condition_values = array($data[0]['to']);
            }
            $this->query_generate();
            $data1 = $this->query_fetch();
            $data[0]['from_name'] = $data1[0]['first_name']." ".$data1[0]['last_name'];
        }
        if ($data)
            return $data[0];
        else
            return FALSE;
    }
?>
