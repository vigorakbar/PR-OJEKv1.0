<?php
require('includes/config.php');

$id_active = $_GET["id_active"];
$sql = "SELECT name, phone_number, driver, image FROM users WHERE ID=$id_active LIMIT 1";

$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $name = $row["name"];
    $phone_number = $row["phone_number"];
    $driver = $row["driver"];
    $image = $row["image"];
}

if(isset($_POST["back"])){
    header('Location: profile.php?id_active=' . $id_active);
}

if(isset($_POST["submit"])) {
    $name = $_POST["name"];
    $phone_number = $_POST["phone"];
    $driver = (!isset($_POST["driver"])) ? 0 : 1;
    if ($driver == 1){
        $sql = "SELECT * FROM drivers WHERE ID=$id_active";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) <= 0){
            $sql = "INSERT INTO drivers (ID, name, total_rating, total_passangers)
            VALUES ('$id_active', '$name', 0, 0)";
            if ($conn->query($sql) === TRUE) {
                //do nothing
            }
        }
    }
    if($_POST["submit"] === ""){
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 2000000) {
            //echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
            $sql = "UPDATE users SET name='$name', phone_number='$phone_number', driver=$driver WHERE ID=$id_active";
        // if everything is ok, try to upload file
        } else {
            $sql = "SELECT image FROM users WHERE ID=$id_active";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $image = $row["image"];
            }
            unlink($image);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $image = './' . $target_file;
                $sql = "UPDATE users SET name='$name', phone_number='$phone_number', driver=$driver, image='$image' WHERE ID=$id_active";
            } else {
                //echo "Sorry, there was an error uploading your file.";
                $sql = "UPDATE users SET name='$name', phone_number='$phone_number', driver=$driver WHERE ID=$id_active";            
            }
        }
    
        if ($conn->query($sql) === TRUE) {
            //echo "Record updated successfully";
        } else {
            //echo "Error updating record: " . $conn->error;
        }    
    }
    else {
        $sql = "UPDATE users SET name='$name', phone_number='$phone_number', driver=$driver WHERE ID=$id_active";        
        if ($conn->query($sql) === TRUE) {
            //echo "Record updated successfully";
        } else {
            //echo "Error updating record: " . $conn->error;
        } 
    }
    header('Location: profile.php?id_active=' . $id_active);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Profile</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link rel="stylesheet" href="css/profile.css">
    </head>
    <body>
        <div class="apps">
            <div class="heading">
                <h3>EDIT PROFILE INFORMATION</h3>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="edit-img">
                    <div class="profile-img">
                        <img src="<?php echo $image ?>" alt="profile image" class="thumbnail">
                    </div>
                    <div class="update-img">
                        <h4>Update profile picture</h4>
                        <input id="uploadFile" name="nameFile" type="text" disabled="disabled">
                        <div class="fileUpload">
                            <span>Browse...</span>
                            <input id="uploadBtn" name="fileToUpload" type="file" class="upload">
                        </div>
                    </div>
                </div>
                <div class="edit-data">
                    <div class="form-group">
                        <label for="name">Your Name</label>                            
                        <input id="name" type="text" name="name" placeholder="your name" value="<?php echo $name ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>                            
                        <input id="phone" type="text" name="phone" placeholder="your phone" value="<?php echo $phone_number?>" required>
                    </div>
                    <div class="form-group">
                        <label for="driver">Status Driver</label>                            
                        <label class="switch">
                            <?php if ($driver == 1){ ?>
                                <input name="driver" type="checkbox" checked>
                            <?php } else { ?>
                                <input name="driver" type="checkbox">
                            <?php } ?>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="submit">
                        <input type="submit" class="cancel" name="back" value="BACK">
                        <input type="submit" class="save" name="submit" value="SAVE">
                    </div>
                </div>
            </form>
        </div>
        <script src="js/profile.js"></script>
    </body>
</html>
