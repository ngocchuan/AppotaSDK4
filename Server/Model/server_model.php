<?php

function get_server_by_id($server_id){
    $query = "SELECT * FROM `server` WHERE `server_id` = ".$server_id;
    $data  = select_db($query);
    $result = array();
    if(count($data)>0){
        $server_info = $data[0];  
        $result = array(
        'server_id' => $server_info[0],
        'server_name' => $server_info[1],
        "error_code" => "0"
        );
    }
    else {
        $result = array(
            "error_code" => "1",
            "message" => 'Creat new user'
        );  
    }
    return $result;
}

function get_list_server_model() {
    $query = "SELECT * FROM `server`";
    $list_server = select_db($query);
    $result = array();
    if (!$list_server) {
       throw new My_Db_Exception('Database error: ' . mysql_error());
    }   
    foreach ($list_server as $key => $value) {
        $result[] = array(
            'server_id' => $value[0],
            'server_name' => $value[1]
        );
    }
    return $result;
}
?>

