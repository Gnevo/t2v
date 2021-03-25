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
       $dbHandle = @mysql_connect("localhost",$db['username'],$db['password']);
       $dbSel = @mysql_select_db($db['database_master'],$dbHandle);
       // return success
       if(!$dbHandle || !$dbSel)
           return false;
       $this->dbHandle = $dbHandle;
       return true;
   }
   function close() {
       $this->gc(ini_get('session.gc_maxlifetime'));
       // close database-connection
       return @mysql_close($this->dbHandle);
   }
   function read($sessID) {
       // fetch session-data
       $res = mysql_query("SELECT session_data AS d FROM ws_sessions
                           WHERE session_id = '$sessID'
                           AND session_expires > ".time(),$this->dbHandle);
       // return data or an empty string at failure
       if($row = mysql_fetch_assoc($res))
           return $row['d'];
       return "";
   }
   function write($sessID,$sessData) {
       // new session-expire-time
       //echo $this->lifeTime;
       $newExp = time() + $this->lifeTime;
       $user_id = '';
       $user_id = strstr($sessData, '";user_role', true);
       $user_id = substr($user_id, -7);
       // is a session with this id in the database?
       $res = mysql_query("SELECT * FROM ws_sessions
                           WHERE session_id = '$sessID'",$this->dbHandle);
       // if yes,
       if($res !== FALSE && mysql_num_rows($res)) {
           
           // ...update session-data
           mysql_query("UPDATE ws_sessions
                         SET session_expires = '$newExp',
                         session_data = '$sessData'
                         WHERE session_id = '$sessID'",$this->dbHandle);
           // if something happened, return true
           if(mysql_affected_rows($this->dbHandle)){
               $res = mysql_query("SELECT * FROM ws_sessions
                           WHERE session_id = '$sessID'",$this->dbHandle);
               return true;
           }    
           
       }
       // if no session-data was found,
       else {
           
                // create a new row
                mysql_query("INSERT INTO ws_sessions (
                             session_id,
                             session_expires,
                             session_data)
                             VALUES(
                             '$sessID',
                             '$newExp',
                             '$sessData')",$this->dbHandle);
                // if row was created, return true
                if(mysql_affected_rows($this->dbHandle)){
		   @mysql_close($this->dbHandle);
                   return true;
		}
          
       }
       // an unknown error occured
       return false;
   }
   function destroy($sessID) {
       // delete session-data
//       $res = mysql_query("SELECT SUBSTR(session_data,LOCATE('user_id',session_data)+13,7) AS exist_user FROM ws_sessions
//                           WHERE session_id = '$sessID' AND LOCATE('user_id',session_data) > 0",$this->dbHandle);
       $res = mysql_query("SELECT user_id AS exist_user FROM ws_sessions
                               WHERE session_id = '$sessID'",$this->dbHandle);
       while($row = mysql_fetch_array($res)){
            mysql_query("UPDATE login
                 SET login = 0
                 WHERE username = '".$row['exist_user']."'",$this->dbHandle);
       }
       mysql_query("DELETE FROM ws_sessions WHERE session_id = '$sessID'",$this->dbHandle);
       // if session was deleted, return true,
       if(mysql_affected_rows($this->dbHandle))
           return true;
       // ...else return false
       return false;
   }
   function gc($sessMaxLifeTime) {
       //echo $sessMaxLifeTime;
       
//       $res = mysql_query("SELECT SUBSTR(session_data,LOCATE('user_id',session_data)+13,7) AS exist_user FROM ws_sessions
//                           WHERE session_expires < ".time()." AND LOCATE('user_id',session_data) > 0",$this->dbHandle);
       $res = mysql_query("SELECT user_id AS exist_user FROM ws_sessions
                               WHERE session_expires < ".time(),$this->dbHandle);
       //echo "SELECT user_id AS exist_user FROM ws_sessions
                              // WHERE session_expires < ".time();
       if($res !== FALSE) {
            while($row = mysql_fetch_array($res)){
                 mysql_query("UPDATE login
                      SET login = 0
                      WHERE username = '".$row['exist_user']."'",$this->dbHandle);
            }
       }
       // delete old sessions
       mysql_query("DELETE FROM ws_sessions WHERE session_expires < ".time(),$this->dbHandle);
       // return affected rows
       return mysql_affected_rows($this->dbHandle);
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
//session_set_cookie_params(15);
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