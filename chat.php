<?php
//session_start();
/*

  Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)

  This script may be used for non-commercial purposes only. For any
  commercial purposes, please contact the author at
  anant.garg@inscripts.com

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
  OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
  WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
  FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
  OTHER DEALINGS IN THE SOFTWARE.

 */
require_once ('class/setup.php');
require_once('./class/chat.php');
//global $chat_obj;
//$chat_obj= new chat();

//define('DBPATH', '192.168.0.234');
//define('DBPATH', 'localhost');
//define('DBUSER', 't2v');
//define('DBPASS', 't2v');
//define('DBNAME', 't2v_cirrus');

//if(!isset($_SESSION)) {
     
//}
// echo "<script>alert(\"Enthayi\")</script>";

//global $dbh;
//$dbh = mysql_connect(DBPATH, DBUSER, DBPASS);
//mysql_selectdb(DBNAME, $dbh);


if ($_GET['action'] == "chatheartbeat") {
    chatHeartbeat();
}
if ($_GET['action'] == "sendchat") {
    sendChat();
}
if ($_GET['action'] == "closechat") {
    closeChat();
}
if ($_GET['action'] == "startchatsession") {
    //echo "<script>alert(\"SMSDN\")</script>";
    startChatSession();
}

if (!isset($_SESSION['chatHistory'])) {
    $_SESSION['chatHistory'] = array();
}

if (!isset($_SESSION['openChatBoxes'])) {
    $_SESSION['openChatBoxes'] = array();
}

function chatHeartbeat() {
     $chat_obj= new chat();
//    $sql = "select * from chat where (chat.to = '" . mysql_real_escape_string($_SESSION['user_id']) . "' AND recd = 0) order by id ASC";
//    $query = mysql_query($sql);
     
    $not_received_chats = $chat_obj->get_not_received_chats();
    $items = '';

    $chatBoxes = array();

//    while ($chat = mysql_fetch_array($query)) {
        foreach($not_received_chats as $chat){

        if (!isset($_SESSION['openChatBoxes'][$chat['from_chat']]) && isset($_SESSION['chatHistory'][$chat['from_chat']])) {
            $items = $_SESSION['chatHistory'][$chat['from_chat']];
        }

        $chat['message'] = sanitize($chat['message']);

        $items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from_chat']}",
			"m": "{$chat['message']}"
	   },
EOD;

        if (!isset($_SESSION['chatHistory'][$chat['from_chat']])) {
            $_SESSION['chatHistory'][$chat['from_chat']] = '';
        }

        $_SESSION['chatHistory'][$chat['from_chat']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['from_chat']}",
			"m": "{$chat['message']}"
	   },
EOD;

        unset($_SESSION['tsChatBoxes'][$chat['from_chat']]);
        $_SESSION['openChatBoxes'][$chat['from_chat']] = $chat['sent'];
    }

    if (!empty($_SESSION['openChatBoxes'])) {
        foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
            if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
                $now = time() - strtotime($time);
                $time = date('g:iA M dS', strtotime($time));

                $message = "Sent at $time";
                if ($now > 180) {
                    $items .= <<<EOD
                    {
                        "s": "2",
                        "f": "{$chatbox}",
                        "m": "{$message}"
                    },
EOD;

                    if (!isset($_SESSION['chatHistory'][$chatbox])) {
                        $_SESSION['chatHistory'][$chatbox] = '';
                    }

                    $_SESSION['chatHistory'][$chatbox] .= <<<EOD
                    {
                        "s": "2",
                        "f": "{$chatbox}",
                        "m": "{$message}"
                    },
EOD;
                    $_SESSION['tsChatBoxes'][$chatbox] = 1;
                }
            }
        }
    }

//    $sql = "update chat set recd = 1 where chat.to = '" . mysql_real_escape_string($_SESSION['user_id']) . "' and recd = 0";
//    $query = mysql_query($sql);
    $chat_obj= new chat();
    $ret_flag = $chat_obj->update_chat_received_flag();

    if ($items != '') {
        $items = substr($items, 0, -1);
    }
    header('Content-type: application/json');
    ?>
    {
    "items": [
    <?php echo $items; ?>
    ]
    }

    <?php
    exit(0);
}

function chatBoxSession($chatbox) {

    $items = '';

    if (isset($_SESSION['chatHistory'][$chatbox])) {
        $items = $_SESSION['chatHistory'][$chatbox];
    }

    return $items;
}

function startChatSession() {
    $items = '';
    if (!empty($_SESSION['openChatBoxes'])) {
        foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
            $items .= chatBoxSession($chatbox);
        }
    }
//    echo $_SESSION['user_id'];

    if ($items != '') {
        $items = substr($items, 0, -1);
    }
//    echo "<script type=\"text/javascript\">alert(\"SMSDN\")</script>";
    header('Content-type: text/json');
    ?>
    {
    "username": "<?php echo $_SESSION['user_id']; ?>",
    "items": [
    <?php echo $items; ?>
    ]
    }
    
    <?php
//    header("content-type: text/javascript");
//    $data = null;
//    $data["username"]= $_SESSION['user_id'];
//    $data["items"]=$items;
//    echo json_encode($data);

    exit(0);
}

function sendChat() {
    $from = $_SESSION['user_id'];
    $to = $_POST['to'];
    $message = $_POST['message'];
//    echo "<script>alert('".$from."__".$to."__".$message."')</script>";

    $_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());

    $messagesan = sanitize($message);

    if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
        $_SESSION['chatHistory'][$_POST['to']] = '';
    }

    $_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


    unset($_SESSION['tsChatBoxes'][$_POST['to']]);

//    $sql = "insert into chat (chat.from,chat.to,message,sent) values ('" . mysql_real_escape_string($from) . "', '" . mysql_real_escape_string($to) . "','" . mysql_real_escape_string($message) . "',NOW())";
//    $query = mysql_query($sql);
    $chat_obj= new chat();
    $ret_flag = $chat_obj->insert_new_chat($from,$to,$message);
    
    echo "1";
    exit(0);
}

function closeChat() {

    unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);

    echo "1";
    exit(0);
}

function sanitize($text) {
    $text = htmlspecialchars($text, ENT_QUOTES);
    $text = str_replace("\n\r", "\n", $text);
    $text = str_replace("\r\n", "\n", $text);
    $text = str_replace("\n", "<br>", $text);
    return $text;
}

?>