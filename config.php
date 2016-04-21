<?php
    $con = new mysqli('stardock.cs.virginia.edu', 'cs4750sam4ku', 'scott', 'cs4750sam4ku');
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MYSQL: " . mysqli_connect_error();
    }
?>