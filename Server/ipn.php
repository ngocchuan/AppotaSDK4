<?php

define('CLIENT_KEY', '668a3fa96a86942252b31221a93b6898055794d20');
define('API_KEY', 'K-A174260-U00000-E1ZSTS-A95DE87202F4C94B');
define('CLIENT_SECRET', '2dd6162d8e9ec966af62e66bb247302f055794d20');

include 'common.php';
include 'Model/connect_db.php';
include 'Model/transaction_model.php';
include 'Model/package_model.php';
include 'Model/user_model.php';

function appota_payment($fields) {
        $status             = $fields['status'];
        $sandbox            = $fields['sandbox'];
        $trans_id           = $fields['transaction_id'];
        $trans_type         = $fields['transaction_type'];
        $amount             = $fields['amount'];
        $currency           = $fields['currency'];
        $state              = $fields['state'];
        $target             = $fields['target'];
        $country_code       = $fields['country_code'];
        $hash               = $fields['hash'];
        
        // check transaction status
        if ( $status != 1) {
            $result = array(
                    "error_code" => "1",
                    "message" => "Transaction fail"
            );
            // LOG
            file_put_contents('log.txt', $fields.": ".json_encode($result).PHP_EOL, FILE_APPEND);
            return $result;
        }
        
        switch($trans_type){
            case 'CARD':
                $card_code          = $fields['card_code'];
                $card_serial        = $fields['card_serial'];
                $card_vendor        = $fields['card_vendor'];
                $check_hash = md5( $amount . $card_code . $card_serial . $card_vendor . $country_code .
                                $currency . $sandbox . $state . $status . $target . $trans_id.
                                $trans_type . CLIENT_SECRET );
                break;
            case 'SMS':
                $phone              = $fields['phone'];
                $message            = $fields['message'];
                $code               = $fields['code'];     
                $check_hash = md5( $amount . $code . $country_code .
                                $currency . $message . $phone . $sandbox . $state . $status . $target . $trans_id.
                                $trans_type . CLIENT_SECRET );
                break;
            case 'APPLE_ITUNES':
                $productid              = $fields['productid'];    
                $check_hash = md5( $amount . $code . $country_code .
                                $currency . $productid . $message . $phone . $sandbox . $state . $status . $target . $trans_id.
                                $trans_type . CLIENT_SECRET );
                break;
            default :
                $check_hash = md5( $amount . $country_code .
                                $currency . $sandbox . $state . $status . $target . $trans_id.
                                $trans_type . CLIENT_SECRET );
                break;
        }
        $result = array();
        // check hash                    
        if ( $check_hash != $hash ){
            $result = array(
                "error_code" => "2",
                "message" => "Check hash fail"
            );
            // LOG
            file_put_contents('log.txt', $fields.": ".json_encode($result).PHP_EOL, FILE_APPEND);
            return $result;
        }
                        
        // If hash is ok, verify transaciton
        if (!verify_appota_transaction($trans_id, $amount, $state, $target)){
            $result = array(
                "error_code" => "3",
                "message" => "Verify transaction fail"
            );
            // LOG
            file_put_contents('log.txt', $fields.": ".json_encode($result).PHP_EOL, FILE_APPEND);
            return $result;
        }         
        // Check exist transaction
        $tracking_result = get_transaction($trans_id);
        if ($tracking_result['error_code'] == 0) {
            $result = array(
                "error_code" => "4",
                "message" => "Exist transaction"
            );
            // LOG
            file_put_contents('log.txt', $fields.": ".json_encode($result).PHP_EOL, FILE_APPEND);
            return $result;
        }
        // If function is verified proceed gold increment based on "amount", "state"   
        $result = increase_resource_user($trans_id, $trans_type, $amount, $target, $state);
        // LOG
        file_put_contents('log.txt', $fields.": ".json_encode($result).PHP_EOL, FILE_APPEND);
        return $result;
}

// Verify transaction_id, amount, state, target with Appota Confirm API
function verify_appota_transaction($transaction_id, $amount, $state, $target) {
    $url = sprintf('https://pay.appota.com/payment/confirm?api_key=%s&lang=en', API_KEY);
    $fields = array('transaction_id' => $transaction_id);
    $result = call_curl_post($url, $fields);

    if ($result['status'] == 1 and $result['data']['amount'] == $amount and $result['data']['state'] == $state and $result['data']['target']) {
        return true;
    }
    return false;
}

function increase_resource_user($transaction_id, $transaction_type, $amount, $target, $state){
    // Get info package
    $package_info = get_package($transaction_type, $amount);
    if($package_info['error_code'] == 1){
        $result = array(
            "error_code" => "5",
            "message" => "Not has package"
        );
        // LOG
        file_put_contents('log.txt', $fields.": ".json_encode($result).PHP_EOL, FILE_APPEND);
        return $result;
    }
    // Get user info
    $tmp = explode('|', $target);
    $appota_uset_id = explode(':', $tmp[1])[1];
    $appota_uset_name = explode(':', $tmp[0])[1];
    $server_id = explode("_", $state)[0];
    $user_info = get_game_user_model($appota_uset_id, $appota_uset_name, $server_id);
    if($user_info['error_code'] == 1){
        $result = array(
            "error_code" => "6",
            "message" => "Not has user"
        );
        // LOG
        file_put_contents('log.txt', $fields.": ".json_encode($result).PHP_EOL, FILE_APPEND);
        return $result;
    }
    // Update user
    $user_info['diamond'] += $amount/$package_info['exchange_rate'];
    $update_user = update_game_user($user_info['diamond'], $user_info['game_user_id']);
    // Insert transaction tracking
    $transaction_tracking = insert_transaction_tracking($transaction_id, $user_info['game_user_id'], $server_id, $package_info['package_id']);
    // LOG
    file_put_contents('log.txt', $fields.": ".json_encode($result).PHP_EOL, FILE_APPEND);
    return $user_info;
}

if (isset($_POST["transaction_id"])){
    die(json_encode(appota_payment($_POST)));
}

?>