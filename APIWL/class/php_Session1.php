    <?php
require_once('configs/config.inc.php');
class session {
   // session-lifetime
   var $lifeTime;
   // mysql-handle
   var $dbHandle;
   function open($savePath, $sessName) {
       global $db;
       // get session-lifetime
       $this->lifeTime = get_cfg_var("session.gc_maxlifetime");
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
       $newExp = time() + $this->lifeTime;
       $user_id = '';
       $user_id = strstr($sessData, '";user_role', true);
       $user_id = substr($user_id, -7);
       // is a session with this id in the database?
       $res = mysql_query("SELECT * FROM ws_sessions
                           WHERE session_id = '$sessID'",$this->dbHandle);
       // if yes,
       if(mysql_num_rows($res)) {
           
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
                if(mysql_affected_rows($this->dbHandle))
                   return true;
          
       }
       // an unknown error occured
       return false;
   }
   function destroy($sessID) {
       // delete session-data
       mysql_query("DELETE FROM ws_sessions WHERE session_id = '$sessID'",$this->dbHandle);
       // if session was deleted, return true,
       if(mysql_affected_rows($this->dbHandle))
           return true;
       // ...else return false
       return false;
   }
   function gc($sessMaxLifeTime) {
       
       $res = mysql_query("SELECT SUBSTR(session_data,LOCATE('user_id',session_data)+13,7) AS exist_user FROM ws_sessions
                           WHERE session_expires < ".time()." AND LOCATE('user_id',session_data) > 0",$this->dbHandle);
       while($row = mysql_fetch_array($res)){
            mysql_query("UPDATE login
                 SET login = 0
                 WHERE username = '".$row['exist_user']."'",$this->dbHandle);
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
session_start('t2v-cirrus');

    
?>