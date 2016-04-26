
<html>
  <head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <script type="text/javascript">
      
      function myFunction2(id) {
            $("#lords > *").hide();
            var season = "season_"+id;

            $("#"+season).show();
            $("#season").text('Season ' + id);
      }
      function myFunction(id) {
        var doc_id = id.replace(" ", "_");
        document.location = "view_person.php?name="+id;
      }

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
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" id="season" >Season
            </a>
            <ul class="dropdown-menu">
              <center>
              <li><p onClick="myFunction2('1')">Season 1</p></li>
              <li><p onClick="myFunction2('2')">Season 2</p></li>
              <li><p onClick="myFunction2('3')">Season 3</p></li>
              <li><p onClick="myFunction2('4')">Season 4</p></li>
              <li><p onClick="myFunction2('5')">Season 5</p></li>
            </ul>
          </li>
          <li><a href="http://plato.cs.virginia.edu/~cpm4er/view/view.html">View Tables</a></li>
          <li><a href="http://plato.cs.virginia.edu/~cpm4er/edit/edit.html">Edit Tables</a></li>
        </ul>
      </div>
    </nav>
    <center>

      <h3>House <?php echo $_GET['house']; ?></h3>
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
