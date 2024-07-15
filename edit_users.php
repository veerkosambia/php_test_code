<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

if (isset($_POST['edit'])) {
    $user_id = intval($_POST['user_id']);

    $sql = "SELECT * FROM tbl_users WHERE user_id='$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    }
}

if (isset($_POST['update'])) {
    $user_id = intval($_POST['user_id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);

    $sql = "UPDATE tbl_users SET first_name='$first_name', last_name='$last_name', user_name='$user_name' WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
    <h2>Edit User</h2>
    <form action="" method="post">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
        <label for="user_name">Username:</label>
        <input type="text" name="user_name" id="user_name" value="<?php echo htmlspecialchars($user['user_name']); ?>" required>
        <button type="submit" name="update">Update</button>
    </form>
</body>

</html>