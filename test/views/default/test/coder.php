<?php

require_once './GoogleAuthenticator.php';

$ga = new GoogleAuthenticator();

$secret = $ga->createSecret();

$name = $_GET['user'];
$qrCodeUrl = 'otpauth://totp/'.$name.'@Elgg?secret='.$secret;

echo $secret.';'.$qrCodeUrl;
//$res = array();
//$res['secret'] = $secret;
//$res['url'] = $qrCodeUrl;
//
//echo json_encode($res);

//
//
//$oneCode = $ga->getCode($secret);
//echo "Checking Code '$oneCode' and Secret '$secret':\n";
//
//$checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
//if ($checkResult) {
//    echo 'OK';
//} else {
//    echo 'FAILED';
//}

?>