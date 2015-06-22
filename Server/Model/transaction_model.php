<?php

function get_transaction($transaction_id){
    $query = "SELECT * FROM transaction_tracking WHERE `transaction_id` like '".$transaction_id."'";        
    $list_tracking = select_db($query);
    $result = array();    
    // Already be user
    if (count($list_tracking) > 0) {
        $tracking_info = $list_tracking[0];        
        $result = array(
            "transaction_id" => $tracking_info[0], 
            "game_user_id" => $tracking_info[1],
            "server_id" => $tracking_info[2], 
            "package_id" => $tracking_info[3],
            "error_code" => "0"
        );
    }
    else {  // New user   
        $result = array(
            "error_code" => "1"           
        );             
    }
    return $result;
}

function insert_transaction_tracking($transaction_id, $game_user_id, $server_id, $package_id) {
      // Generate game_user_name
      $query = sprintf("INSERT INTO `transaction_tracking`(`transaction_id`, `game_user_id`, `server_id`, `package_id` ) VALUES ('%s', '%s', '%s','%s')", $transaction_id, $game_user_id, $server_id, $package_id);
      $data = query_db($query);
      $result = array();
      if(!$data) {
          $result = array(
              "error_code" => "1"
          );
      }
      else {
          $result = array(
              "error_code" => "0"
          );
      }
      return $result;
}
?>