
<html>
  <head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <script type="text/javascript">
      
      function myFunction2(id) {
        var doc_id = id.replace(" ", "_");
        document.location = "view_house.php?house="+id;
      }
        $(document).ready(function(){
            $("#images > *").hide();
            var image = "<?php echo $_GET['kingdom']; ?>";
            var doc_id = image.replace(" ", "_");

            $("#"+doc_id).show();
       });

    </script>
  </head>

  <?php
    require_once("config.php");
  ?>

  <body>
    <center>
      <h3>Houses of the <?php echo $_GET['kingdom']; ?></h3>
            <?php
                $kingdom = $_GET["kingdom"];
                $sql = "SELECT * FROM Kingdom WHERE k_name='".$kingdom."'";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($result)) {
                    echo "<h4>Leige Lord is House " . $row["leige_lord"] . "</h4>";
                }
            ?>

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
                  <td width='400' height='70' onClick="myFunction2('<?php echo $row['h_name']; ?>')"><?php echo "House " . $row['h_name']; ?></td>
                </tr>
                <?php
              } 
              ?>
              </table>
          </td>
          <td>
            <div id="images">
              <div id="westeros">
                <img src="images/westeros.png" width="400">
              </div>
              <div id="The_North" hidden="true">
                <img src="images/The North.png" width="400" >
              </div>
              <div id="The_Reach" hidden="True">
                <img src="images/The Reach.png" width="400" >
              </div>
              <div id="Dorne" hidden="True">
                <img src="images/Dorne.png" width="400" >
              </div>
              <div id="The_Vale" hidden="true">
                <img src="images/The Vale.png" width="400" >
              </div>
              <div id="The_Riverlands" hidden="true">
                <img src="images/The Riverlands.png" width="400" >
              </div>
              <div id="The_Stormlands" hidden="true">
                <img src="images/The Stormlands.png" width="400" >
              </div>
              <div id="The_Westerlands" hidden="true">
                <img src="images/The Westerlands.png" width="400" >
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
