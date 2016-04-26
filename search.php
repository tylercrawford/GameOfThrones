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
	     echo "<strong>Spouse: </strong>";
	     if(!mysqli_num_rows($result)){
	     echo "None<br>";
	     }
	     while( $row = $result->fetch_assoc()) {
	     	    if ($person === $row['husband']) {
       	     	       echo $row['wife'];
		       echo "<br>";
		       }
		    else {
		    	 echo $row['husband'];
       	     	    	 echo "<br>";
		    	 }
		    }
	     }

if($death === "true") {
	     $query ="SELECT * FROM Death WHERE killer = '" . $person . "';";
	     $result = mysqli_query($con, $query);
	     echo"<strong>Victims: </strong>";
	     if(!mysqli_num_rows($result)){
	     echo "None<br>";
	     }
	     while( $row = $result->fetch_assoc()) {
	     	    echo $row['name'];
		    echo "<br>";
		    }
	     }

if($loyal === "true") {
	     $query = "SELECT * FROM LoyalTo WHERE p_name = '" . $person . "';";
	     $result = mysqli_query($con, $query);
	     echo "<strong>Loyalty: </strong>";
	     if(!mysqli_num_rows($result)){
	     echo "None";
	     }
	     while( $row = $result->fetch_assoc()) {
	     	    echo $row['house'];
	     	    echo "<br><br>";
	     	    }
             }


?>
            
<?php
    mysqli_close($con);
?>