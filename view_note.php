<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
include 'db.php';
include 'crypto.php';

$id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];
$key = $_SESSION['encryption_key'];

$stmt = $conn->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  $decrypted = decryptData($row['content'], $key);
} else {
  die("Note not found or unauthorized access.");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Note</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="note-view">
  <h2><?php echo htmlspecialchars($row['title']); ?></h2>
  <pre><?php echo htmlspecialchars($decrypted); ?></pre>
  <a href="dashboard.php">⬅ Back</a>
</div>
</body>
</html>
