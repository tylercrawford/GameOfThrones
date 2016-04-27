<?php
session_start();
if (isset($_SESSION["season"])):
  $season_number = $_SESSION["season"];
  //echo " is logged in the session";
else:
  // No user is logged in, thus redirect to home.php
  $_SESSION["season"] = 1;
  $season_number = $_SESSION["season"];

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
      function viewHouse(id) {
        var doc_id = id.replace(" ", "_");
        document.location = "view_house.php?house="+id;
      }
      function viewKingdom(id) {
        var doc_id = id.replace(" ", "_");
        document.location = "view_kingdom.php?kingdom="+id;
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
          <li><a href="./index.php">Home</a></li>
          <li class="active"><a href="./kingdoms.php">Explore</a></li>
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

      <h3><?php echo $_GET['name']; ?></h3>
      <table> 
        <tr>
          <td>
            <table class="table">
            <?php
                $name = $_GET["name"];
                $sql = "SELECT * FROM Person WHERE p_name='".$name."'";


                $result = mysqli_query($con, $sql);

                while($row = mysqli_fetch_array($result)) {
                  $name = $row["p_name"];
                  $house = $row["house"];
                  $birth = $row["birthyear"];
                ?>
                
                <tr>
                  <?php
                  if ($birth) {
                    echo "<td width='400' height='40'><b>Born: </b>". $birth ." AC</td>";
                  }
                  else {
                    echo "<td width='400' height='40'><b>Born: </b> unknown</td>";

                  }
                  ?>
                </tr>
                <?php
                }

                $sql = "SELECT * FROM Death WHERE name='".$name."' AND season <= " . $season_number . "";
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                  echo "<tr><td><b>Status: Dead</b></td></tr>";
                  while($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Killed by ".$row["killer"]."</td></tr>";
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manner: ".$row["manner"]."</td></tr>";
                  } 
                }
                else {
                  echo "<tr><td><b>Status: Alive</b></td></tr>";
                }
                $sql = "SELECT * FROM Title WHERE name='".$name."' AND season <= " . $season_number . "";
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                  echo "<tr><td><b>Titles</b></td></tr>";
                  while($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row["title"]."</td></tr>";
                  } 
                }
                $sql = "SELECT * FROM LoyalTo WHERE p_name='".$name."' AND season <= " . $season_number . "";
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                  echo "<tr><td><b>Loyal To</b></td></tr>";
                  while($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row["house"]."</td></tr>";
                  } 
                }
                $sql = "SELECT * FROM Alias WHERE name='".$name."'";
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                  echo "<tr><td><b>Also known as</b></td></tr>";
                  while($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row["alias"]."</td></tr>";
                  } 
                }
                $sql = "(SELECT wife AS 'spouse' FROM MarriedTo WHERE husband = '".$name."' AND season <= ". $season_number ." ORDER BY season DESC LIMIT 1) UNION (SELECT husband AS 'spouse' FROM MarriedTo WHERE wife = '".$name."' AND season <= ".$season_number." ORDER BY season DESC LIMIT 1)";
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                  echo "<tr><td><b>Married To</b></td></tr>";
                  while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr><td onClick="viewPerson('<?php echo $row["spouse"]; ?>')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["spouse"]; ?></td></tr>
                    <?php
                  } 
                }
                $sql = "SELECT * FROM FoughtIn JOIN Battle WHERE FoughtIn.battle = Battle.b_name AND Battle.season <= ".$season_number." AND FoughtIn.p_name = '".$name."'";
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                  echo "<tr><td><b>Fought In</b></td></tr>";
                  while($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row["b_name"]."</td></tr>";
                  } 
                }
                $sql = "SELECT * FROM ChildTo WHERE mother = '".$name."' OR father = '".$name."'";
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                  echo "<tr><td><b>Children</b></td></tr>";
                  while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr><td onClick="viewPerson('<?php echo $row["name"]; ?>')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["name"]; ?></td></tr>
                    <?php
                  } 
                }
                $sql = "SELECT * FROM ChildTo WHERE name = '".$name."'";
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                  while($row = mysqli_fetch_array($result)) {
                    $mother = $row["mother"];
                    if ($mother == "") {
                      $mother = "unknown";
                    }
                    $father = $row["father"];
                    if ($father == "") {
                      $father = "unknown";
                    }

                    echo "<tr><td><b>Mother: </b>".$mother."&nbsp;&nbsp;&nbsp;&nbsp;<b>Father: </b>".$row["father"]."</td></tr>";
                  } 
                }
                
                ?>

              
              
              </table>
          </td>
          <td>
            <div id="images">
              <div id="sigil" hidden="true">
                <img src="images/<?php echo $house; ?>_sigil.png" width="300">
              </div>
              <div id="no_sigil">
                <img src="images/no_sigil.png" width="300">
              </div>
            </div>
            <center>
            <?php
                $sql = "SELECT * FROM House WHERE h_name='".$house."'";
                $result = mysqli_query($con, $sql);

                while($row = mysqli_fetch_array($result)) {
                  ?>
                  <p onClick="viewHouse('<?php echo $row["h_name"]; ?>')">
                    <b>House:</b> <?php echo $row['h_name']; ?> <br></p>
                  <p>
                    <b>Castle:</b> <?php echo $row['castle']; ?> <br></p>
                  <p onClick="viewKingdom('<?php echo $row["kingdom"]; ?>')">
                    <b>Kingdom:</b> <?php echo $row['kingdom']; ?> <br></p>

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
