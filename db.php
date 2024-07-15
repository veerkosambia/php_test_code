<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";
$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
}
