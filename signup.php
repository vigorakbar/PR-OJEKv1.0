<?php
require('includes/config.php');

if(isset($_POST["submit"])){
    if($_POST["password"] !== $_POST["password_conf"]){
        echo "<script>alert('Your password is not match!')</script>";        
    }
    else {
        $name = $_POST["name"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $phone_number = $_POST["phone"];
        $driver = (!isset($_POST["driver"])) ? 0 : 1;

        $sql = "INSERT INTO users (name, username, email, password, phone_number, driver)
        VALUES ('$name', '$username', '$email', '$password', '$phone_number', $driver)";

        if ($conn->query($sql) === TRUE) {
            $sql = "SELECT ID FROM users WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $ID = $row["ID"];
            }
            if ($driver === 1){
                $sql = "INSERT INTO drivers (ID, name)
                VALUES ($ID,'$name')";
                if($conn->query($sql) === TRUE){
                    echo "New driver record created successfully<br>";
                }
            }
            header('Location: profile.php?id_active=' . $ID);
            exit;                
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Signup</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/auth.css">

    </head>
    <body>
        <div class="apps">
            <div class="form-heading">
                <div class="heading-left">
                    <hr>
                </div>
                <div class="heading-title">
                    SIGNUP
                </div>
                <div class="heading-right">
                    <hr>
                </div>
            </div>
            <div class="form-signup">
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for="name">Your Name</label>                            
                        <input id="name" type="text" name="name" placeholder="your name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>                            
                        <input id="username" type="text" name="username" placeholder="your username" onfocusout="getUsernameValidation()" required> <span><i class="material-icons" id="checkUsername">check</i><i class="material-icons" id="wrongUsername">info</i></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>                            
                        <input id="email" type="text" name="email" placeholder="your email" onfocusout="getEmailValidation()" required><span><i class="material-icons" id="checkEmail">check</i><i class="material-icons" id="wrongEmail">info</i></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>                            
                        <input id="password" type="password" name="password" placeholder="your password" pattern=".{5,10}" title="5 to 10 characters" required>
                    </div>
                    <div class="form-group">
                        <label for="password_conf">Password Confirm</label>                            
                        <input id="password_conf" type="password" name="password_conf" placeholder="your password again" pattern=".{5,10}" title="5 to 10 characters" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>                            
                        <input id="phone" type="text" name="phone" placeholder="your phone" required>
                    </div>
                    <input type="checkbox" name="driver" value="true"> Also sign me up as a driver!
                    <div class="action">
                        <div class="login">
                            <a href="login.php">Already have an account ?</a>
                        </div>
                        <div class="submit">
                            <input id="submit" type="submit" name="submit" value="REGISTER">                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="js/validation.js"></script>
    </body>
</html>
