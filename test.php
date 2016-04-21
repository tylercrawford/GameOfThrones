<?php
    require_once("config.php");
?>

<html>
    <head>
    </head>

    <body>

        <?php
            // header("Content-type: image/jpeg");

            $sql = "SELECT image FROM Picture WHERE name='North";
            echo $sql;
            $con = new mysqli('stardock.cs.virginia.edu', 'cs4750sam4ku', 'scott', 'cs4750sam4ku');

            $retrieve = $con->get_row("SELECT image FROM Picture WHERE name = 'North");
            $result = mysqli_query($con, $sql);
            $image = imagejpeg(imagecreatefromstring(base64_decode($retrieve->image)));

        ?>
    </body>
</html>

<?php
    mysqli_close($con);
?>
