<?php
<<<<<<< HEAD
$con = new mysqli('stardock.cs.virginia.edu', 'cs4750sam4ku', 'scott', 'cs4750sam4ku');
if (mysqli_connect_errno())
{
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}
echo "hello world <br>";
echo "hello world <br>";
// // $sql = "SELECT Password FROM Admins";
// $result = $con->query($sql);
// echo $result;
$kingdom = $_POST["text"];
$word = $_POST["drop"];
echo $word;
$sql = "SELECT * FROM House WHERE kingdom='".$kingdom."'";
=======
    require_once("config.php");
?>

<html>
    <head>
    </head>
>>>>>>> b8305ac3337660db834bb59bf34f29d2c2f95300

    <body>
        <?php
            $kingdom = $_POST["text"];
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
