<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
//session_start('t2v_cirrus');
date_default_timezone_set('UTC');
$app_dir = getcwd();

//require_once($app_dir . '/class/php_Session.php');
require_once($app_dir . '/class/php_Session_PDO.php');
require_once( $app_dir . '/libs/Smarty.class.php');
require_once( $app_dir . '/configs/config.inc.php');
require_once( $app_dir . '/plugins/localise.class.php');
require_once( $app_dir . '/class/user.php');
require_once( $app_dir . '/class/dona.php');
require_once( $app_dir . '/class/notes.php');
require_once( $app_dir . '/class/mail.php');
require_once( $app_dir . '/class/survey.php');
require_once( $app_dir . '/class/support_new.php');


$currentFile    = rtrim($_SERVER['PHP_SELF'], "/");
$parts          = explode('/', $currentFile);
$page_name      = $parts[count($parts) - 1];
$excepted_session_check_pages = array(
    'index.php', 'forgotpassword.php', 'resetpassword.php', 'send_password_reset_link.php', 'reset_pass_action.php', 'logout.php', 'auth.php', 
    'recruitment_application.php', 'forgotpassword_secondary.php', 'send_secondary_password_reset_link.php', 'reset_secondary_password.php', 'reset_secondary_pass_action.php', 'sms_pword_reset.php', 
    'billing_cron.php', 'customer_appoiments_reminder_sent_cron.php', 'simple.php');

if (!in_array($page_name, $excepted_session_check_pages) && substr($page_name, 0, 4) != 'api_' && substr($page_name, 0, 5) != 'cron_') {
    
    if ($_SESSION['user_role'] == "" && $page_name != '') {

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            //it's ajax request
            header('location: ' . $preference['url'] . 'logout/'); exit();
        } else {
            $pro = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http');
            $redirect_url = $pro . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            header('location: ' . $preference['url'] . 'logout/?redirect=' . urlencode($redirect_url));
            exit();
        }
    }
    else if(isset($_SESSION['secondary_auth']) && $_SESSION['secondary_auth'] === TRUE && $_SESSION['company_id'] == '' && $page_name != '' && $page_name != 'select_company.php'  && $page_name != 'secondary_login.php' && $_SESSION['user_role'] != '0' ){

        $pro = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http');
        $redirect_url = $pro . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        header('location: ' . $preference['url'] . 'select/company/?redirect=' . urlencode($redirect_url));
        exit();
    }
    else if((!isset($_SESSION['secondary_auth']) || $_SESSION['secondary_auth'] !== TRUE) && isset($_SESSION['company_id']) && $_SESSION['company_id'] != '' && !in_array ($page_name, array('', 'secondary_login.php', 'select_company.php', 'change_company.php')) ){
        $pro = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http');
        $redirect_url = $pro . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        header('location: ' . $preference['url'] . 'secondary/login/?redirect=' . urlencode($redirect_url));
        exit();
    }
    
    if (isset($_COOKIE['PWORD_RESET']) && $_COOKIE['PWORD_RESET'] == 1 && $_SESSION['company_id'] != '' && !in_array($page_name, array('', 'change_password.php', 'select_company.php', 'secondary_login.php'))) {
        
        $login_user = $_SESSION['user_id'];
        $tmp_obj_user = new user();
        $tmp_obj_user->username = $login_user;
        $tmp_obj_user->company_id = $_SESSION['company_id'];
        $login_user_data = $tmp_obj_user->validate_secondary_login_username();

        $last_pword_set_date = $login_user_data['last_pw_update_date'];
        $max_date_to_reset_pword = strtotime(date("Y-m-d", strtotime($last_pword_set_date)) . "+6 month"); // calculating date after 3 month
        
        if ($login_user_data && ($login_user_data['last_login_time'] == '0000-00-00 00:00:00' || date('Y-m-d') >= date('Y-m-d', $max_date_to_reset_pword))) {
            $pro = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http');
            header("Location: " . $preference['url'] . "change/password/");
            exit();
        }
        else {
            unset($_COOKIE['PWORD_RESET']);
            setcookie('PWORD_RESET', '', time() - 3600, '/');
        }
    }
}

class smartySetup extends Smarty {

    var $lang = 'se';
    var $hash = '';
    var $url = '';
    var $chat_session = 'off';
    var $company = array();
    var $db_master = '';
    var $role = array();
    var $leave_type = array();
    var $slot_type = array();
    var $travel_type = array();
    var $localise;
    var $translate = array();

    function __construct($files = array(), $dashboard_execution = TRUE) {

        global $path, $db, $preference, $company, $role, $leave_type, $slot_type, $travel_type, $languages;

        $smarty = parent::__construct();
        
        //setting up compaliation path for smarty
        $this->template_dir = $path['template_dir'];
        $this->compile_dir = $path['compile_dir'];
        $this->config_dir = $path['config_dir'];
        $this->cache_dir = $path['cache_dir'];
        $this->caching = $preference['caching'];

        $this->lang = $preference['lang'];
        $this->hash = $preference['hash'];
        $this->url = $preference['url'];
        $this->chat_session = $preference['chat_session'];      //status of chat application - by shamsu
        //setting company details from config file
        $this->db_master = $db['database_master'];
        $this->company = $company;
        $this->role = $role;
        $this->leave_type = $leave_type;
        $this->slot_type = $slot_type;
        $this->travel_type = $travel_type;
        $files[] = 'global_keys.xml';
        
        if (isset($_SESSION['lang']) && $_SESSION['lang'] != '') {
            $this->lang = $_SESSION['lang'];
        }
        
        $this->localise = new localise($files, $this->lang);
        //getting company details
        
        $user = new user();
        
//        $mail = new mail();
//        $dona = new dona();
//        $notes = new notes();\
        if ($dashboard_execution) {
            $this->assign('privileges_general', $general_previlages = $user->get_privileges($_SESSION['user_id'], 2));
            $this->assign('privileges_mc', $mc_previlages = $user->get_privileges($_SESSION['user_id'], 3));
            $this->assign('privileges_forms', $user->get_privileges($_SESSION['user_id'], 4));
            $this->assign('privileges_reports', $user->get_privileges($_SESSION['user_id'], 5));
            
        }

        if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
            $this->assign('languages', $languages);
            $this->assign('lang', $this->lang);
            $pro = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http');
            $redirect_form = $pro . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            $this->assign('redirect_form', $redirect_form);
        }
        $db_name = $db['database_master'];
        if (isset($_SESSION['db_name']) && $_SESSION['db_name'] != '') {
            $db_name = $_SESSION['db_name'];
        }
        $this->assign('db_name', $db_name);

        //if($page_name != ""){
        if(isset($_SESSION['company_id']))
            $this->assign('company_id', $_SESSION['company_id']);
        //}
        //setting some smarty values for app
        $this->assign('app_name', $preference['app_name']);
        $this->assign('url_path', $preference['url']);
        $this->assign('chat_service_url', $preference['chat_service_url']);
        $this->assign('chat_session', $preference['chat_session']);
        $this->translate = $this->localise->contents;
        $this->assign('translate', $this->translate);
        if(isset($_SESSION['user_name']))
            $this->assign('user_display_name', $_SESSION['user_name']);
        if(isset($_SESSION['user_role']))
            $this->assign('user_role', $_SESSION['user_role']);
        if(isset($_SESSION['user_id']))
            $this->assign('user_id', $_SESSION['user_id']);
        if ($dashboard_execution) {
            $mail = new mail();
            $dona = new dona();
            $notes = new notes();
            $support = new support();
            $obj_company = new company();
            $cls_survey = new survey();
            $company_det = $obj_company->get_company_detail($_SESSION['company_id']);
            $candg = $company_det['candg'];
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] != 4){
                if($general_previlages['candg_wi'] == 1)
                    $candg = 0;
                if($general_previlages['candg_wo'] == 1)
                    $candg = 1;
            }
            $this->assign('candg', $candg);
            
            if ($mc_previlages && ($mc_previlages['leave_notification'] == 1 || $mc_previlages['leave_approval'] == 1 || $mc_previlages['leave_rejection'] == 1 || $mc_previlages['leave_edit'] == 1)) {
                // start- fetch count of unread leaves
//                $leave_list = $dona->get_all_employee_leave();
//                $unread_leave = $dona->get_unread_leave();
//                $updated_unread_leave = $dona->get_all_unread_leaves($leave_list, $unread_leave);
//                $this->assign('unread_leaves_count_top', count($updated_unread_leave));
                $this->assign('unread_leaves_count_top', $dona->get_employee_unread_leave_count());
                // end- fetch count of unread leaves
            } else {
                $this->assign('unread_leaves_count_top', 0);
            }

            if ($mc_previlages && ($mc_previlages['notes'] == 1 || $mc_previlages['notes_approval'] == 1 || $mc_previlages['notes_rejection'] == 1)) {
                // start- fetch count of unread notes
//                $notes_list = $notes->get_all_notes();
//                $unread_notes = $notes->get_unread_note();
//                $updated_unread_notes = $notes->get_all_unread_notes($notes_list, $unread_notes);
//                $this->assign('unread_notes_count_top', count($updated_unread_notes));
                $this->assign('unread_notes_count_top', $notes->get_unread_note_count());
                // end- fetch count of unread notes
            } else {
                $this->assign('unread_notes_count_top', 0);
            }

            if ($mc_previlages && ($mc_previlages['support'] == 1)) {
                // start- fetch count of unread notes
                $user_ticket_count = $support->get_ticket_open_count();
                $this->assign('user_ticket_count', $user_ticket_count);
                // end- fetch count of unread notes
            } else {
                $this->assign('user_ticket_count', 0);
            }

            if ($mc_previlages && $mc_previlages['cirrus_mail'] == 1) {
                $unread_mail = $mail->get_all_unread_mail();
                $this->assign('mail_count_top', count($unread_mail));
                //        $smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
            } else {
                $this->assign('mail_count_top', 0);
            }

            if ($mc_previlages && $mc_previlages['document_archive'] == 1 && $_SESSION['user_role'] !=1 && $_SESSION['user_role'] != 6) {
                $unread_docs = $notes->document_archive_get_unread();
                $this->assign('unread_document', $unread_docs);
                //        $smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
            } else {
                $this->assign('unread_document', 0);
            }

            if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
                $user_companies = $user->get_user_companies($_SESSION['user_id']);
                $this->assign('user_companies', $user_companies);

                $survey_data = $cls_survey->get_surveys_user();
                $this->assign('surveys_count', count($survey_data));

                $picture_path = 'images/dashboard-avatar.png';
                $picture = $user->get_user_picture($_SESSION['user_id']);
                if ($picture) {
                    $upload_path = $user->get_folder_name($_SESSION['company_id']) . '/profile/';
                    $picture_path = $upload_path . $picture;
                }
                $this->assign('picture', $picture_path);
                
                $chat_users = $user->get_users_for_chat($_SESSION['user_id'], $_SESSION['user_role']);
                $this->assign('chat_users', json_encode(array($chat_users)));
                // echo '<pre>'.print_r($chat_users, 1).'</pre>'; exit();

            }
        }
        
        return $smarty;
    }

}

//require_once( $app_dir . '/plugins/php_function.class.php');
if (!function_exists('mime_content_type')) {

    function mime_content_type($filename) {

        $mime_types = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',
            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.', $filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }

}
?>
