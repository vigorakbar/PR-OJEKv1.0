<?php
	require('includes/config.php');

	$id_active = $_GET["id_active"];
	$sql = "SELECT * FROM users WHERE ID=$id_active LIMIT 1";

	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
	    $username = $row["username"];
	}
	if (array_key_exists("ID",$_POST)){
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
		$query2 = "SELECT * FROM drivers WHERE ID = " . $_POST['ID'];
		$res = mysqli_query($con, $query2);
		$row = mysqli_fetch_assoc($res);
		$pass = $row['total_passangers']+1;
		$rating = $row['total_rating']+$_POST['rating'];
		$query_akhir = "UPDATE drivers SET "
			. "total_passangers = " . $pass . ", "
			. "total_rating = " . $rating
			. " WHERE ID = " . $_POST['ID'];
		mysqli_query($con,$query_akhir);
		echo $query_akhir;
		mysqli_close($con);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Make an order</title>
	<link rel="stylesheet" type="text/css" href="css/orderojek.css">
	<script src="js/validation.js"></script>
</head>
<style type="text/css">
	.menu a {
            text-decoration: none;
            color: inherit;
        }
</style>
<body>
	<div class="contentBox">
		<div class="mainHeader">
			<div class="header1">
					<div class="title"><span class="title green">PR</span>-<span class=" title red">OJEK</span></div>
					<div class="subtitle">wush... wush... ngeeeeeenggg...</div>
			</div>
			<div class="header2">
				<div class="username">Hi, <span class="username bold"><?php echo $username ?>!</span></div>
				<div class="logout"><a href="login.php">Logout</a></div>
			</div>
		</div>
		<div>
			<div class="menu active">ORDER</div>
			<div class="menu"><a href="history-order.php?id_active=<?php echo $id_active ?>">HISTORY</a></div>
			<div class="menu"><a href="profile.php?id_active=<?php echo $id_active ?>">MY PROFILE</a></div>
		</div>
		<h1>MAKE AN ORDER</h1>
		<div id="box_aktif">
			<div class="stepBox active">
				<div class="number">1</div>
				<div class="step">Select Destination</div>
			</div>
			<div class="stepBox">
				<span class="number">2</span>
				<div class="step">Select a Driver</div>
			</div>
			<div class="stepBox">
				<span class="number">3</span>
				<div class="step">Complete your order</div>
			</div>
			<form action="selectdriver.php?id_active=<?php echo $id_active ?>" id="menuAwal" name="menuAwal" method="POST" class="form" onsubmit="return validateOrder()">
				<div class="formBox">
					<label for="pick" class="labelBox">Picking Point</label>
					<input id="pick" class="inputBox" type="text" name="pickingPoint" id="pickingPoint">
				</div>
				<div class="formBox">
					<label for="destiny" class="labelBox">Destination</label>
					<input id="destiny" class="inputBox" type="text" name="destination" id="destination">
				</div>
				<div class="formBox">
					<label for="preferred" class="labelBox">Preferred Driver</label>
					<input id="preferred" class="inputBox" type="text" name="preferredDriver" placeholder="(optional)">
				</div>
				<div class="next">
					<input type="submit" name="next" value="NEXT">
				</div>
			</form>
			
		</div>
	</div>	
</body>
</html>