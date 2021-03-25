<?php
require_once('configs/config.inc.php');
//ini_set("session.cookie_lifetime",15);
ini_set('session.gc_maxlifetime',  8 * 60 * 60);
// $cookieLifetime = 8 * 60 * 60;
// setcookie(setcookie(session_name(),session_id(),time()+$cookieLifetime));

//extends db
class session_pdo implements SessionHandlerInterface {

    // session-lifetime
    var $lifeTime;
    // mysql-handle
    var $link;

    public function open($savePath, $sessName) {
        global $db;
        // get session-lifetime

        $this->lifeTime = ini_get('session.gc_maxlifetime');
        //$this->lifeTime = 15;

        $link = mysqli_connect($db['host'], $db['username'], $db['password'], $db['database_master']);
        if ($link) {
            $this->link = $link;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function close() {
        $this->gc(ini_get('session.gc_maxlifetime'));
        // close database-connection
        mysqli_close($this->link);
        return true;
    }

    public function read($sessID) {
        // fetch session-data
        if ($this->link) {
            $res = mysqli_query($this->link,"SELECT session_data FROM ws_sessions WHERE session_id = '".$sessID."' AND session_expires > '".time()."'");
            
            // return data or an empty string at failure
            if ($row = mysqli_fetch_assoc($res))
                return $row['session_data'];
            return "";
        } else
            return "";
    }

    public function write($sessID, $sessData) {
        $newExp = time() + $this->lifeTime;
        /*$user_id = '';
        $user_id = strstr($sessData, '";user_role', true);
        $user_id = substr($user_id, -7);*/
        if ($this->link) {
            $res = mysqli_query($this->link, "SELECT * FROM ws_sessions WHERE session_id = '$sessID'");
            // if yes,
            if ($res && mysqli_num_rows($res)) {

                // ...update session-data
                $res = mysqli_query($this->link, "UPDATE ws_sessions
                         SET session_expires = '$newExp', session_data = '$sessData'
                         WHERE session_id = '$sessID'");
                if ($res) {
//                    $res = mysqli_query($this->link, "SELECT * FROM ws_sessions WHERE session_id = '$sessID'");
                    return TRUE;
                }
                else 
                    return FALSE;
            }
            // if no session-data was found,
            else {

                // create a new row
                $res = mysqli_query($this->link, "INSERT INTO ws_sessions ( session_id, session_expires, session_data )
                             VALUES( '$sessID', '$newExp', '$sessData')");
                // if row was created, return true
                return ($res ? TRUE : FALSE);
            }
        } else
            return FALSE;
    }

    public function destroy($sessID) {
        if ($this->link) {
            $res = mysqli_query($this->link, "SELECT user_id AS exist_user FROM ws_sessions WHERE session_id = '$sessID'");
            while ($row = mysqli_fetch_array($res)) {
                mysqli_query($this->link, "UPDATE login SET login = 0 WHERE username = '" . $row['exist_user'] . "'");
            }
            $res = mysqli_query($this->link, "DELETE FROM ws_sessions WHERE session_id = '$sessID'");
            return ($res ? TRUE : FALSE);
        }
        return FALSE;
    }

    public function gc($sessMaxLifeTime) {
        if ($this->link) {
            $res = mysqli_query($this->link, "SELECT user_id AS exist_user FROM ws_sessions
                               WHERE session_expires < '" . time() . "'");
            if ($res) {
                while ($row = mysqli_fetch_array($res)) {
                    mysqli_query($this->link, "UPDATE login SET login = 0 WHERE username = '" . $row['exist_user'] . "'");
                }
            }
            // delete old sessions
            $res = mysqli_query($this->link, "DELETE FROM ws_sessions WHERE session_expires < '" . time() . "'");
            return ($res ? TRUE : FALSE);
        }
    }

    public function __destruct() {
        session_write_close();
    }

}

$session = new session_pdo();
session_set_save_handler($session, TRUE);
if (session_status() == PHP_SESSION_NONE) {
    session_name('t2v-cirrus');
    session_start('t2v-cirrus');
}
//setcookie(session_name('t2v-cirrus'),session_id(),time()+15);
//session_set_cookie_params(5);
if (isset($_SESSION['last_activity']) && $_SESSION['last_activity']) {

    if ($_SESSION['last_activity'] < time() -  8 * 60 * 60) {
    // if ($_SESSION['last_activity'] < time() -  180) {

        $currentFile = rtrim($_SERVER['PHP_SELF'], "/");
        $parts = explode('/', $currentFile);
        $page_name = $parts[count($parts) - 1];

        if(substr($page_name, 0, 4) != 'api_'){
            $pro = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http');
            $redirect_url = $pro . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            header('location: ' . $preference['url'] . 'logout/?redirect=' . urlencode($redirect_url));
        }
        // (!isset($_SESSION['login_via']) || $_SESSION['login_via'] != 'MOBILE-APP')
        else{
            unset($_SESSION['user_id']);
            unset($_SESSION['user_role']); 
            unset($_SESSION['company_id']); 
            session_destroy();
        }
    }
}
$_SESSION['last_activity'] = time(); //this was the moment of last activity.
?>