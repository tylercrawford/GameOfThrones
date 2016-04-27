<?php
    require_once("config.php");

    $username = $_POST["username"];
    $password = $_POST["password"];

    if (strpos($username, "/") !== FALSE || strpos($username, ".") !== FALSE || 
        strpos($username, ";") !== FALSE || strpos($username, "(") !== FALSE || strpos($username, ")") !== FALSE ||
        strpos($username, "=") !== FALSE) {

        setcookie("loginerror", "Invalid username", time()+30);
        header("Location: login.php");
        exit();
    }

    if (strpos($password, "/") !== FALSE || strpos($password, ".") !== FALSE || 
        strpos($password, ";") !== FALSE || strpos($password, "(") !== FALSE || strpos($password, ")") !== FALSE ||
        strpos($password, "=") !== FALSE) {

        setcookie("loginerror", "Invalid password", time()+30);
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT * FROM Admin Where username = '$username'";


    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 0) {
        setcookie("loginerror", "Incorrect username or password", time()+30);
        header("Location: login.php");
        exit();
    }

    while($row = mysqli_fetch_array($result)) {
        if ($row['password'] == $password) {
            session_start();
            $_SESSION['logged_in'] = TRUE;
            header("Location: index.php");
            die();
        } else {
            setcookie("loginerror", "Incorrect username or password", time()+30);
            header("Location: login.php");
            exit();
        }
    }
    mysqli_close($con);
?>
