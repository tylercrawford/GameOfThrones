<?php
    require_once("config.php");
?>

<html>
    <head>
    </head>

    <body>

        <?php
            $kingdom = $_GET["kingdom"];
            $sql = "SELECT * FROM House WHERE kingdom='".$kingdom."'";


            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)) {
                echo "<a href='view_house.php?house=" , $row['h_name'] , "'>".$row['h_name']."</a>";
                // echo $row['h_name'];
                echo " " . $row['castle'];
                echo "<br>";
            }
        ?>
    </body>
</html>

<?php
    mysqli_close($con);
?>