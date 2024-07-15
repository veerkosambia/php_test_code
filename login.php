<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: users.php");
    exit();
}
require_once 'db.php';

if (isset($_POST['submit'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $user_pass = mysqli_real_escape_string($conn, $_POST['user_pass']);

    $sql = "SELECT * FROM tbl_users WHERE user_name='" . $user_name . "' AND user_pass='" . $user_pass . "'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();


        $_SESSION['user_id'] = $user['user_id'];
        header("Location: users.php");
        // exit();
    } else {
        echo "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form action="" method="post">
        <label for="user_name">Username:</label>
        <input type="text" name="user_name" id="user_name" required>
        <label for="user_pass">Password:</label>
        <input type="password" name="user_pass" id="user_pass" required>
        <button type="submit" name="submit">Login</button>
    </form>
    <a href="register.php">Register</a>
</body>

</html>