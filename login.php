<?php
    require_once("config.php");

    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM Admin Where username = '$username'";


    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 0) {
        echo "no user";
    }

    while($row = mysqli_fetch_array($result)) {
        if ($row['password'] == $password) {
            session_start();
            $_SESSION['logged_in'] = TRUE;
            header("Location: index.php");
            die();
        } else {
            echo "failure";
        }
    }
    mysqli_close($con);
?>
