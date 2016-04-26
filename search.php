<?php
    require_once("config.php");
?>

<?php
$person = $_POST["person"];
$question = $_POST["question"];

if($question === "MarriedTo") {
	     $query = "SELECT * FROM " . $question . " WHERE husband = '" . $person . "' OR wife = '" . $person . "';";
	     $result = mysqli_query($con, $query);
	     while( $row = $result->fetch_assoc()) {
       	     	    echo $row['husband'];
       	     	    echo "<br><br>";
		    }
	     }

if($question === "Death") {
	     $query ="SELECT * FROM " . $question . " WHERE name = '" . $person . "';";
	     $result = mysqli_query($con, $query);
	     while( $row = $result->fetch_assoc()) {
	     	    echo $person . " was killed by " . $row['killer'];
		    echo "<br><br>";
		    }
	     }

if($question === "LoyalTo") {
	     $query = "SELECT * FROM " . $question . " WHERE p_name = '" . $person . "';";
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