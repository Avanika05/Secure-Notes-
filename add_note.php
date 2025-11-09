<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

include 'db.php';
include 'crypto.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $note = $_POST['note']; 

    
    $encrypted_content = encryptData($note, $_SESSION['encryption_key']);
    $user_id = $_SESSION['user_id'];

    
    $stmt = $conn->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $encrypted_content);
    $stmt->execute();

    
    header("Location: dashboard.php?msg=Note+added+successfully");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Note - Secure Notes Vault</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
  <h2>Add New Note</h2>

  <form method="POST" class="add-note">
    <input type="text" name="title" placeholder="Note Title" required>
    <textarea name="note" placeholder="Write your note here..." required></textarea>
    <button type="submit">Add Note</button>
  </form>

  <p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
