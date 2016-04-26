<?php
    require_once("config.php");
?>

<?php
$person = $_POST["person"];
$death = $_POST["death"];
$marriage = $_POST["marriage"];
$loyal = $_POST["loyal"];

if($marriage === "true") {
	     $query = "SELECT * FROM MarriedTo WHERE husband = '" . $person . "' OR wife = '" . $person . "';";
	     $result = mysqli_query($con, $query);
	     while( $row = $result->fetch_assoc()) {
	     	    if ($person === $row['husband']) {
       	     	       echo $person . " is married to " . $row['wife'];
		       echo "<br>";
		       }
		    else {
		    	 echo $person . " is married to " . $row['husband'];
       	     	    	 echo "<br><br>";
		    	 }
		    }
	     }

if($death === "true") {
	     $query ="SELECT * FROM Death WHERE name = '" . $person . "';";
	     $result = mysqli_query($con, $query);
	     while( $row = $result->fetch_assoc()) {
	     	    echo $person . " was killed by " . $row['killer'];
		    echo "<br><br>";
		    }
	     }

if($loyal === "true") {
	     $query = "SELECT * FROM LoyalTo WHERE p_name = '" . $person . "';";
	     $result = mysqli_query($con, $query);
	     while( $row = $result->fetch_assoc()) {
	     	    echo $person . " is loyal to House " . $row['house'];
	     	    echo "<br><br>";
	     	    }
             }


?>
            
<?php
    mysqli_close($con);
?>