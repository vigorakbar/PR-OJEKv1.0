<?php
    require("includes/config.php");
    if (isset($_GET["delete"])){
        $id = $_GET["id_active"];
        $location = $_GET["delete"];

        $sql = "DELETE FROM driver_locations WHERE ID = $id AND location = '$location'";
        if ($conn->query($sql) === TRUE) {
            //header("Refresh:0; url=editpreferredlocations.php?id_active=" . $id);
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_GET["update"])){
        $id = $_GET["id_active"];
        $location = $_GET["location"];
        $update = $_GET["update"];

        $sql = "UPDATE driver_locations SET location='$update' WHERE ID=$id AND location='$location'";
        if ($conn->query($sql) === TRUE) {
            //header("Refresh:0; url=editpreferredlocations.php?id_active=" . $id);
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

?>