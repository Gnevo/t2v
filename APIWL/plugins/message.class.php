<?php
/**
 * Description of class
 *
 * @author dona
 */
//require(getcwd() .'/class/setup.php');

class message extends smartySetup{

    var $type = "message";
    var $message = "";

    function __construct() {
        parent::__construct(array('messages.xml'),FALSE);
        $this->message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
        $this->type = isset($_SESSION['type']) ? $_SESSION['type'] : '';
    }

    function set_message($type, $message) {
        $_SESSION['message'] = $message;
        $_SESSION['type'] = $type;
    }
    function set_message_exact($type, $message) {
        
        $_SESSION['message_exact'] = $message;
        $_SESSION['type'] = $type;
    }

    function show_message() {
        $display = '';
        if ((isset($_SESSION['message']) && $_SESSION['message'] != '') || (isset($_SESSION['message_exact']) && $_SESSION['message_exact'] != '')) {
            
            $message_class = '';
            $message_subject = '';
            $message_icon = '';
            
            $this->type = isset($_SESSION['type']) ? $_SESSION['type'] : '';
            $this->message = (isset($_SESSION['message']) ? $this->translate[$_SESSION['message']] : '').' '.(isset($_SESSION['message_exact']) ? $_SESSION['message_exact'] : '');
//            echo "<pre>".print_r($_SESSION, 1)."</pre>";
            switch (strtoupper($this->type)) {
                case 'SUCCESS' :
                    $message_class = 'alert-success';
                    $message_subject = $this->translate['message_caption_success'];
                    $message_icon = '<i class="icon-ok-sign icon-large"></i>';
                    break;
                case 'ERROR' :
                case 'FAIL' :
                    $message_class = 'alert-danger';
                    $message_subject = $this->translate['message_caption_error'];
                    $message_icon = '<i class="icon-remove-sign icon-large"></i>';
                    break;
                case 'INFO' :
                    $message_class = 'alert-info';
                    $message_subject = $this->translate['message_caption_information'];
                    $message_icon = '<i class="icon-info-sign icon-large"></i>';
                    break;
                case 'WARNING' :
                    $message_class = 'alert-warning';
                    $message_subject = $this->translate['message_caption_warning'];
                    $message_icon = '<i class="icon-exclamation-sign icon-large"></i>';
                    break;
            }
            
//                                    <button data-dismiss="alert" class="close" type="button">×</button>
            $display = '<div class="alert ' . $message_class . ' alert-dismissable no-ml no-mr">
                                    <a href="#" data-dismiss="alert" class="close">×</a>
                                    <strong>' . $message_icon . ' ' . $message_subject . '</strong>:  ' . $this->message . '
                                </div>';
        }
        $this->clear_message();
        return $display;
    }
    
    function show_message_exact() {
        $display = '';
        if ((isset($_SESSION['message']) && $_SESSION['message'] != '') || (isset($_SESSION['message_exact']) && $_SESSION['message_exact'] != '')) {
            
            $this->message = (isset($_SESSION['message']) ? $this->translate[$_SESSION['message']] : '').' '.(isset($_SESSION['message_exact']) ? $_SESSION['message_exact'] : '');
            $display = $this->message;
        }
        $this->clear_message();
        return $display;
    }

    function show_message_data_for_gritter() {

        $obj_return = '';   //not remove this
        if ((isset($_SESSION['message']) && $_SESSION['message'] != '') || (isset($_SESSION['message_exact']) && $_SESSION['message_exact'] != '')) {
            
            $message_class = '';
            $message_subject = '';
            
            $this->type = isset($_SESSION['type']) ? $_SESSION['type'] : '';
            $this->message = (isset($_SESSION['message']) ? $this->translate[$_SESSION['message']] : '').' '.(isset($_SESSION['message_exact']) ? $_SESSION['message_exact'] : '');
            switch (strtoupper($this->type)) {
                case 'SUCCESS' :
                    $message_class = 'gritter-light gritter-success';
                    $message_subject = $this->translate['message_caption_success'];
                    break;
                case 'ERROR' :
                case 'FAIL' :
                    $message_class = 'gritter-light gritter-danger';
                    $message_subject = $this->translate['message_caption_error'];
                    break;
                case 'INFO' :
                    $message_class = 'gritter-light gritter-info';
                    $message_subject = $this->translate['message_caption_information'];
                    break;
                case 'WARNING' :
                    $message_class = 'gritter-light gritter-warning';
                    $message_subject = $this->translate['message_caption_warning'];
                    break;
            }
            
            $obj_return = new stdClass();
            $obj_return->message_class = $message_class;
            $obj_return->subject = $message_subject;
            $obj_return->message = $this->message;
            
            /*$.gritter.add({
		title: $obj_return->subject,
		text: $obj_return->message,
		image_class: true,
		sticky: true,
		time: '',
		class_name: $obj_return->message_class
            });*/
        }
        $this->clear_message();
        return $obj_return;
    }

    function clear_message() {
        $this->type = "message";
        $this->message = $_SESSION['message'] = $_SESSION['message_exact'] = $_SESSION['type'] = "";
        return TRUE;
    }

}
?>