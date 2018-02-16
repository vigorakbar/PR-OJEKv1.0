<?php
require('includes/config.php');

$id_active = $_GET["id_active"];
$sql = "SELECT driver FROM users WHERE ID=$id_active LIMIT 1";

$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $driver = $row["driver"];
}

if ($driver == 0){
    header('Location: profile.php?id_active=' . $id_active);
    echo "<script>console.log(" . $driver . ")</script>";    
    exit;
}

if(isset($_POST["back"])){
    header('Location: profile.php?id_active=' . $id_active);
    echo "<script>console.log('back')</script>";    
    exit;
}

if(isset($_POST["submit"])) {
    $location = $_POST["location"];

    $sql = "INSERT INTO driver_locations (ID, location)
    VALUES ('$id_active', '$location')";

    if ($conn->query($sql) === TRUE) {
        header('Location: editpreferredlocations.php?id_active=' . $id_active);
        echo "<script>console.log('get in')</script>";                
        exit;                
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT location FROM driver_locations WHERE ID=$id_active";

$result = mysqli_query($conn, $sql);
echo "<script>var id = " . $id_active . ";</script>"
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Profile</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">        
        <link rel="stylesheet" href="css/profile.css">
    </head>
    <body>
        <div class="apps">
            <div class="heading">
                <h2>EDIT PREFERRED LOCATIONS</h2>
            </div>
            <table border="1" class="data-location">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        $location = $row["location"];
                        echo "
                        <tr>
                            <td>". $i ."</td>
                            <td><input type='text' value='". $location ."' disabled></td>
                            <td><span class='edit'><i class='material-icons' onclick='editLocation(this)'>mode_edit</i></span><span class='delete'><i class='material-icons' onclick='deleteLocation(this)'>delete</i></span></td>
                        </tr>
                        ";
                        $i += 1;
                    } ?>
                </tbody>
            </table>
            <div class="add-location">
                <h3>ADD NEW LOCATION</h3>
                <form action="" method="post">
                    <input type="text" name="location" required>
                    <input type="submit" name="submit" value="ADD">
                </form>
            </div>
            <div class="back">
                <a href="<?php echo 'profile.php?id_active=' . $id_active ?>">BACK</a>
            </div>
        </div>
        <script src="js/editlocation.js"></script>
    </body>
</html>
