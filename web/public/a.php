<?php
$text = 'After all, tomorrow is another day.';
$key = pack('H*', 'e10adc3949ba59abbe56e057f20f883e');  //md5('123456')
$iv   = pack('H*', '1234567890abcdef1234567890abcdef');

$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_CBC, $iv);
$encrypted = base64_encode($encrypted);
var_dump($encrypted);

$dncrypted = base64_decode($encrypted);
$dncrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $dncrypted, MCRYPT_MODE_CBC, $iv);
$dncrypted = trim($dncrypted);
var_dump($dncrypted);