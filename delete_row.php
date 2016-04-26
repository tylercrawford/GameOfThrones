<?php
    require_once("config.php");
    session_start();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == FALSE) {
        header("Location: index.php");
    }

    $table = $_GET["table"];

    if ($table == "House") {
        $house = $_GET["house"];
        $sql = "DELETE FROM House WHERE h_name = '" . $house . "';";
        $result = mysqli_query($con, $sql);

        if ($result == TRUE) {
            echo "The " . $house . " House has successfully been deleted";
        } else {
            echo "Deletion failed: " . mysqli_error($result);
        }

        echo "<br><br>";
        echo "<a href='edit_table.php?table=House>Back</a>";
    }
?>