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
            setcookie("delete", "House", time()+30);
            setcookie("status", "success", time()+30);
            header("Location: edit_table.php?table=House");
        } else {
            setcookie("delete", "House", time()+30);
            setcookie("status", "failure", time()+30);
            header("Location: edit_table.php?table=House");
        }
    } else if ($table == "Person") {
        $person = $_GET["person"];
        $sql = "DELETE FROM Person WHERE p_name = '" . $person . "';";
        $result = mysqli_query($con, $sql);

        if ($result == TRUE) {
            setcookie("delete", "Person", time()+30);
            setcookie("status", "success", time()+30);
            header("Location: edit_table.php?table=Person");
        } else {
            setcookie("delete", "Person", time()+30);
            setcookie("status", "failure", time()+30);
            header("Location: edit_table.php?table=Person");
        }
    } else if ($table == "MarriedTo") {
        $husband = $_GET["husband"];
        $wife = $_GET["wife"];
        $sql = "DELETE FROM MarriedTo WHERE husband = '" . $husband . "' AND wife = '" . $wife . "';";
        $result = mysqli_query($con, $sql);

        if ($result == TRUE) {
            setcookie("delete", "MarriedTo", time()+30);
            setcookie("status", "success", time()+30);
            header("Location: edit_table.php?table=MarriedTo");
        } else {
            setcookie("delete", "MarriedTo", time()+30);
            setcookie("status", "failure", time()+30);
            header("Location: edit_table.php?table=MarriedTo");
        }
    }
?>