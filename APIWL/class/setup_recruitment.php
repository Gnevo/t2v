<?php
date_default_timezone_set('UTC');
$app_dir = getcwd();
require_once($app_dir . '/libs/Smarty.class.php');
require_once($app_dir . '/configs/config.inc.php');
require_once ($app_dir . '/plugins/localise.class.php');
class smartySetup extends Smarty {

    var $lang = 'en';
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

    function __construct($files = array()) {

        global $path, $db, $preference, $company, $role, $leave_type, $slot_type, $travel_type;

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
        $this->localise = new localise($files, $this->lang);
        //getting company details
        
        
        //setting some smarty values for app
        $this->assign('app_name', $preference['app_name']);
        $this->assign('url_path', $preference['url']);
        $this->assign('chat_session', $preference['chat_session']);
        $this->translate = $this->localise->contents;
        $this->assign('translate', $this->translate);
        
        return $smarty;
    }

}
if(!function_exists('mime_content_type')) {

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

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }
}
?>
