<?php

function get_game_user_model($appota_user_id, $appota_user_name, $server_id){
    $query = "SELECT * FROM game_user WHERE `appota_user_id` = '".$appota_user_id."' AND `appota_user_name` = '".$appota_user_name."' AND `server_id` = '".$server_id."' LIMIT 1";        
    $list_user = select_db($query);
    $result = array();
    // Already be user
    if (count($list_user) > 0) {
        $user_info = $list_user[0];        
        $result = array(
            "game_user_id" => $user_info[0], 
            "game_user_name" => $user_info[1],
            "server_id" => $user_info[4], 
            "level" => $user_info[5],            
            "gold" => $user_info[6], 
            "diamond" => $user_info[7],                                
            "is_vip" => $user_info[8],                                                                  
            "error_code" => 0
        );
    }
    else { 
        $result = array(
            "error_code" => 1,
            "message" => 'Creat new user'
        );             
    }
    return $result;
}

function create_game_user_model($game_user_name, $appota_user_id, $appota_user_name, $server_id) {
      // Generate game_user_name
      $query = sprintf("INSERT INTO `game_user`(`game_user_name`, `appota_user_id`, `appota_user_name`, `server_id` ) VALUES ('%s', '%s', '%s','%s')", $game_user_name, $appota_user_id, $appota_user_name, $server_id);
      $data = query_db($query);
      $result = array();
      if(!$data) {
          $result = array(
              "error_code" => 1
          );
      }
      else {
          $result = get_game_user_model($appota_user_id, $appota_user_name,$server_id);
      }
      return $result;
      
}

function update_game_user($diamond, $game_user_id){
    $query = "UPDATE `game_user` SET `diamond` = ".$diamond. " WHERE game_user_id = ".$game_user_id;
    $data = query_db($query);
    $result = array();
    if(!$data) {
          $result = array(
              "error_code" => 1
          );
      }
      else {
          $result = array(
              "error_code" => 0
          );
      }
}
?>