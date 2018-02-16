<?php
require("includes/config.php");

if (!empty($_REQUEST['u'])){
	$toCheck = $_REQUEST['u'];
	$sql = "SELECT * FROM users WHERE username = '$toCheck'";
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        echo "false";
    }
    else {
        echo "true";
    }
}

if (!empty($_REQUEST['e'])){
	$toCheck = $_REQUEST['e'];
	$sql = "SELECT * FROM users WHERE email = '$toCheck'";
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        echo "false";
    }
    else {
        echo "true";
    }
}

?>