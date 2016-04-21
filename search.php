<html>

<?php
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


$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
    echo "<a href='view_house.php?house=" , $row['h_name'] , "'>".$row['h_name']."</a>";
    // echo $row['h_name'];
    echo " " . $row['castle'];
    echo "<br>";
}
echo "bye";

// // check to see if the password matches the password stored in the database
// // Both passwords are hashed
// foreach ($result as $user):
// 	$pass = $user["Password"];
// 	echo $pass;
// mysqli_close($con);
?>
</html>
