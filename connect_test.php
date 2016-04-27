<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

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
          <li><a href="./statistics.html">Statistics</a></li>
        </ul>
      </div>
    </nav>

<div class="container">
  <h1>Database Status</h1>

  <div class="alert alert-success">
<?php
    $server = "stardock.cs.virginia.edu";
    $con = new mysqli($server, 'cs4750sam4ku', 'scott', 'cs4750sam4ku');
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MYSQL: " . mysqli_connect_error();
    }
    echo "Successfully connected to <strong>" . $server . "!</strong>";
?>
  </div>
</div>

</body>
</html>