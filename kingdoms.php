<?php
    require_once("config.php");
?>

<html>
    <head>
    </head>

    <body>
        <?php
            $sql = "SELECT * FROM Kingdom";
            // // $sql = "SELECT Password FROM Admins";
            // $result = $con->query($sql);
            // echo $result;


            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)) {
                echo "<a href='view_kingdom.php?kingdom=" , $row['k_name'] , "'>View</a>";
                echo $row['k_name'];
                echo " " . $row['leige_lord'];
                echo "<br>";
            }
        ?>
    </body>
</html>
