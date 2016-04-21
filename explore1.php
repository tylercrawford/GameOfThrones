<?php
    require_once("config.php");
?>

<?php
	$sql = "SELECT * FROM Kingdom";
	$result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)) {
                $val = $row['k_name'] . "<br>";
                echo $val;
		}
?>

<?php
    mysqli_close($con);
?>