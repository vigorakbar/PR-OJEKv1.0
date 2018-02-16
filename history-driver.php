<?php
    require('includes/config.php');

    $id_active = $_GET["id_active"];
    $sql = "SELECT * FROM users WHERE ID=$id_active LIMIT 1";

    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $username = $row["username"];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>History</title>
        <link rel="stylesheet" type="text/css" href="css/history.css">
    </head>
    <style type="text/css">
        .menu a {
            text-decoration: none;
            color: inherit;
        }
        .submenu a {
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
                <div class="menu"><a href="orderojek.php?id_active=<?php echo $id_active ?>">ORDER</a></div>
                <div class="menu active">HISTORY</div>
                <div class="menu"><a href="profile.php?id_active=<?php echo $id_active ?>">MY PROFILE</a></div>
            </div>
            <h1>TRANSACTION HISTORY</h1>
            <div>
                <div class="submenu"><a href="history-order.php?id_active=<?php echo $id_active ?>">MY PREVIOUS ORDERS</a></div>
                <div class="submenu active">DRIVER HISTORY</div>
            </div>

            <?php
            $sql = "SELECT * FROM transaction JOIN users ON (transaction.id_user=users.ID) WHERE transaction.id_driver=". $id_active;
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
            // output data of each row
                $idx = 1;
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="listBox" id="' .$idx . '">';
                        $image = '<img src="' . $row['image'] . '" class="thumbnail">';
                        echo '<button class="buttonHide" onclick="hideElement(' .$idx . ')">HIDE</button>';
                        echo $image.'<div class="date">' . date('l', strtotime($row['time'])) . ', ' . date('F jS Y', strtotime($row['time'])) . '</div>';
                        echo '<div class="name"> ' . $row['name']. '</div>';
                        echo '<div class="route"> ' . $row['picking_point'] . '-' . $row['destination'] . '</div>';
                        echo '<div class="rating"> Gave ' . $row['rating'] . ' stars</div>';
                        echo '<div class="comment"> and left comment: </div>';
                        echo '<div class="comment">' . $row['comment'] . '</div>';
                        echo '<br>';
                    '</div>';
                    '<div></div>';
                    $idx++;
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>            
        </div>
        <script src="js/history.js" type="text/javascript"></script>
    </body>
</html>