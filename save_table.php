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
        $newOrUpdate = $_POST["newOrUpdate"];

        if ($newOrUpdate == "new") {
            $sql = "INSERT INTO House (h_name, castle, kingdom, words) VALUES ('" . $name . "', '" . $castle . "', '" . $kingdom . "', '" . $words . "')";
                $result = mysqli_query($con, $sql);
                if ($result == TRUE) {
                    setcookie("insert", "House", time()+30);
                    setcookie("status", "success", time()+30);
                    header("Location: edit_table.php?table=House");
                } else {
                    setcookie("insert", "House", time()+30);
                    setcookie("status", "failure", time()+30);
                    header("Location: edit_table.php?table=House");
                }
        } else {
            $sql = "UPDATE House SET h_name = '" . $name . "', castle = '" . $castle . "', kingdom = '" . $kingdom . "', words = '" . $words . "' WHERE h_name = '" . $originalHouse . "';";
            $result = mysqli_query($con, $sql);
            if ($result == TRUE) {
                setcookie("update", "House", time()+30);
                setcookie("status", "success", time()+30);
                header("Location: edit_table.php?table=House");
            } else {
                setcookie("update", "House", time()+30);
                setcookie("status", "failure", time()+30);
                header("Location: edit_table.php?table=House");
            }
        }
    } else if ($table == "Person") {
        $name = $_POST["name"];
        $house = $_POST["house"];
        $birthyear = $_POST["birthyear"];
        $newOrUpdate = $_POST["newOrUpdate"];

        if ($newOrUpdate == "new") {
            $sql = "INSERT INTO Person (p_name, house, birthyear) 
            VALUES ('" . $name . "', '" . $house . "', '" . $birthyear . "');";
            $result = mysqli_query($con, $sql);
            if ($result == TRUE) {
                setcookie("insert", "Person", time()+30);
                setcookie("status", "success", time()+30);
                header("Location: edit_table.php?table=Person");
            } else {
                setcookie("insert", "Person", time()+30);
                setcookie("status", "failure", time()+30);
                header("Location: edit_table.php?table=Person");
            }
        } else {
            $originalPerson = $_POST["originalPerson"];
            $sql = "UPDATE Person SET p_name = '" . $name . "', house = '" . $house . "', birthyear = '" . $birthyear . "' 
            WHERE p_name = '" . $originalPerson . "';";
            $result = mysqli_query($con, $sql);
            if ($result == TRUE) {
                setcookie("update", "Person", time()+30);
                setcookie("status", "success", time()+30);
                header("Location: edit_table.php?table=Person");
            } else {
                setcookie("update", "Person", time()+30);
                setcookie("status", "failure", time()+30);
                header("Location: edit_table.php?table=Person");
            }
        }
    } else if ($table == "MarriedTo") {
        $husband = $_POST["husband"];
        $wife = $_POST["wife"];
        $season = $_POST["season"];
        $newOrUpdate = $_POST["newOrUpdate"];

        if ($newOrUpdate == "new") {
            $sql = "INSERT INTO MarriedTo (husband, wife, season) VALUES ('" . $husband . "', '" . $wife . "', '" . $season . "');";
            $result = mysqli_query($con, $sql);
            if ($result == TRUE) {
                setcookie("insert", "MarriedTo", time()+30);
                setcookie("status", "success", time()+30);
                header("Location: edit_table.php?table=MarriedTo");
            } else {
                setcookie("insert", "MarriedTo", time()+30);
                setcookie("status", "failure", time()+30);
                header("Location: edit_table.php?table=MarriedTo");
            }
        } else {
            $originalHusband = $_POST["originalHusband"];
            $originalWife = $_POST["originalWife"];
            $sql = "UPDATE MarriedTo SET husband = '" . $husband . "', wife = '" . $wife . "' 
            WHERE husband = '" . $originalHusband . "' AND wife = '" . $originalWife . "';";
            $result = mysqli_query($con, $sql);
            if ($result == TRUE) {
                setcookie("update", "MarriedTo", time()+30);
                setcookie("status", "success", time()+30);
                header("Location: edit_table.php?table=MarriedTo");
            } else {
                setcookie("update", "MarriedTo", time()+30);
                setcookie("status", "failure", time()+30);
                header("Location: edit_table.php?table=MarriedTo");
            }
        }
    }
?>