<?php
	require('includes/config.php');
	$id_active = $_GET["id_active"];
	$sql = "SELECT * FROM users WHERE ID=$id_active LIMIT 1";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		$username = $row["username"];
	}
	$urlink = "completeorder.php?id_active=" . $id_active;	
?> 

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/orderojek.css">
	<script src="js/order.js"></script>
</head>
<body>
    <?php
        date_default_timezone_set("Asia/Jakarta");
        $t = time();
        $con = mysqli_connect('127.0.0.1','root','','pr-ojek');
        $res = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(*) FROM transaction"));
        $count = $res['COUNT(*)'];
        $query = "INSERT INTO transaction (ID, id_user, id_driver, rating, comment, time, picking_point, destination) VALUES("
            . "'" . ($count+1) . "', "
            . "'" . $_GET['id_active'] . "', "
            . "'" . $_POST['ID'] . "', "
            . "'" . $_POST['rating'] . "', "
            . "'" . $_POST['comment'] . "', "
            . "'" . date("Y-m-d H:i:s",$t) . "', "
            . "'" . $_POST['pickingPoint'] . "', "
            . "'" . $_POST['destination'] . "')";
        mysqli_query($con,$query);            
        mysqli_close($con);
    ?>
    <div action="orderojek.php?id_active=<?php echo $id_active ?>" class="form">
        <input type="hidden" name="choosen" value="I CHOOSE YOU!">
    </div>
</body>
</html>