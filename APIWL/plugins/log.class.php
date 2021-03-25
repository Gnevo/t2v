<?php

/**
 * Description of log
 * @author dona
 */
class log {
    
    var $path = 'log/';
    var $filename = '';
    var $file_path = '';
    
    function __construct() {
        
        $name = date('Y') . date('m') . date('d');
        $this->filename = $this->path . $name . '.log';
    }
    
    function log_write($log_data, $folder) {
        
        if($folder){
            if($folder)
                $this->file_path = $folder.'/'. $this->filename;
            else
                $this->file_path = $this->filename;
        }
        else{
            $this->file_path = $this->filename;
        }
        $dtz = new DateTime; // current time = server time
        $dtz->setTimestamp(time());
        $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $datetime = $dtz->format('H:i:s');
        $user_details = $_SESSION['user_id'] . ' ' . $_SESSION['user_name'];
        $data = $datetime . ' ' . $user_details . ' ' . $log_data . 
                (isset($_SESSION['login_via']) && $_SESSION['login_via'] == 'MOBILE-APP' ? ' #Mobile-App: Log-id='.$_SESSION['log_id'] : '') . PHP_EOL;
        $file = @fopen($this->file_path, 'a+');
        if($file !== FALSE){
            fwrite($file, $data);
            fclose($file);
        }
    }
}

?>