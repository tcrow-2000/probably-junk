<?php
include_once('Mail.php');

function mailRegistration($to, $regCode) {
   
    $mObj = &Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'auth' => true,
        'username' => 'xxx@gmail.com',
        'password' => 'xxx'
    ));
    $headers['From']    = '<registration@rockalist.com>';
    $headers['To']      = '<'.$to.'>';
    $headers['Subject'] = 'Welcome to RockAList!';
    $body = "http://localhost:8080/rockalist/registration/complete_registration.php?reg_code=$regCode";

    return $mObj->send($to, $headers, $body);
}
?>