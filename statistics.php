<?php
session_start();
if (isset($_SESSION["season"])):
  $season_number = $_SESSION["season"];
  //echo " is logged in the session";
else:
  // No user is logged in, thus redirect to home.php
  $_SESSION["season"] = 1;
endif;  
?>


<html>
  <head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <script type="text/javascript">
      function seasonChange(season) {
        var season_val = season;
        // alert(season_val);
        $.ajax({
          type:"POST",
          url: "season.php",
          data: {season : season_val},
            success: function(data) {
              // alert(data);
            }
          });
        $("#season").text('Season ' + season);
        document.location.reload(true);
      }
      function viewPerson(id) {
        var doc_id = id.replace(" ", "_");
        document.location = "view_person.php?name="+id;
      }

      $(document).ready(function(){
        $("#season").text('Season ' + <?php echo $season_number; ?>);
      });
    </script>
  </head>

  <?php
    require_once("config.php");
  ?>
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
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" id="season" >Season
            </a>
            <ul class="dropdown-menu">
              <center>
              <li><p onClick="seasonChange('1')">Season 1</p></li>
              <li><p onClick="seasonChange('2')">Season 2</p></li>
              <li><p onClick="seasonChange('3')">Season 3</p></li>
              <li><p onClick="seasonChange('4')">Season 4</p></li>
              <li><p onClick="seasonChange('5')">Season 5</p></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <center>
      <h3>Deaths</h3>

      <?php
        $sql = "SELECT COUNT(name) AS count FROM Death WHERE season = ".$season_number;
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)) {
          echo "This season: ". $row["count"];
        }
        $sql = "SELECT COUNT(name) AS count FROM Death WHERE season <= ".$season_number;
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)) {
          echo "<br>To date: ". $row["count"];
        }
      ?>
      <h3>Marriages</h3>

      <?php
        $sql = "SELECT COUNT(wife) AS count FROM MarriedTo WHERE season = ".$season_number;
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)) {
          echo "This season: ". $row["count"];
        }
        $sql = "SELECT COUNT(wife) AS count FROM MarriedTo WHERE season <= ".$season_number;
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)) {
          echo "<br>To date: ". $row["count"];
        }
      ?>
      <h3>Battles</h3>

      <?php
        $sql = "SELECT COUNT(b_name) AS count FROM Battle WHERE season = ".$season_number;
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)) {
          echo "This season: ". $row["count"];
        }
        $sql = "SELECT COUNT(b_name) AS count FROM Battle WHERE season <= ".$season_number;
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)) {
          echo "<br>To date: ". $row["count"];
        }
      ?>
    </center>
  </body>
</html>
<?php
    mysqli_close($con);
?>
