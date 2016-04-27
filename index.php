<?php
    require_once("config.php");
    session_start();
?>

<html>
    <head>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="style2.css"/>

        <title>Game of Thrones</title>
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


<div class="container">
  <div style="background-color:rgba(0, 0, 0, 0.5);" !important" class="jumbotron">
    <div style="opacity:1.0;">
    <h1>The Lineages and Histories of the Great Houses of the Seven Kingdoms</h1>      
    <p>Explore and search through the bloodlines and ties between the great houses that rule Westeros's vast landscape!</p>
    <p>Designed by Tyler Crawford, Scott Mallory, and Kyle West.
    </div>
  </div>
  <center>
  <p><button type="button" class="btn btn-default"><a href="connect_test.php">Check Database Availability</a></button></p>      
  </center>
</div>


<!-- <embed src="theme_music.mp3">
<noembed>
    <bgsound src="theme_music.mp3" repeat="true">
</noembed> -->

<embed src="theme_music.mp3" width="180" height="0" loop="true" autostart="true"/>
</body>
</html>


<?php
    mysqli_close($con);
?>
