<?php
session_start();
include 'db.php';
include 'crypto.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_note'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = $_POST['note'];

    $encrypted_content = encryptData($content);

    $stmt = $conn->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
if (!$stmt) {
    die("Database error: " . $conn->error);
}
$stmt->bind_param("iss", $user_id, $title, $encrypted_content);
$stmt->execute();

    $stmt->close();
}


$res = mysqli_query($conn, "SELECT * FROM notes WHERE user_id='$user_id' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure Notes Vault</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('background.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .container {
            width: 70%;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        textarea, input {
            width: 100%;
            margin: 8px 0;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            resize: none;
            word-wrap: break-word;
            white-space: pre-wrap;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .note {
            background: #f5f5f5;
            margin: 15px 0;
            padding: 15px;
            border-radius: 10px;
            word-wrap: break-word;
            white-space: pre-wrap;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .actions a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        .delete-account {
            background-color: #d9534f;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .delete-account:hover {
            background-color: #b52b27;
        }
        .logout {
            display: inline-block;
            margin-top: 15px;
            color: #444;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Welcome to Secure Notes Vault</h2>

    <form method="POST">
        <input type="text" name="title" placeholder="Note Title" required>
        <textarea name="note" placeholder="Write your note here..." required></textarea><br>
        <button type="submit" name="add_note">Add Note</button>
    </form>

    <hr>

    <h3>Your Notes</h3>

    <?php while ($row = mysqli_fetch_assoc($res)): ?>
        <?php
        $decrypted = decryptData($row['content']);
        ?>
        <div class="note">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($decrypted)) ?></p>

            <div class="actions">
                <a href="edit_note.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete_note.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this note?')">Delete</a>
            </div>
        </div>
    <?php endwhile; ?>

    <br>
    <form action="logout.php" method="POST">
    <button type="submit" class="logout-btn">Logout</button>
  </form>
    <form action="delete_account.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete your account and all notes?');">
        <button type="submit" class="delete-account">Delete Account</button>
    </form>
    <div class="logout-box">
  
</div>

</div>
</body>
</html>
