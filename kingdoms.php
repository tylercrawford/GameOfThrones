<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<?php
$con = new mysqli('stardock.cs.virginia.edu', 'cs4750sam4ku', 'scott', 'cs4750sam4ku');
if (mysqli_connect_errno())
{
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}
echo "hello world <br>";
$sql = "SELECT * FROM Kingdom";
// // $sql = "SELECT Password FROM Admins";
// $result = $con->query($sql);
// echo $result;


$result = mysqli_query($con, $sql);
echo "<table style='width:100%'>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr><td width='200'>". $row['k_name']. "</td>";
    echo "<a href='view_kingdom.php?kingdom=" , $row['k_name'] , "'>View</a>";
    echo $row['k_name'];
    echo " " . $row['leige_lord'];
    echo "<br>";
}
echo "</table>";


// // check to see if the password matches the password stored in the database
// // Both passwords are hashed
// foreach ($result as $user):
// 	$pass = $user["Password"];
// 	echo $pass;
// mysqli_close($con);
?>


<div name="one" hidden="true">
<img src="westeros.png" width="200">
</div>
<div name="two">
<img src="The North.png" >
</div>



</html>
