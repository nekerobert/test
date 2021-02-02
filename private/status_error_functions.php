<?php
    
    function display_status_message($status, $msg){
        $str = '';
        if(strlen($msg) !== 0){
            $alertClass =  ($status) ? "alert-success " : "alert-danger";
            $alerttype =  ($status) ? "Success!!!" : "Failure!!!";
            $str.='<div class="alert '.$alertClass.' alert-dismissible fade show" role="alert">
            <strong>'.$alerttype.'</strong> '.$msg.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }
        return $str;
        
    }

    function session_message($msg="",$status=false){
        if(!empty($msg) && !isset($_SESSION["message_status"])){
            $_SESSION["message"] = $msg;
            $_SESSION["message_status"] = $status;
        }
        else{
            return ["msg"=>$_SESSION["message"], "status"=>$_SESSION["message_status"]];
        }
    }

    function cookie_message($msg="",$status=false){
        if(!empty($msg)){
            // Set cookie value duration for one hour
            // This cookie value will be destroy when the cookie message is displayed
            setcookie("message", $msg, time() + (3600), "/");
            setcookie("status", $status, time() + (3600), "/");
        }
        else{
            //var_dump($_COOKIE); exit;
            return ["message"=>$_COOKIE["message"], "status"=>$_COOKIE["status"] ?? false];
        }
    }

    function display_session_message($status){
        $msgArray = session_message();
        unset($_SESSION["message"]);
        unset($_SESSION["message_status"]);
        return display_status_message($msgArray["status"], $msgArray["message"]);
    }

    // function display_cookie_message($status){
    //     $msgArray = cookie_message();
    //     // Set it to 24hours ago to destroy it
    //     return display_status_message($msgArray["status"], $msgArray["message"]);
      
    // }

    function destroy_cookie_message(){
        unset($_COOKIE["message"]);
        unset($_COOKIE["status"]);
        setcookie("message", null, time() - 1,'/');
        // Set it to 24hours ago to destroy it
        setcookie("status", null, time() - 1,'/');
        return true;
    }


    function form_error_component($data, $key){
        // Display validation error if available.
        $str = "";
        if(isset($data[$key])){
            $str.= '<div class="text-danger"> '.$data[$key].' </div>';
        }
        return $str;

    }

    function display_multiple_errors($errors){
        $str = "";
        if(isset($errors["mode"])){
            $errors = exclude_and_regenerate($errors, 'mode');
        $str .= ' <ul class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Ooops! Failure</strong> Please fix the following Errors.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>';
        foreach($errors as $error){
            $str.='<li>'.$error.'</li>';
        }
        $str.=" </ul>";
        }
        return $str;

    }

    function output_session_message($status, $msg){
        // echo $_SESSION["message"]; exit;
        return isset($_SESSION["message"]) ? display_session_message($status) : display_status_message($status, $msg);
    }

    // function output_cookie_message($status, $msg){
    //      // destroy cookie message since displayed
    //      destroy_cookie_message();
    //     return isset($_COOKIE["message"]) ? display_cookie_message($status) : 
    // }



?>