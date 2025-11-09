<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM notes WHERE id='$id'");
$note = mysqli_fetch_assoc($res);
$data = base64_decode($note['content']);
$iv_length = openssl_cipher_iv_length(CIPHER_METHOD);
$iv = substr($data, 0, $iv_length);
$encrypted_text = substr($data, $iv_length);
$decrypted = openssl_decrypt($encrypted_text, CIPHER_METHOD, ENCRYPTION_KEY, 0, $iv);


if (isset($_POST['update'])) {
   $new = $_POST['note'];
$iv = random_bytes(openssl_cipher_iv_length(CIPHER_METHOD));
$encrypted = openssl_encrypt($new, CIPHER_METHOD, ENCRYPTION_KEY, 0, $iv);
$final = base64_encode($iv . $encrypted);
mysqli_query($conn, "UPDATE notes SET content='$final' WHERE id='$id'");

    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Note</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
<h2>Edit Note</h2>
<form method="POST">
    <textarea name="note" required><?= htmlspecialchars($decrypted) ?></textarea>
    <button name="update">Update</button>
</form>
<a href="dashboard.php">Back</a>
</div>
</body>
</html>
