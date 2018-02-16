<?php

$DBservername = "localhost";
$DBusername = "root";
$DBpassword = "";

$conn = new mysqli($DBservername, $DBusername, $DBpassword, "pr-ojek");

if ($conn->connect_error) {
    echo "Server is die";
    die("Connection failed: " . $conn->connect_error);
}

?>