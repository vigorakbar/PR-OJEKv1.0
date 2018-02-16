<?php
require('includes/config.php');

$id_active = $_GET["id_active"];
$sql = "SELECT * FROM users WHERE ID=$id_active LIMIT 1";

$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $username = $row["username"];
    $name = $row["name"];
    $email = $row["email"];
    $phone_number = $row["phone_number"];
    $driver = $row["driver"];
    $image = $row["image"];
}

if ($driver == 1){
    $sql = "SELECT total_rating, total_passangers FROM drivers WHERE ID=$id_active LIMIT 1";    
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $total_rating = $row["total_rating"];
        $total_passangers = $row["total_passangers"]; 
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/history.css">
        <style>
        .my-profile{
            width: 100%;
            margin: 0 auto;
        }
        .my-profile a, .location a {
            color: orange;
        }
        .my-profile .heading {
            float: left;
        }
        .my-profile .edit {
            float: right;
            margin-top: 15px;
            margin-right: 50px;
        }
        .my-profile .edit i {
            font-size: 2.2em;
        }
        .location{
            width: 100%;
            margin: 0 auto;
        }
        .location .heading {
            float: left;
        }
        .location .edit {
            float: right;
            margin-top: 15px;
            margin-right: 50px;
        }
        .location .edit i {
            font-size: 2.2em;
        }
        .profile-image {
            clear: right;
            margin: 0 auto;
        }
        .profile-image .rounded-picture {
            width: 120px;
            height: 120px;
            border-radius: 60px;
            margin-top: 10px;
        }
        .description {
            margin: 0 auto;
            margin-right: 50px;
            text-align: center;
        }
        .description p {
            margin: 1px auto;
        }
        .description h3 {
            margin: 8px auto;
        }
        .location-list{
            clear: right;
        }
        .location-list ul{
            padding-left: 0px;
        }
        .location-list ul li{
            text-align: left;
            clear: both;
            list-style-type: none;
        }
        .location-list ul li i {
            font-size: 20px;
        }
        .location-list ul li span {
            font-size:20px;
        }
        .menu a {
            text-decoration: none;
            color: inherit;
        }
        
        </style>

    </head>
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
				<div class="menu"><a href="orderojek.php?id_active=<?php echo $id_active ?>">ORDER</a></div>
				<div class="menu"><a href="history-order.php?id_active=<?php echo $id_active ?>">HISTORY</a></div>
				<div class="menu active">MY PROFILE</div>
            </div>
            <div class="my-profile">
                <h1 class="heading">MY PROFILE</h1>
                <a href="editprofile.php?id_active=<?php echo $id_active ?>"><span class="edit"><i class='material-icons'>mode_edit</i></span></a>
            </div>
            <div class="profile-image">
                <img class="rounded-picture" src="<?php echo $image ?>" alt="profile image">
            </div>
            <div class="description">
                <h3>@<?php echo $username ?></h3>
                <p><?php echo $name ?></p>
                <?php if ($driver == 1){
                    $rating = ($total_passangers == 0) ? 0 : $total_rating/$total_passangers; 
                    echo "<p>Driver | <span>". $rating . "</span> (". $total_passangers ." votes)</p>" ;
                } ?>
                <p><?php echo $email ?></p>
                <p><?php echo $phone_number ?></p>
            </div>
            <?php if ($driver == 1){ ?>
                <div class="location">
                    <h2 class="heading">PREFERRED LOCATION</h2>
                    <a href="editpreferredlocations.php?id_active=<?php echo $id_active ?>"><span class="edit"><i class='material-icons'>mode_edit</i></span></a>
                    <?php
                    $sql = "SELECT location FROM driver_locations WHERE ID=$id_active";
                    $result = mysqli_query($conn, $sql);
                    echo "<div class='location-list'>";
                    if (mysqli_num_rows($result) > 0) {
                        $i = 0;
                        echo "<ul>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<li style='margin-left:". $i*40 ."px;'><i class='material-icons'>play_arrow</i><span>". $row["location"] ."</span></li>";
                            $i += 1;
                        }
                        echo "</ul>";
                    }
                    echo "</div>" ;
                    ?>
                </div>
            <?php } ?>
        </div>
        <script src="js/history.js" type="text/javascript"></script>
    </body>
</html>