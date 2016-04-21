<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>

<?php
    require_once("config.php");
?>


    <body>
        <?php
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
?>


<div name="one" hidden="true">
<img src="westeros.png" width="200">
</div>
<div name="two">
<img src="The North.png" >
</div>




    </body>
</html>

<?php
    mysqli_close($con);
?>
