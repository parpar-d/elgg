<?php
require_once './GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$secret = $ga->createSecret();
$name = $_GET['user'];
$qrCodeUrl = 'otpauth://totp/'.$name.'@Elgg?secret='.$secret;
echo $secret.';'.$qrCodeUrl;
?>