<!DOCTYPE html>
<html>
<head>
  <?php session_start(); ?>
	<title>Login</title>
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
          <li class="active"><a href="./index.php">Home</a></li>
          <li><a href="./kingdoms.php">Explore</a></li>
          <li><a href="./search.html">Search</a></li>
          <li><a href="./statistics.php">Statistics</a></li>
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
    
  <div class="container" style="text-align: center; margin-left: auto; margin-right: auto; width: 500px">
    <?php
        if (isset($_COOKIE["loginerror"])) {
            echo "<div class='alert alert-danger'>" . $_COOKIE["loginerror"] . "</div>";
            setcookie("loginerror", "", time()-3600);
        }
    ?>
  <h2>Log in</h2>
  <br>
  <form name = "loginform" action = "verify.php" method = "POST">
      <h4>Name: </h4><input type = "text" name = "username" maxlength = "50" class="form-control" required><br />
      <h4>Password: </h4><input type = "password" name = "password" maxlength = "50" class="form-control" required><br /> <br/>
      <input type = "submit" class="btn btn-default" name = "submit" value = "Submit">
  </form>
</div>
</body>

</html>