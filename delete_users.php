<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

if (isset($_POST['delete'])) {
    $user_id = intval($_POST['user_id']);

    // Prepare a DELETE statement
    $sql = "DELETE FROM tbl_users WHERE user_id = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error deleting user: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Redirect to users.php if accessed without delete action
header("Location: users.php");
exit();
