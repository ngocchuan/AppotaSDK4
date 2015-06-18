<?php

include 'Model/connect_db.php';
include 'Model/user_model.php';
include 'Model/server_model.php';
include 'common.php';

function get_list_server(){
    $result = get_list_server_model();
    // LOG
    file_put_contents('log.txt', json_encode($result).PHP_EOL, FILE_APPEND);
    return $result;
}

function get_game_user($appota_access_token, $appota_user_id, $appota_user_name, $server_id) {
    // Check apppota user
    $verify_result =  verify_appota_user($appota_access_token, $appota_user_id, $appota_user_name);
    $result = array();
    if (!$verify_result) {
        $result = array(
            "error_code" => "2",
            "message" => "Invalid Appota User"
        );
    }
    else {
        $result = get_game_user_model($appota_user_id, $appota_user_name, $server_id);
    }
    // LOG
    file_put_contents('log.txt', json_encode($result).PHP_EOL, FILE_APPEND);
    
    return $result;
}

function create_game_user($appota_access_token, $game_user_name, $appota_user_id, $appota_user_name, $server_id) {
    $result = array();
    // Check null
    if($appota_access_token == null || $game_user_name == null || $appota_user_id == null || 
            $appota_user_name == null || $server_id == null){
        $result = array(
            "error_code" => "1",
            "message" => "Params null"
        );
        // LOG
        file_put_contents('log.txt', json_encode($result).PHP_EOL, FILE_APPEND);
        return $result;
    }
    // Check exist user
    $user_info = get_game_user($appota_access_token, $appota_user_id, $appota_user_name, $server_id);
    if($user_info['error_code'] == 0){
        $result = array(
            "error_code" => "2",
            "message" => "User exist"
        );
        // LOG
        file_put_contents('log.txt', json_encode($result).PHP_EOL, FILE_APPEND);
        return $result;
    }
    // Check invalid
    if($user_info['error_code'] == 2){
        $result = array(
            "error_code" => "3",
            "message" => "Invalid Appota User"
        );
        // LOG
        file_put_contents('log.txt', json_encode($result).PHP_EOL, FILE_APPEND);
        return $result;
    }
    // Check server id
    $server_info = get_server_by_id($server_id);
    if($server_info['error_code'] == 1){
        $result = array(
            "error_code" => "4",
            "message" => "This server is not exist"
        );
        // LOG
        file_put_contents('log.txt', json_encode($result).PHP_EOL, FILE_APPEND);
        return $result;
    }
    
    $result = create_game_user_model($game_user_name, $appota_user_id, $appota_user_name, $server_id);
    // LOG
    file_put_contents('log.txt', json_encode($result).PHP_EOL, FILE_APPEND);
    return $result;
}

// Verify user with Appota User API
function verify_appota_user($appota_access_token, $appota_userid, $appota_username) {
    $url = sprintf('https://api.appota.com/game/get_user_info?access_token=%s', $appota_access_token);
    $data = call_curl_get($url, null);
    if(!$data['status'])
        return false;
    else {
        if($data["data"]["username"] == $appota_username & $data["data"]["user_id"] == $appota_userid)
            return true;
        else
            return false;
    }
    
}

$data = urldecode(file_get_contents("php://input"));
$object = array();
if ($data) {
    parse_str($data, $object);
}
else {
    if ($_GET) {
        $object = $_GET;
    }
    if ($_POST) {
        $object = $_POST;
    }
}
if (isset($object["action"]) and $object["action"] == "get_list_server") {
    die(json_encode(get_list_server()));
}

if (isset($object["action"]) and $object["action"] == "get_game_user") {
    die(json_encode(get_game_user($object["appota_access_token"], $object["appota_user_id"], $object["appota_user_name"], $object["server_id"])));
}

if (isset($object["action"]) and $object["action"] == "create_game_user") {
    die(json_encode(create_game_user($object["appota_access_token"], $object["game_user_name"], $object["appota_user_id"], $object["appota_user_name"], $object["server_id"])));
}
?>