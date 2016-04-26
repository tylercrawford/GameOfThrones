<?php
session_start();
if (isset($_SESSION["season"])):
  $season_number = $_SESSION["season"];
  //echo " is logged in the session";
else:
  // No user is logged in, thus redirect to home.php
  $_SESSION["season"] = 1;
endif;  

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

require_once("config.php");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Season '.$season_number. ' Statistics'));
fputcsv($output, array('Category', 'This Season', 'Total'));
$sql = "SELECT COUNT(name) AS count FROM Death WHERE season = ".$season_number;
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
   $this_season = $row["count"];
}
$sql = "SELECT COUNT(name) AS count FROM Death WHERE season <= ".$season_number;
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
	$total = $row["count"];
}
fputcsv($output, array('Deaths', $this_season, $total));


$sql = "SELECT COUNT(wife) AS count FROM MarriedTo WHERE season = ".$season_number;
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
   $this_season = $row["count"];
}
$sql = "SELECT COUNT(wife) AS count FROM MarriedTo WHERE season <= ".$season_number;
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
	$total = $row["count"];
}
fputcsv($output, array('Marriages', $this_season, $total));


$sql = "SELECT COUNT(b_name) AS count FROM Battle WHERE season = ".$season_number;
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
   $this_season = $row["count"];
}
$sql = "SELECT COUNT(b_name) AS count FROM Battle WHERE season <= ".$season_number;
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
	$total = $row["count"];
}
fputcsv($output, array('Battles', $this_season, $total));
fputcsv($output, array('','',''));
fputcsv($output, array('Deaths', '', ''));
fputcsv($output, array('Desceased', 'Killer', 'Manner', 'Season'));
$sql = "SELECT * FROM Death WHERE season <= ".$season_number." ORDER BY season DESC";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
	fputcsv($output, array($row["name"], $row["killer"], $row["manner"], $row["manner"]));
}
fputcsv($output, array('','',''));
fputcsv($output, array('Marriages', '', ''));
fputcsv($output, array('Husband', 'Wife', 'Season'));
$sql = "SELECT * FROM MarriedTo WHERE season <= ".$season_number." ORDER BY season DESC";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
	fputcsv($output, array($row["husband"], $row["wife"], $row["season"]));
}
fputcsv($output, array('','',''));
fputcsv($output, array('Battles', '', ''));
fputcsv($output, array('Name', 'Victor', 'Season'));
$sql = "SELECT * FROM Battle WHERE season <= ".$season_number." ORDER BY season DESC";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
	fputcsv($output, array($row["b_name"], $row["winner"], $row["season"]));
}

?>