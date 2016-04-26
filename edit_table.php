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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>

    <body>
        <form>
            <table class="table">
                <?php
                    $table = $_GET['table'];

                    if ($table == "House") {
                        echo "<tr>";
                        echo "<th>House Name</th>";
                        echo "<th>Castle</th>";
                        echo "<th>Kingdom</th>";
                        echo "<th>Words</th>";
                        echo "<th></th><th></th>";
                        echo "</tr>";

                        $sql = "SELECT * FROM House";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td>" . $row[1] . "</td>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . "</td>";
                            echo "<td><a href='edit_row.php?table=House&house=" . $row[0] . "'>Edit</a></td>";
                            echo "<td><a href='delete_row.php?table=House&house=" . $row[0] . "'>Delete</a></td>";
                            echo "</tr>";
                        }
                    }

                    
                ?>
            </table>
        </form>
    </body>
</html>

<?php
    mysqli_close($con);
?>