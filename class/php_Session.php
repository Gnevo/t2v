<?php
require_once('configs/config.inc.php');
//ini_set("session.cookie_lifetime",15);
ini_set('session.gc_maxlifetime',8*60*60);
class session {
   // session-lifetime
   var $lifeTime;
   // mysql-handle
   var $dbHandle;
   function open($savePath, $sessName) {
       global $db;
       // get session-lifetime
       
       $this->lifeTime = ini_get('session.gc_maxlifetime');
       //$this->lifeTime = 15;
       
       // open database-connection
       unset($this->dbHandle);
       $dbHandle = @mysqli_connect("p:localhost",$db['username'],$db['password']);
       $dbSel = @mysqli_select_db($dbHandle, $db['database_master']);
       // return success
//       if(!$dbHandle || !$dbSel){
//            echo "<pre>".print_r($dbHandle, 1)."</pre>"; exit();
//           return false;
//           
//       }
       $this->dbHandle = $dbHandle;
//       echo "mysqli_error<pre>".print_r(mysqli_error(), 1)."</pre>"; exit();
//       echo "mysqli_connect_error<pre>".print_r(mysqli_connect_error(), 1)."</pre>"; exit();
       return true;
   }
   function close() {
       $this->gc(ini_get('session.gc_maxlifetime'));
       // close database-connection
       return @mysqli_close($this->dbHandle);
   }
   function read($sessID) {
       // fetch session-data
       if($this->dbHandle){
       $res = mysqli_query($this->dbHandle, "SELECT session_data AS d FROM ws_sessions
                           WHERE session_id = '$sessID'
                           AND session_expires > ".time());
       // return data or an empty string at failure
       if($row = mysqli_fetch_assoc($res))
           return $row['d'];
       return "";
       }
       else
           return "";
   }
   function write($sessID,$sessData) {
       // new session-expire-time
       //echo $this->lifeTime;
       $newExp = time() + $this->lifeTime;
       $user_id = '';
       $user_id = strstr($sessData, '";user_role', true);
       $user_id = substr($user_id, -7);
       if($this->dbHandle){
       // is a session with this id in the database?
       $res = mysqli_query($this->dbHandle, "SELECT * FROM ws_sessions
                           WHERE session_id = '$sessID'");
       // if yes,
       if($res && mysqli_num_rows($res)) {
           
           // ...update session-data
           mysqli_query($this->dbHandle, "UPDATE ws_sessions
                         SET session_expires = '$newExp',
                         session_data = '$sessData'
                         WHERE session_id = '$sessID'");
           // if something happened, return true
           if(mysqli_affected_rows($this->dbHandle)){
               $res = mysqli_query($this->dbHandle, "SELECT * FROM ws_sessions
                           WHERE session_id = '$sessID'");
               return true;
           }    
           
       }
       // if no session-data was found,
       else {
           
                // create a new row
                mysqli_query($this->dbHandle, "INSERT INTO ws_sessions (
                             session_id,
                             session_expires,
                             session_data)
                             VALUES(
                             '$sessID',
                             '$newExp',
                             '$sessData')");
                // if row was created, return true
                if(mysqli_affected_rows($this->dbHandle)){
		   @mysqli_close($this->dbHandle);
                   return true;
		}
          
       }
       }else
           return true;
       // an unknown error occured
       return false;
   }
   function destroy($sessID) {
       // delete session-data
//       $res = mysqli_query("SELECT SUBSTR(session_data,LOCATE('user_id',session_data)+13,7) AS exist_user FROM ws_sessions
//                           WHERE session_id = '$sessID' AND LOCATE('user_id',session_data) > 0",$this->dbHandle);
       if($this->dbHandle){
       $res = mysqli_query($this->dbHandle, "SELECT user_id AS exist_user FROM ws_sessions
                               WHERE session_id = '$sessID'");
       while($row = mysqli_fetch_array($res)){
            mysqli_query($this->dbHandle, "UPDATE login
                 SET login = 0
                 WHERE username = '".$row['exist_user']."'");
       }
       mysqli_query($this->dbHandle, "DELETE FROM ws_sessions WHERE session_id = '$sessID'");
       // if session was deleted, return true,
       if(mysqli_affected_rows($this->dbHandle))
           return true;
       }
       return TRUE;
       // ...else return false
       return false;
   }
   function gc($sessMaxLifeTime) {
        //echo $sessMaxLifeTime;
//       $res = mysqli_query("SELECT SUBSTR(session_data,LOCATE('user_id',session_data)+13,7) AS exist_user FROM ws_sessions
//                           WHERE session_expires < ".time()." AND LOCATE('user_id',session_data) > 0",$this->dbHandle);
        if ($this->dbHandle && FALSE) {
//           echo "mysqli_error<pre>".print_r(mysqli_error(), 1)."</pre>";
//       echo 'gc'. $sessMaxLifeTime; //exit();
            $res = mysqli_query($this->dbHandle, "SELECT user_id AS exist_user FROM ws_sessions
                               WHERE session_expires < '" . time() . "'");
            //echo "SELECT user_id AS exist_user FROM ws_sessions
            // WHERE session_expires < ".time();
            if ($res) {
                while ($row = mysqli_fetch_array($res)) {
                    mysqli_query($this->dbHandle, "UPDATE login
                      SET login = 0
                      WHERE username = '" . $row['exist_user'] . "'");
                }
            }
            // delete old sessions
            mysqli_query($this->dbHandle, "DELETE FROM ws_sessions WHERE session_expires < '" . time() . "'");
            // return affected rows
            return mysqli_affected_rows($this->dbHandle);
        }
    }

    public function __destruct() 
    { 
        session_write_close(); 
    } 

}
$session = new session();
session_set_save_handler(array(&$session,"open"),
                         array(&$session,"close"),
                         array(&$session,"read"),
                         array(&$session,"write"),
                         array(&$session,"destroy"),
                         array(&$session,"gc"));
if (session_status() == PHP_SESSION_NONE) {
session_name('t2v-cirrus');
session_start('t2v-cirrus');
}
//setcookie(session_name('t2v-cirrus'),session_id(),time()+15);
//session_set_cookie_params(5);
if(isset($_SESSION['last_activity']) && $_SESSION['last_activity']){
	if( $_SESSION['last_activity'] < time()-8*60*60 ) { 
	   $pro = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http');
	   $redirect_url =  $pro."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	   header('location: '.$preference['url'] . 'logout/?redirect='.urlencode($redirect_url));
	}
}
$_SESSION['last_activity'] = time(); //this was the moment of last activity.
?>