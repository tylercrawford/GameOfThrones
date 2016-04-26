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
          <li class="active"><a href="http://plato.cs.virginia.edu/~cpm4er/">Home</a></li>
          <li><a href="http://plato.cs.virginia.edu/~cpm4er/view/view.html">View Tables</a></li>
          <li><a href="http://plato.cs.virginia.edu/~cpm4er/edit/edit.html">Edit Tables</a></li>
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
            <table class="table table-hover">
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
                  <td width='400' height='40'><?php echo $row['p_name']; ?></td>
                </tr>
                <tr>
                  <td width='400' height='40'><?php echo $house; ?></td>
                </tr>
                <tr>
                  <td width='400' height='40'><?php echo $birth; ?></td>
                </tr>
                <?php
                }
                $sql = "SELECT * FROM Title WHERE name='".$name."' AND season <= " . $season_number . "";
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                  echo "<tr><td>Titles!!!!</td></tr>";
                  while($row = mysqli_fetch_array($result)) {
                    echo $row["title"];
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
                    echo "<b>House:</b> " . $row['h_name'] . "<br>";
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
