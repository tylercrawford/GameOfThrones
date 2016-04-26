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
      function myFunction(id) {
        var doc_id = id.replace(" ", "_");
        $("#images > *").hide();
        $("#"+doc_id).show();
      }
      function myFunction2(id) {
        var doc_id = id.replace(" ", "_");
        document.location = "view_kingdom.php?kingdom="+id;
      }
      function myFunction3(id) {
        var doc_id = id.replace(" ", "_");
        document.location = "view_house.php?house=Nights Watch";
      }
    </script>
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
          <li><a href="./statistics.php">Statistics</a></li>
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
      <h3>Explore the Seven Kingdoms</h3>
      <table> 
        <tr>
          <td>
            <table class="table table-hover">
            <?php
              $sql = "SELECT * FROM Kingdom WHERE Kingdom.leige_lord IS NOT Null ORDER BY k_name";
              $result = mysqli_query($con, $sql);
              while($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                  <td width='400' height='65' onMouseOver="myFunction('<?php echo $row['k_name']; ?>')" onClick="myFunction2('<?php echo $row['k_name']; ?>')"><?php echo $row['k_name']; ?></td>
                </tr>
                <?php
              } 
              ?>
              <tr>
                  <td width='400' height='65' onMouseOver="myFunction('westeros')" onClick="myFunction3('Nights Watch')">The Wall</td>
                </tr>
              </table>
          </td>
          <td>
            <div id="images">
              <div id="westeros">
                <img src="images/westeros.png" width="360">
              </div>
              <div id="The_North" hidden="true">
                <img src="images/The North.png" width="360" >
              </div>
              <div id="The_Reach" hidden="True">
                <img src="images/The Reach.png" width="360" >
              </div>
              <div id="Dorne" hidden="True">
                <img src="images/Dorne.png" width="360" >
              </div>
              <div id="The_Vale" hidden="true">
                <img src="images/The Vale.png" width="360" >
              </div>
              <div id="The_Riverlands" hidden="true">
                <img src="images/The Riverlands.png" width="360" >
              </div>
              <div id="The_Stormlands" hidden="true">
                <img src="images/The Stormlands.png" width="360" >
              </div>
              <div id="The_Westerlands" hidden="true">
                <img src="images/The Westerlands.png" width="360" >
              </div>

            </div>
          </td>
        </tr>
      </table>
    </center>
  </body>
</html>
<?php
    mysqli_close($con);
?>
