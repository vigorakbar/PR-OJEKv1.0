<?php
	require('includes/config.php');
	$id_active = $_GET["id_active"];
	$sql = "SELECT * FROM users WHERE ID=$id_active LIMIT 1";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		$username = $row["username"];
	}
	$urlfinish = "orderojek.php?id_active=" . $id_active;	
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
			<div class="stepBox">
				<div class="number">1</div>
				<div class="step">Select Destination</div>
			</div>
			<div class="stepBox">
				<span class="number">2</span>
				<div class="step">Select a Driver</div>
			</div>
			<div class="stepBox active">
				<span class="number">3</span>
				<div class="step">Complete your order</div>
			</div>
		</div>
		<div class="image">
			<img src= <?php echo $_POST['image']; ?> class="circle">
		</div>
		<div class="form">
			<form action= <?php echo $urlfinish; ?> id="selesai" name="selesai" method="POST" onsubmit="return validateRating()">
				<div class="star">
					<span class="star-rating star-5">
						<input type="radio" name="rating" value="1"><i></i>
						<input type="radio" name="rating" value="2"><i></i>
						<input type="radio" name="rating" value="3"><i></i>
						<input type="radio" name="rating" value="4"><i></i>
						<input type="radio" name="rating" value="5"><i></i>
					</span>
				</div>
				<div class="header3"><b><?php echo '@'.$_POST["username"] ?></b></div>
				<div class="header3 subtitle"><?php echo $_POST["name"] ?></div>
				<textarea rows="2" cols="50" name="comment" id="comment" placeholder="Your comment..."></textarea>
				<button type="finish" name="finish">COMPLETE ORDER</button>
				<input type="hidden" name="ID" value= <?php echo $_POST['ID']; ?> >
				<input type="hidden" name="pickingPoint" value= <?php echo $_POST['pickingPoint']; ?> >
				<input type="hidden" name="destination" value= <?php echo $_POST['destination']; ?> >
				<input type="hidden" name="image" value= <?php echo $_POST['image']; ?> >
				<input type="hidden" name="username" value= <?php echo $_POST['username']; ?> >
				<input type="hidden" name="name" value= <?php echo $_POST['name']; ?> >
			</form>
		</div>
	</div>
</body>
</html>