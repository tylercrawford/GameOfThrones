<html>

<?php
$con = new mysqli('stardock.cs.virginia.edu', 'cs4750sam4ku', 'scott', 'cs4750sam4ku');
if (mysqli_connect_errno())
{
        echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}
echo "hello world <br>";
$sql = "SELECT * FROM Kingdom";

$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
    echo $row['k_name'];
    echo "<br>";
}
echo "bye";
mysqli_close($con);
?>

</html>
