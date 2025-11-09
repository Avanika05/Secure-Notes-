<?php
if (!defined('CIPHER_METHOD')) {
    define('CIPHER_METHOD', 'AES-256-CBC');
}
if (!defined('ENCRYPTION_KEY')) {
    define('ENCRYPTION_KEY', 'ThisIsASecretKey123!'); // replace with your key
}

function encryptData($data, $key = ENCRYPTION_KEY) {
    $iv = random_bytes(openssl_cipher_iv_length(CIPHER_METHOD));
    $encrypted = openssl_encrypt($data, CIPHER_METHOD, $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function decryptData($data, $key = ENCRYPTION_KEY) {
    $decoded = base64_decode($data);
    $iv_length = openssl_cipher_iv_length(CIPHER_METHOD);
    $iv = substr($decoded, 0, $iv_length);
    $encrypted_text = substr($decoded, $iv_length);
    return openssl_decrypt($encrypted_text, CIPHER_METHOD, $key, 0, $iv);
}
?>
