<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: register.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$stmt1 = $conn->prepare("DELETE FROM notes WHERE user_id = ?");
$stmt1->bind_param("i", $user_id);
$stmt1->execute();

$stmt2 = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt2->bind_param("i", $user_id);
$stmt2->execute();

session_unset();
session_destroy();

header("Location: register.php");
exit();
?>
