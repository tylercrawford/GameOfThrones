<?php
    require_once("config.php");
    session_start();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == FALSE) {
        header("Location: index.php");
    }

    $table = $_POST["typeOfTable"];
    if ($table == "House") {
        $name = $_POST["name"];
        $castle = $_POST["castle"];
        $kingdom = $_POST["kingdom"];
        $words = $_POST["words"];
        $originalHouse = $_POST["originalHouse"];
        $sql = "UPDATE House SET h_name = '" . $name . "', castle = '" . $castle . "', kingdom = '" . $kingdom . "', words = '" . $words . "' WHERE h_name = '" . $originalHouse . "';";
        $result = mysqli_query($con, $sql);
        if ($result == TRUE) {
            echo "House successfully updated";
        } else {
            echo "Update failed: " . mysqli_error($result);
        }
        echo "<br><br>";
        echo "<a href='edit_table.php?table=House'>Back</a>";
    }
?>