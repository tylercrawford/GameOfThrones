<?php
    require_once("config.php");
?>

<html>
    <head>
    </head>

    <body>
        <?php
            $username = $_POST["username"];
            $sql = "SELECT * FROM Project_Users Where username = '$username'";


            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)) {
                echo $row['username'];
                echo " " . $row['password'];
                echo "<br>";
            }
        ?>
    </body>
</html>
