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
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">History of The Seven Great Houses</a>
            </div>
            <ul class="nav navbar-nav">
              <li><a href="./index.php">Home</a></li>
              <li><a href="./kingdoms.php">Explore</a></li>
              <li><a href="./search.html">Search</a></li>
              <?php
                if (isset($_SESSION['logged_in']) && $_SESSION["logged_in"] == TRUE) {
                    echo '<li class="active"><a href="./edit.php">Admin</a></li>';
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
            <input type="button" class="btn btn-small" onclick="location.href='edit.php'" 
             value="Back" style="background-color: blue; color:white;">
             <?php
             if (isset($_COOKIE["update"]) && isset($_COOKIE["status"])) {
                if ($_COOKIE["status"] == "success") {
            ?>
                 <div class="alert alert-success">
                    <?php 
                        echo $_COOKIE["update"] . " table successfully updated";
                        setcookie("update", "", time()-3600);
                        setcookie("status", "", time()-3600);
                    ?>
                </div>
            <?php
                } else if ($_COOKIE["status"] == "failure") {
            ?>
                    <div class="alert alert-danger">
                        Update failed
                    </div>
            <?php
                    setcookie("update", "", time()-3600);
                    setcookie("status", "", time()-3600);
                }
            } else if (isset($_COOKIE["insert"]) && isset($_COOKIE["status"])) {
                if ($_COOKIE["status"] == "success") {
            ?>
                 <div class="alert alert-success">
                    <?php 
                        echo "Insertion successful";
                        setcookie("insert", "", time()-3600);
                        setcookie("status", "", time()-3600);
                    ?>
                </div>
            <?php
                } else if ($_COOKIE["status"] == "failure") {
            ?>
                    <div class="alert alert-danger">
                        Insert failed
                    </div>
            <?php
                    setcookie("insert", "", time()-3600);
                    setcookie("status", "", time()-3600);
                }
            } else if (isset($_COOKIE["delete"]) && isset($_COOKIE["status"])) {
                if ($_COOKIE["status"] == "success") {
            ?>
                 <div class="alert alert-success">
                    <?php 
                        echo "Deletion successful";
                        setcookie("delete", "", time()-3600);
                        setcookie("status", "", time()-3600);
                    ?>
                </div>
            <?php
                } else if ($_COOKIE["status"] == "failure") {
            ?>
                    <div class="alert alert-danger">
                        Deletion failed
                    </div>
            <?php
                    setcookie("delete", "", time()-3600);
                    setcookie("status", "", time()-3600);
                }
            }
            ?>

        <?php
            $table = $_GET['table'];
            if ($table == "Person") {
                ?>
                <input type="button" onclick="location.href='edit_row.php?table=Person&person=new'" 
                value="Add Person" class="btn btn-small pull-right" style="background-color: green; color: white">
        <?php
            } else if ($table == "MarriedTo") {
        ?>
            <input type="button" onclick="location.href='edit_row.php?table=MarriedTo&husband=new&wife=new'" 
                value="Add Marriage" class="btn btn-small pull-right" style="background-color: green; color: white">
        <?php
            } else if ($table == "House") {
        ?>
                <input type="button" onclick="location.href='edit_row.php?table=House&house=new'" 
                value="Add House" class="btn btn-small pull-right" style="background-color: green; color: white">  
        <?php 
            }
        ?>
        <?php echo '<h2 style="text-align: center">Edit "' . $table . '" Table</h2>'; ?>
        <table class="table table-striped table-hover">
            <?php
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
                } else if ($table == "Person") {
                    echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>House</th>";
                    echo "<th>Birthyear</th>";
                    echo "<th></th><th></th>";
                    echo "</tr>";

                    $sql = "SELECT * FROM Person";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row[0] . "</td>";
                        echo "<td>" . $row[1] . "</td>";
                        echo "<td>" . $row[2] . "</td>";
                        echo "<td><a href='edit_row.php?table=Person&person=" . $row[0] . "'>Edit</a></td>";
                        echo "<td><a href='delete_row.php?table=Person&person=" . $row[0] . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else if ($table == "MarriedTo") {
                    echo "<tr>";
                    echo "<th>Husband</th>";
                    echo "<th>Wife</th>";
                    echo "<th>Season</th>";
                    echo "<th></th><th></th>";
                    echo "</tr>";

                    $sql = "SELECT * FROM MarriedTo";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row[0] . "</td>";
                        echo "<td>" . $row[1] . "</td>";
                        echo "<td>" . $row[2] . "</td>";
                        echo "<td><a href='edit_row.php?table=MarriedTo&husband=" . $row[0] . "&wife=" . $row[1] . "'>
                        Edit</a></td>";
                        echo "<td><a href='delete_row.php?table=MarriedTo&husband=" . $row[0] . "&wife=" . $row[1] . "'>
                        Delete</a></td>";
                        echo "</tr>";
                    }
                }
            ?>
        </table>
    </div>
    </body>
</html>

<?php
    mysqli_close($con);
?>