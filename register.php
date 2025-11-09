<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Register</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="register">Register</button>
    <p>Already have an account? <a href="login.php">Login</a></p>
</form>

<?php
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<p style='color:red;'>Email already registered.</p>";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color:green;'>Registered successfully! <a href='login.php'>Login</a></p>";
        }
    }
}
?>
</div>
</body>
</html>
