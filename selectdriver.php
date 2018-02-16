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
	<title>Make an order</title>
	<link rel="stylesheet" type="text/css" href="css/orderojek.css">
	<script src="js/order.js"></script>
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
			<div class="stepBox">
				<div class="number">1</div>
				<div class="step">Select Destination</div>
			</div>
			<div class="stepBox active">
				<span class="number">2</span>
				<div class="step">Select a Driver</div>
			</div>
			<div class="stepBox">
				<span class="number">3</span>
				<div class="step">Complete your order</div>
			</div>
			<div class="roundedBox preferred">
			<span class="header3"><b>PREFERRED DRIVERS:</b></span>
			<br><br>
			<div class="header3 paragraph">
				<?php
					$con = mysqli_connect('127.0.0.1','root','','pr-ojek');
					$prefer_driver = $_POST['preferredDriver'];
					$query = "SELECT * FROM drivers NATURAL JOIN users WHERE name like '%".$prefer_driver."%' AND ID != " . $id_active . " ORDER BY total_rating/total_passangers LIMIT 1";
					$tmp = mysqli_query($con, $query);
					$exist = $prefer_driver !== "" && mysqli_num_rows($tmp) == 1;
					$res = mysqli_fetch_assoc($tmp);
					if ($exist){
						$image = '<img src="' . $res['image'] . '" class="gambar">';
						echo $image.'<div class="header3 lain">' . $res['name'] . '</div>';
						echo '<div class="header3 lain2"> ☆'.$res['total_rating']/($res['total_passangers'] > 0 ? $res['total_passangers'] : 1) . ' (' . $res['total_passangers'] . ' votes) </div><br>';
						echo '<form action="' . $urlink . '" id="menuDua" name="menuDua" method="POST">';
						echo 	'<div class="choosen">';
						echo		'<input type="submit" name="choosen" value="I CHOOSE YOU!">';
						echo		'<input type="hidden" name="ID" value="' . $res['ID'] . '">';
						echo		'<input type="hidden" name="pickingPoint" value="' . $_POST['pickingPoint'] . '">';
						echo		'<input type="hidden" name="destination" value="' . $_POST['destination'] . '">';
						echo		'<input type="hidden" name="image" value="' . $res['image'] . '">';
						echo		'<input type="hidden" name="username" value="' . $res['username'] . '">';
						echo		'<input type="hidden" name="name" value="' . $res['name'] . '">';
						echo	'</div>';
						echo '</form>';
					} else {
						echo "NOTHING TO DISPLAY :(";
					}
					mysqli_close($con);
				 ?>
			</div>
		</div>
		<div class="roundedBox others">
			<div class="header3"><b>OTHER DRIVERS:</b></div>
			<div class="header3 paragraph">
				<?php
					$con = mysqli_connect('127.0.0.1','root','','pr-ojek');
					if ($prefer_driver !== ""){
						$query = "SELECT * FROM drivers NATURAL JOIN users NATURAL JOIN driver_locations WHERE name NOT like '%".$prefer_driver."%' AND location = '" . $_POST['pickingPoint'] . "' AND ID != " . $id_active . " ORDER BY total_rating/total_passangers";
					} else {
						$query = "SELECT * FROM drivers NATURAL JOIN users NATURAL JOIN driver_locations WHERE location = '" . $_POST['pickingPoint'] . "' AND ID != " . $id_active . " ORDER BY total_rating/total_passangers";
					}
					$tmp = mysqli_query($con, $query);
					$exist = mysqli_num_rows($tmp) > 0;
					if ($exist){
						while ($res = mysqli_fetch_assoc($tmp)){
							$image = '<img src="' . $res['image'] . '" class="gambar">';
							echo $image.'<div class="header3 lain">' . $res['name'] . '</div>';
							echo '<div class="header3 lain2"> ☆'.$res['total_rating']/($res['total_passangers'] > 0 ? $res['total_passangers'] : 1) . ' (' . $res['total_passangers'] . ' votes) </div><br>';
							echo '<form action="' . $urlink . '" id="menuDua" name="menuDua" method="POST">';
							echo 	'<div class="choosen">';
							echo		'<input type="submit" name="choosen" value="I CHOOSE YOU!">';
							echo		'<input type="hidden" name="ID" value="' . $res['ID'] . '">';
							echo		'<input type="hidden" name="pickingPoint" value="' . $_POST['pickingPoint'] . '">';
							echo		'<input type="hidden" name="destination" value="' . $_POST['destination'] . '">';
							echo		'<input type="hidden" name="image" value="' . $res['image'] . '">';
							echo		'<input type="hidden" name="username" value="' . $res['username'] . '">';
							echo		'<input type="hidden" name="name" value="' . $res['name'] . '">';
							echo	'</div>';
							echo '</form>';
							echo '<br><br><br>';
						}
					} else {
						echo '<br>';
						echo "NOTHING TO DISPLAY :(";
						echo '<br>';
					}
					mysqli_close($con);					
				?>
			</div>
		</div>
	</div>	
</body>
</html>