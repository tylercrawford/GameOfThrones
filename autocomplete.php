<?php

require_once("config.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {   
$sql = "SELECT * FROM Person WHERE p_name like '".$_POST["keyword"]. "%'";
$results = $db_handle->runQuery($sql);
if(!empty($results)) {
?>
<ul id="name-list">
<?php
foreach($result as $name) {
?>
<li onClick="selectName('<?php echo $name["name"]; ?>');"><?php echo $name["name"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>