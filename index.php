<?php
    require_once("config.php");
    session_start();
?>

<html>
    <head>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <title>Game of Thrones</title>
    </head>

    <body>
        <a href="login.html">Login</a>
        <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
                echo(" | "); 
                echo("<a href='edit.php'>Edit</a>");
                echo(" | ");
                echo("<a href='logout.php'>Logout</a>");
            }
        ?>
        <h3>FORM</h3>
        <form name = "searchform" action = "search.php" method = "POST">
            <select name="drop">
              <option value="volvo">Volvo</option>
              <option value="saab">Saab</option>
              <option value="mercedes">Mercedes</option>
              <option value="audi">Audi</option>
            </select>    
            Text: <br/><input type = "text" name = "text" maxlength = "50" required><br /> <br/>
            <input type = "submit" class="btn btn-default" name = "submit" value = "Submit">
        </form>
        <?php
            $sql = "SELECT * FROM Person";

            $result = mysqli_query($con, $sql);
        ?>
        <h3>SEARCH FORM</h3>
        <form name = "searchform" action = "search.php" method = "POST">
            <!-- Username: <br/><input type = "text" name = "username" maxlength = "50" required><br />  -->
            Text: <br/><input type = "text" name = "text" maxlength = "50" required><br /> <br/>
            <input type = "submit" class="btn btn-default" name = "submit" value = "Submit">
        </form>
        <?php
            while($row = mysqli_fetch_array($result)) {
                echo $row['p_name'];
                echo " " . $row['birthyear'];
                echo "<br>";
            }
        ?>
    </body>
</html>

<?php
    mysqli_close($con);
?>
