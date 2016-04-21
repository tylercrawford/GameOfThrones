<?php
require_once("config.php");
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM Person WHERE p_name like '" . $_POST["keyword"] . "%' ORDER BY p_name";
$result = mysqli_query($con, $query);
if(!empty($result)) {
?>
<ul id="name-list" class="list-group">
<?php
foreach($result as $name) {
?>
<li class="list-group-item" onClick="selectPerson('<?php echo $name["p_name"]; ?>');"><?php echo $name["p_name"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>