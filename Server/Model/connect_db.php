<?php

function connect_db() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "appota_game_test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;    
}

function query_db($query) {
    $conn = connect_db();
    $result = $conn->query($query);
    $list_server = array();
    if (!$result) {
       throw new My_Db_Exception('Database error: ' . mysql_error());
    }         
    $conn->close();    
    return $result;    
}

function select_db($query) {
    $result = query_db($query);
    $list_server = array();    
    while($row = $result->fetch_row()){
        $list_server[] = $row;
    }
    $result->close();   
    return $list_server;
}

?>