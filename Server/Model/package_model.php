<?php

function get_package($transaction_type){
    $query = "SELECT * FROM transaction_package WHERE `transaction_type` = '".$transaction_type."' LIMIT 1";        
    $list_package = select_db($query);
    $result = array();    
    // Already be user
    if (count($list_package) > 0) {
        $package_info = $list_package[0];        
        $result = array(
            "package_id" => $package_info[0],
            "exchange_rate" => $package_info[3],                                                            
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
?>