<?php

    function is_post_request(){
        return $_SERVER["REQUEST_METHOD"] === "POST";
    }

    function is_get_request(){
        return $_SERVER["REQUEST_METHOD"] === "GET";
    }

    function h($str){
        return htmlspecialchars($str);
    }

function sanitize_html($data = []){
    if(!empty($data)){
        $sanitize_array = [];
        foreach($data as $key => $value){
            $sanitize_array[$key] = trim(h($value));
        }
        return $sanitize_array;
    }
    return $data;
    
}

function redirect_to($location){
    return header('Location: '.$location);
}

function u($data){
    return urlencode($data);
}

function full_upload_url($path){
    return UPLOAD_URL.'/'.$path;
}

function full_upload_path($path){
    return UPLOAD_PATH.'/'.$path;
}

function formatted_date($date){
    $str = substr($date, 0, 10);
    $strArray = explode('-',$str);
    $str = $strArray[2] . '/'.$strArray[1] . '/'.$strArray[0];
    return $str;
}

function clean_json($json){
    // for($i = 0; $i <= 31; ++$i){ $json = str_replace(chr($i), "", $json);}
    // $json = str_replace(chr(127),"",$json);
    // if(0 === strpos(bin2hex($json), 'efbbbf')){$json = substr($json,3);}
    // $json = stripslashes($json);
    $json = str_replace('&quot;','"',$json);
    return $json;
}

function array_to_json($array,$exclude=null){
    if(!is_null($exclude)){
        $array = exclude_and_regenerate($array,$exclude);
    }
    return json_encode($array);
}

function json_to_array($json){
    return json_decode(clean_json($json),true);
}

function initialize_empty($data, $exclude_param =null){
    $newData = [];
    $data = !is_null($exclude_param) ? exclude_and_regenerate($data, $exclude_param) : $data; 
    $columns = array_keys($data);
    // $values = array_values($data);
    foreach($data as $key=> $value){
        if(in_array($key, $columns)){
                $newData[$key] = "";
        }

    }
    return $newData;

}

function generate_route($path, $type=null, $id=null){
    return isset($type) && is_null($id) ? DASHBOARD_PATH.$path."/".$type :
        (isset($type) && isset($id) ? DASHBOARD_PATH.$path."/".$id."/".$type: DASHBOARD_PATH.$path);
}





?>