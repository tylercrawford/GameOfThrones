<html>

<?php
$con = new mysqli('stardock.cs.virginia.edu', 'cs4750sam4ku', 'scott', 'cs4750sam4ku');
if (mysqli_connect_errno())
{
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}
echo "Connected to DB!";
?>
<h3>SEARCH FORM</h3>
<form name = "searchform" action = "search.php" method = "POST">
    <!-- Username: <br/><input type = "text" name = "username" maxlength = "50" required><br />  -->
    Text: <br/><input type = "text" name = "text" maxlength = "50" required><br /> <br/>
    <input type = "submit" class="btn btn-default" name = "submit" value = "Submit">
</form>
<?php
// $sql = "SELECT * FROM Person";
// // // $sql = "SELECT Password FROM Admins";
// // $result = $con->query($sql);
// // echo $result;


// $result = mysqli_query($con, $sql);

// while($row = mysqli_fetch_array($result)) {
//     echo $row['p_name'];
//     echo " " . $row['birthyear'];
//     echo "<br>";
// }
// echo "bye";

// // check to see if the password matches the password stored in the database
// // Both passwords are hashed
// foreach ($result as $user):
// 	$pass = $user["Password"];
// 	echo $pass;
// mysqli_close($con);
?>
</html>
