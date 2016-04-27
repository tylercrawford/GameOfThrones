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
    } else if ($table == "Person") {
        $person = $_GET["person"];

        $sql = "SELECT * FROM Person WHERE p_name = '" . $person . "';";
        $result = mysqli_query($con, $sql);

        $sql2 = "SELECT h_name FROM House";
        $result2 = mysqli_query($con, $sql2);
        $houses = [];
        while ($row = mysqli_fetch_array($result2)) {
            array_push($houses, $row[0]);
        }

        $new = FALSE;
        if ($person == "new") {
            $new = TRUE;
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <title>Edit</title>
    </head>

    <body>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">History of The Seven Great Houses</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="./index.html">Home</a></li>
              <li><a href="./kingdoms.php">Explore</a></li>
              <li><a href="./search.html">Search</a></li>
              <?php
                if (isset($_SESSION['logged_in']) && $_SESSION["logged_in"] == TRUE) {
                    echo '<li><a href="./edit.php">Admin</a></li>';
                }
              ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION["logged_in"] == TRUE) {
                        echo '<li><a href="./logout.php">Logout</a></li>';
                    } else {
                        echo '<li><a href="./login.html">Login</a></li>';
                    }
                ?>
            </ul>
          </div>
        </nav>

        <div style="margin-left: 50px; margin-right: 50px">
        <form method="POST" action="save_table.php" name="tableform">
            <table class="table table-striped table-hover">
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
                    } else if ($table == "Person" && $new == TRUE) {
                ?>
                    <tr>
                        <th>Name</th>
                        <th>House</th>
                        <th>Birthyear</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name"></td>
                        <td><select name="house">
                            <option value="">-- Select --</option>
                            <?php
                                foreach ($houses as $house) {
                                    echo "<option value='" . $house . "'>" . $house . "</option>";
                                }
                            ?></select></td>
                        <td><input type="number" name="birthyear"></td>
                    </tr>
                    <input type="hidden" name="typeOfTable" value="Person">
                    <input type="hidden" name="newOrUpdate" value="new">
                <?php
                    } else if ($table == "Person" && $new == FALSE) {
                ?>
                    <tr>
                        <th>Name</th>
                        <th>House</th>
                        <th>Birthyear</th>
                    </tr>
                    <tr>
                        <?php
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<td><input type="text" name="name" value="' . $row[0] . '"></td>';
                                echo '<td><select name="house">';
                                echo '<option value="">-- Select --</option>';
                                foreach ($houses as $house) {
                                    if ($house == $row[1]) {
                                        echo "<option value='" . $house . "' selected>" . $house . "</option>";    
                                    } else {
                                        echo "<option value='" . $house . "'>" . $house . "</option>";
                                    }
                                }
                                echo "</select></td>";
                                echo '<td><input type="number" name="birthyear" value="' . $row[2] . '"></td>';
                            }
                        ?>
                    </tr>
                    <input type="hidden" name="typeOfTable" value="Person">
                    <input type="hidden" name="newOrUpdate" value="edit">
                <?php
                    }
                ?>
            </table>
            <br>
            <div style="margin-right: 100px">
                <input type="submit" value="Submit" class="btn btn-small pull-right" style="background-color: green; color: white">
                <input type="button" style="background: transparent; border: none !important; font-size: 0 width: 2px !important" class="btn btn-small pull-right">
                <?php
                    if ($table == "House") {
                ?>
                        <input type='button' class='btn btn-small pull-right' style='background-color: blue; color: white;' value='Back' onclick='location.href="edit_table.php?table=House"'>
                <?php
                    } else if ($table == "Person") {
                ?>
                        <input type='button' class='btn btn-small pull-right' style='background-color: blue; color: white;' value='Back' onclick='location.href="edit_table.php?table=Person"'>
                <?php
                    }
                ?>
            </div>
        </form>
        </div>
    </body>
</html>