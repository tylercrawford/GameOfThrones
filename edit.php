<?php
    require_once("config.php");
    session_start();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == FALSE) {
        header("Location: index.php");
    }
?>

<html>
    <head>
        <title>Edit Tables</title>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>

    <body>
        <script>
            function submit_drop() {
                var table = $("#dropdown").val();
                $("#table").val(table);
                $("#edit_form").submit();
            }
        </script>
        <br>
        <form name="edit_form" action="edit_table.php" method="GET" id="edit_form">
        Edit table:
        <select onchange="submit_drop()" id="dropdown">
            <?php
                $query = "SHOW TABLES";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $value = $row[0];
                    echo("<option id=$value value=$value>$value</option>");
                }
            ?>
        </select>
        <input type="hidden" name="table" id="table">
        <input hidden type="submit" value="hi">
    </body>
</html>