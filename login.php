<?php
require_once('includes/config.php');

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $sql = "SELECT ID, username, password FROM users WHERE username = '$username' limit 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            $ID = $row["ID"];
            $passwordconf = $row["password"];
        }
    
        if($password !== $passwordconf){
            echo "<script>alert('Wrong password!')</script>";
        }
        else {
            header('Location: profile.php?id_active=' . $ID);
            exit;
        }
    }
    else {
        echo "<script>alert('User not exist!')</script>";
    }
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Login</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link rel="stylesheet" href="css/auth.css">
        <script src="js/validation.js"></script>
    </head>
    <body>
        <div class="apps">
            <div class="form-heading">
                <div class="heading-left">
                    <hr>
                </div>
                <div class="heading-title">
                    LOGIN  
                </div>
                <div class="heading-right">
                    <hr>
                </div>
            </div>
            <div class="form-login">
                <form action="" method="POST" autocomplete="off" onsubmit="return validateLogin()" name="login">
                    <div class="form-group">
                        <label for="username">Username </label>                            
                        <input id="username" type="text" name="username" placeholder="your username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password </label>                            
                        <input id="password" type="password" name="password" placeholder="your password" pattern=".{5,10}" title="5 to 10 characters">                        
                    </div>
                    <div class="action">
                        <div class="register">
                            <a href="signup.php">Don't have an account ?</a>
                        </div>
                        <div class="submit">
                            <input type="submit" name="submit" value="GO!">                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
