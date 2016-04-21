
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
    $("#images > *").hide();
    $("#The Vale").show();

    </script>
  </head>

  <?php
    require_once("config.php");
  ?>

  <body>
    <center>
      <h3>Houses of the <?php echo $_GET['kingdom']; ?></h3>
      <table> 
        <tr>
          <td>
            <table class="table table-hover">
            <?php
                $kingdom = $_GET["kingdom"];
                $sql = "SELECT * FROM House WHERE kingdom='".$kingdom."'";


                $result = mysqli_query($con, $sql);

                while($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                  <td width='400' height='70' onMouseOver="myFunction('<?php echo $row['h_name']; ?>')" onClick="myFunction2('<?php echo $row['h_name']; ?>')"><?php echo $row['h_name']; ?></td>
                </tr>
                <?php
              } 
              ?>
              </table>
          </td>
          <td>
            <div id="images">
              <div id="westeros">
                <img src="westeros.png" width="400">
              </div>
              <div id="The_North" hidden="true">
                <img src="The North.png" width="400" >
              </div>
              <div id="The_Reach" hidden="True">
                <img src="The Reach.png" width="400" >
              </div>
              <div id="Dorne" hidden="True">
                <img src="Dorne.png" width="400" >
              </div>
              <div id="The_Vale" hidden="true">
                <img src="The Vale.png" width="400" >
              </div>
              <div id="The_Riverlands" hidden="true">
                <img src="The Riverlands.png" width="400" >
              </div>
              <div id="The_Stormlands" hidden="true">
                <img src="The Stormlands.png" width="400" >
              </div>
              <div id="The_Westerlands" hidden="true">
                <img src="The Westerlands.png" width="400" >
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
