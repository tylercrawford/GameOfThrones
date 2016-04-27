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
        <script>
            function submit_drop() {
                var table = $("#dropdown").val();
                $("#table").val(table);
                $("#edit_form").submit();
            }
        </script>
        <br>
        <form name="edit_form" action="edit_table.php" method="GET" id="edit_form">
            <div class="col-sm-2" style="text-align: center">
                <h2 style='text-align: center'>Edit table:</h2>
                <select onchange="submit_drop()" id="dropdown" class="form-control" style="text-align: center">
                    <option>-- Select --</option>
                    <option>Person</option>
                    <option>House</option>
                    <option>MarriedTo</option>
            </select>
            </div>
            <input type="hidden" name="table" id="table">
            <input hidden type="submit" value="hi">
        </form>
    </body>
</html>