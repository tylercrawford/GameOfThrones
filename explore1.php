<?php
    require_once("config.php");
?>

<html>
    <head>
    </head>

    <body>

        <?php
            $sql = "SELECT * FROM Kingdom";

            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)) {
                echo $row['k_name'];
                echo "<br>";
            }
        ?>
    </body>
</html>

<?php
    mysqli_close($con);
?>