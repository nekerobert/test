<?php
    session_start(); //start a session
    // session_regenerate_id(true);
    $GLOBALS["path"] = "/";     // This will be updated in the remote server
    // $path = parse_url($GLOBALS["path"]); 
    
    define('PRIVATE_PATH', dirname(__FILE__)); //Absolute path to private folder
    define("PROJECT_PATH", dirname(PRIVATE_PATH)); //Absolute path to Project folder
    define('INCLUDES_PATH', PROJECT_PATH.'/includes'); //Absolute path to include folder
    define('UPLOAD_PATH', PROJECT_PATH.'/uploads'); //Absolute path to Uploads folder
    define('UPLOAD_URL', $GLOBALS['path'].'uploads');//absolute path to uploads folder used for rendering images on the frontend
    define('ADMIN_ASSET_PATH', $GLOBALS['path'].'dashboard/assets/'); //absolute path to dashboard assets used in frontend
    define('DASHBOARD_PATH', $GLOBALS['path'].'dashboard/'); //absolute path to dashboard folder
    // Required Functions
    require_once('db_functions.php');
    require_once('functions.php');
    require_once('query_functions.php');
    require_once('file_upload_functions.php');
    require_once('validation_functions.php');
    require_once('authentication.php');
    require_once('status_error_functions.php');
    require_once('components.php');
    require_once('pagination.php');
    require_once('csrf_token_functions.php');
    
    // Database Connection Handle
    $db = db_connect();



    

?>