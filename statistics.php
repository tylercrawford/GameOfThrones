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
      function download() {
        var season_val = <?php echo $season_number ?>;
        // alert(season_val);
        document.location = "statistics_download.php?season="+season_val;

      }
      function viewPerson(id) {
        var doc_id = id.replace(" ", "_");
        document.location = "view_person.php?name="+id;
      }
      function showDeath() {
        if ($("#deaths").is(':visible')) {
          $("#deaths").hide();
        }
        else {
          $("#deaths").show();
        }
      }
      function showMarriages() {
        if ($("#marriages").is(':visible')) {
          $("#marriages").hide();
        }
        else {
          $("#marriages").show();
        }
      }
      function showBattles() {
        if ($("#battles").is(':visible')) {
          $("#battles").hide();
        }
        else {
          $("#battles").show();
        }
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
          <li ><a href="./index.php">Home</a></li>
          <li><a href="./kingdoms.php">Explore</a></li>
          <li><a href="./search.html">Search</a></li>
          <li class="active"><a href="./statistics.php">Statistics</a></li>
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
      <h3>Statistics  <button class="btn btn-default" id="download" onClick="download()">Download</button>
</h3>
      <table class="table">
        <tr >
          <th onClick="showDeath()">Deaths</th>
          <th onClick="showMarriages()">Marriages</th>
          <th onClick="showBattles()">Battles</th>
        </tr>
        <tr>
          <td width="400">
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
          </td>
          <td width="400">
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
          </td>
          <td width="400">
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
          </td>
        </tr>
        <tr>
          <td width="400">
            <table id="deaths" hidden="true" class="table">
              <?php
              $sql = "SELECT * FROM Death WHERE season <= ".$season_number." ORDER BY season DESC";
              $result = mysqli_query($con, $sql);

              while($row = mysqli_fetch_array($result)) {
                echo "<tr><td><b>". $row["name"] . "</b> was killed by <b>" . $row["killer"] . "</b></td></tr><tr><td>Manner: " . $row["manner"] . "</td></tr><tr><td>Season: " . $row["season"] . "</td></tr>";
              }
            ?>
            </table>
          </td>
          <td width="200">
            <table id="marriages" hidden="true" class="table">
              <?php
              $sql = "SELECT * FROM MarriedTo WHERE season <= ".$season_number." ORDER BY season DESC";
              $result = mysqli_query($con, $sql);

              while($row = mysqli_fetch_array($result)) {
                echo "<tr><td><b>". $row["husband"] . "</b> got married to <b>" . $row["wife"] . "</b></td></tr><tr><td>Season: " . $row["season"] . "</td></tr>";
              }
            ?>
            </table>
          </td>
          <td width="200">
            <table id="battles" hidden="true" class="table">
              <?php
              $sql = "SELECT * FROM Battle WHERE season <= ".$season_number." ORDER BY season DESC";
              $result = mysqli_query($con, $sql);

              while($row = mysqli_fetch_array($result)) {
                echo "<tr><td><b>". $row["b_name"] . "</b> </td></tr><tr><td>Victor: <b>" . $row["winner"] . "</b></td></tr><tr><td>Season: " . $row["season"] . "</td></tr>";
              }
            ?>
            </table>
          </td>
        </tr>
      </table>
    </center>
  </body>
</html>
<?php
    mysqli_close($con);
?>
