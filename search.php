<?php
    require_once("config.php");
?>

<?php 


    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }


?>

<?php
$query ="SELECT * FROM '" . $_POST["question"] . "'";
echo $query;
$result = mysqli_query($con, $query);
?>
            
<?php
    mysqli_close($con);
?>