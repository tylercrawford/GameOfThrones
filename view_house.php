<?php
    require_once("config.php");
?>

<html>
    <head>
    </head>

    <body>

        <?php
            $house = $_GET["house"];
            $sql = "SELECT * FROM Person WHERE house='".$house."'";

            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)) {
                // echo "<a href='view.php" , $row['k_name'] , ".php'>View</a>";
                echo $row['p_name'];
                echo " " . $row['birthyear'];
                echo "<br>";
            }
        ?>
    </body>
</html>

<?php
    mysqli_close($con);
?>