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
        <a href="login.html" id="login">Login</a>
        <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
                echo("<a href='edit.php'>Edit</a>");
                echo(" | ");
                echo("<a href='logout.php'>Logout</a>");
                ?>
                <script>
                    $("#login").hide();
                </script>
                <?php
            }
        ?>

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
          <li><a href="#">Admin</a></li>
        </ul>
      </div>
    </nav>

<p>Created for CS4750 at the University of Virginia.</p>      
<p>Written by Kyle West, Scott Mallory, Tyler Crawford</p>      
  
<div class="container"> 
<center>
    <img src="images/GoT_logo.png" width="800">
</center>
</div>

<div class="container"> 
  <br>
  <p><button type="button" class="btn btn-default"><a href="connect_test.php">Check Database Availability</a></button></p>   
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
