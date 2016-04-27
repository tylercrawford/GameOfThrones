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
      
      // function myFunction2(id) {
      //       $("#lords > *").hide();
      //       var season = "season_"+id;

      //       $("#"+season).show();
      //       $("#season").text('Season ' + id);
      // }
      function myFunction(id) {
        var doc_id = id.replace(" ", "_");
        document.location = "view_person.php?name="+id;
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
        $("#lords > *").hide();
        var season = "season_"+season_val;

        $("#"+season).show();
      }
      $(document).ready(function(){
        $("#season").text('Season ' + <?php echo $season_number; ?>);
        $("#lords > *").hide();
        var season = "season_"+<?php echo $season_number; ?>;

        $("#"+season).show();
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
          <li class="active"><a href="./kingdoms.php">Explore</a></li>
          <li><a href="./search.html">Search</a></li>
          <li><a href="./statistics.php">Statistics</a></li>
          <li style="float:right">
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
      <?php
        $house = $_GET['house'];
        if ($house == "Nights Watch") {
          echo "<h3>The Night's Watch</h3>";
        }
        else {
          echo "<h3>House ".$house."</h3>";

        }
      ?>
        <div id="lords">
            <div id="season_1">
                <?php
                    $house = $_GET["house"];
                    $sql = "SELECT * FROM Lord WHERE house='" . $house . "' AND season <= " . 1 . " ORDER BY season DESC LIMIT 1";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_array($result)) {
                        echo "<h4>Lord is " . $row["p_name"] . "</h4>";
                    }
                ?>
            </div>
            <div id="season_2" hidden="true">
                <?php
                    $house = $_GET["house"];
                    $sql = "SELECT * FROM Lord WHERE house='" . $house . "' AND season <= " . 2 . " ORDER BY season DESC LIMIT 1";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_array($result)) {
                        echo "<h4>Lord is " . $row["p_name"] . "</h4>";
                    }
                ?>
            </div>
            <div id="season_3" hidden="true">
                <?php
                    $house = $_GET["house"];
                    $sql = "SELECT * FROM Lord WHERE house='" . $house . "' AND season <= " . 3 . " ORDER BY season DESC LIMIT 1";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_array($result)) {
                        echo "<h4>Lord is " . $row["p_name"] . "</h4>";
                    }
                ?>
            </div>
            <div id="season_4" hidden="true">
                <?php
                    $house = $_GET["house"];
                    $sql = "SELECT * FROM Lord WHERE house='" . $house . "' AND season <= " . 4 . " ORDER BY season DESC LIMIT 1";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_array($result)) {
                        echo "<h4>Lord is " . $row["p_name"] . "</h4>";
                    }
                ?>
            </div>
            <div id="season_5" hidden="true">
                <?php
                    $house = $_GET["house"];
                    $sql = "SELECT * FROM Lord WHERE house='" . $house . "' AND season <= " . 5 . " ORDER BY season DESC LIMIT 1";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_array($result)) {
                        echo "<h4>Lord is " . $row["p_name"] . "</h4>";
                    }
                ?>
            </div>
        </div>


      <table> 
        <tr>
          <td>
            <table class="table table-hover">
            <?php
                $house = $_GET["house"];
                $sql = "SELECT * FROM Person WHERE house='".$house."'";


                $result = mysqli_query($con, $sql);

                while($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                  <td width='400' height='40' onClick="myFunction('<?php echo $row['p_name']; ?>')"><?php echo $row['p_name']; ?></td>
                </tr>
                <?php
              } 
              ?>
              </table>
          </td>
          <td>
            <div id="images">
              <div id="sigil" hidden="true">
                <img src="images/<?php echo $_GET['house']; ?>_sigil.png" width="300">
              </div>
              <div id="no_sigil">
                <img src="images/no_sigil.png" width="300">
              </div>
            </div>
            <center>
            <?php
                $house = $_GET["house"];
                $sql = "SELECT * FROM House WHERE h_name='".$house."'";
                $result = mysqli_query($con, $sql);

                while($row = mysqli_fetch_array($result)) {
                    echo "<b>Words:</b> " . $row['words'] . "<br>";
                    echo "<b>Castle: </b>" . $row['castle'] . "<br>";
                    echo "<b>Kingdom: </b>" . $row['kingdom'];
                    ?>
                    <script type="text/javascript">
                        var image = <?php echo $row['image']; ?>;
                        if (image) {
                            $("#sigil").show();
                            $("#no_sigil").hide();
                        }
                    </script>
                    <?php
                } 
              ?>

          </td>
        </tr>
      </table>
    </center>
  </body>
</html>
<?php
    mysqli_close($con);
?>
