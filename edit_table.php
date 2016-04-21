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
                    $sql = "DESCRIBE " . $table;
                    $result1 = mysqli_query($con, $sql);

                    echo "<tr>";
                    while ($row = mysqli_fetch_array($result1)) {
                        echo "<th>" . $row[0] . "</th>";
                    }
                    echo "</tr>";

                    $sql = "SELECT * FROM " . $table;
                    $result2 = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_array($result2)) {
                        echo "<tr>";
                        for ($i=0; $i < mysqli_num_rows($result1); $i++) {
                            echo "<td>" . $row[$i] . "</td>";
                        }
                        echo "<tr>";
                    }
                ?>
            </table>
        </form>
    </body>
</html>

<?php
    mysqli_close($con);
?>