<?php
    function find_data($table, $columns, $joinQuery=null, $whereQuery=null, $sanitize=true){
        global $db;
        $sql = generateSelectSql($table, $columns, $db, $joinQuery, $whereQuery);
        // $sql = "SELECT * FROM foods INNER JOIN files on foods.file_id = files.id ";
        $result = mysqli_query($db, $sql);
        if(!confirm_result($result)){
            return false;
        }
        if($result->num_rows === 1 ){
            // Return either sanitize or unsanitized version of the fetched record
            // unsanitized version is very useful when record contains json str
            // Sanitize record with JSON str throughs up error when decoding the string
            return $sanitize ? sanitize_html(mysqli_fetch_assoc($result)) : mysqli_fetch_assoc($result);
        }
        return $result; //result object
        
    }

    function insert_data($table, $data, $exclude =null){
        global $db;
       $sql =  generateInsertSql($table, $data, $db, $exclude);
        $result = mysqli_query($db, $sql);
        return exit_db("Error Occurred While Inserting Data",$result, $db); //result is always true here
    
    }

    function delete_data($table, $data){
        global $db;
        $sql = generateDeleteSql($table, $data, $db);
        $result = mysqli_query($db, $sql);
        return exit_db("Error Occurred While Deleting Data",$result, $db); //result is always true here
    }

    function find_data_by_id($table, $columns, $id){
        global $db;
        $sql = generateSelectById($table, $id, $columns, $db);
        $result = mysqli_query($db, $sql);
        confirm_result($result);
        $data = mysqli_fetch_assoc($result); //fetch Food
        // sanitize Food
        return sanitize_html($data);
    }

   
    function update_data($table, $data, $exclude, $limit=1){
        global $db;
        $sql = generateUpdateSql($table, $data, $db, $exclude, $limit);
        $result = mysqli_query($db, $sql);
        return exit_db("Error Occurred While Updating Data",$result, $db); //result is always true here
    }
    
    function insert_multiple_data($table, $data){
        global $db;
        $indexEl = array_shift($data);
        $columns = array_keys($indexEl);
        $str = "INSERT INTO {$table} (";
        $str.= merge_columns_to_str($columns); //convert columns to string
        $str.=")";
        $str.=" VALUES ";
        array_unshift($data, $indexEl);
        foreach ($data as $value) {
            $str.="( ";
             //convert values to string and escape special characters
            $str.= merge_and_escape($value,$db);
            $str.="), ";
        }

        $str = rtrim($str, ', ');

        $result = mysqli_query($db, $str);
        return exit_db("Error Occurred While Inserting Data",$result, $db);
        
        // array_unshift($data, $indexEl);
       


    }



?>