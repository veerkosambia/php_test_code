<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: users.php");
    exit();
}
require_once 'db.php';

if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $user_pass = mysqli_real_escape_string($conn, $_POST['user_pass']);

    $user_name_unique = mysqli_query($conn, "SELECT user_name FROM tbl_users WHERE user_name='" . $user_name . "'");
    $num_rows = mysqli_num_rows($user_name_unique);
    if ($num_rows = mysqli_num_rows($user_name_unique)) {
        echo "<script>alert('please select unique username');</script>";
    } else {

        $sql = "INSERT INTO tbl_users (first_name, last_name, user_name, user_pass, created_at) VALUES ('$first_name', '$last_name', '$user_name', '$user_pass', NOW())";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h2>Register</h2>
    <form action="" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>
        <label for="user_name">Username:</label>
        <input type="text" name="user_name" id="user_name" required>
        <label for="user_pass">Password:</label>
        <input type="password" name="user_pass" id="user_pass" required>
        <button type="submit" name="submit">Register</button>
    </form>
</body>
<a href="login.php">login</a>

</html>