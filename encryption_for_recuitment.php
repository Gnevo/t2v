<?php

$key_value = "!@#$%^&*";
$plain_text = $_REQUEST['val'];       
echo $encrypted_text = base64_encode(mcrypt_ecb(MCRYPT_DES, $key_value, $plain_text, MCRYPT_ENCRYPT)); 
//echo "<br>";
//echo $decrypted_text = mcrypt_ecb(MCRYPT_DES, $key_value, base64_decode($encrypted_text), MCRYPT_DECRYPT); 
?>
