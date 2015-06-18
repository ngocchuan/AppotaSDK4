<!-- 
Test function for IPN card payment run in localhost
In browser use: http://203.162.69.22/share/ServerGameSDK4/ipn_test.php
 -->

<?php

include 'ipn.php';

function test_card_ipn() {
    $fields = array('transaction_id' => 'C7454F92BC2B269A', 
                    'transaction_type' => 'CARD',
                    'status' => '1',
                    'sandbox' => '0',
                    'amount' => '10000',
                    'state'  => '',
                    'target' => "username:XuanXuXu|userid:2618078",
                    'currency' => "VND",
                    'country_code' => "VN", 
                    'card_code' => "ABCDEF",
                    'card_serial' => "123456",
                    'card_vendor' => "mobifone", 
                    'hash'       => "55be7cfd9517ad9217f8968e7ee268b8",);
    print implode(" ",call_curl_post("http://203.162.69.22/share/ServerGameSDK4/ipn.php", $fields));
}

test_card_ipn();
?>
