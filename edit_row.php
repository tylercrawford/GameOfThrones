<?php
    require_once("config.php");
    session_start();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == FALSE) {
        header("Location: index.php");
    }

    $table = $_GET["table"];

    if ($table == "House") {
        $house = $_GET["house"];
        $sql = "SELECT * FROM House WHERE h_name = '" . $house . "';";
        $result = mysqli_query($con, $sql);

        $sql2 = "SELECT k_name FROM Kingdom";
        $result2 = mysqli_query($con, $sql2);
        $kingdoms = [];
        while ($row = mysqli_fetch_array($result2)) {
            array_push($kingdoms, $row[0]);
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <title>Edit <?php echo $house ?> House</title>
    </head>

    <body>
        <form method="POST" action="save_table.php" name="tableform">
            <table class="table">
                <?php
                    if ($table == "House") {
                ?>
                    <tr>
                        <th>House Name</th>
                        <th>Castle</th>
                        <th>Kingdom</th>
                        <th>Words</th>
                    </tr>

                    <tr>
                        <?php
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<td><input type='text' name='name' value='" . $row[0] . "'></td>";
                                echo "<td><input type='text' name='castle' value='" . $row[1] . "'></td>";
                                echo "<td><select name='kingdom'>";
                                foreach ($kingdoms as $kingdom) {
                                    if ($kingdom == $row[2]) {
                                        echo "<option selected value='" . $kingdom . "'>" . $kingdom . "</option>";
                                    } else {
                                        echo "<option value='" . $kingdom . "'>" . $kingdom . "</option>";
                                    }
                                }
                                echo "<td><textarea rows='3' cols='30' name='words'>" . $row[3] . "</textarea></td>";
                            }
                        ?>
                    </tr>
                    <input type="hidden" name="typeOfTable" value="House">
                    <input type="hidden" name="originalHouse" value=<?php echo $house; ?>>
                <?php
                    }
                ?>
            </table>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>