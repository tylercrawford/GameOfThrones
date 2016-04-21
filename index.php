<?php
    require_once("config.php");
?>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>

    <body>
    <?php
        $sql = "SELECT * FROM Person";

        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)) {
            echo $row['p_name'];
            echo " " . $row['birthyear'];
            echo "<br>";
        }
    ?>
    </body>
</html>
