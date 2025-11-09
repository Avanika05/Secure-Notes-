<?php
$conn = mysqli_connect("localhost", "root", "", "secure_notes");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


define('ENCRYPTION_KEY', 'secret'); 
define('CIPHER_METHOD', 'AES-128-CTR');
?>
