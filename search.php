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
       	     	       echo "<strong>Spouse: </strong>" . $row['wife'];
		       echo "<br>";
		       }
		    else {
		    	 echo "<strong>Spouse: </strong>" . $row['husband'];
       	     	    	 echo "<br><br>";
		    	 }
		    }
	     }

if($death === "true") {
	     $query ="SELECT * FROM Death WHERE killer = '" . $person . "';";
	     $result = mysqli_query($con, $query);
	     echo "<strong>Victims: </strong>";
	     while( $row = $result->fetch_assoc()) {
	     	    echo $row['name'];
		    echo "<br>";
		    }
		    echo "<br>";
	     }

if($loyal === "true") {
	     $query = "SELECT * FROM LoyalTo WHERE p_name = '" . $person . "';";
	     $result = mysqli_query($con, $query);
	     while( $row = $result->fetch_assoc()) {
	     	    echo "<strong>Loyalty: </strong>" . $row['house'];
	     	    echo "<br><br>";
	     	    }
             }


?>
            
<?php
    mysqli_close($con);
?>