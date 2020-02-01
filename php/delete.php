<?php
require "database/database.php";
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$sql = "DELETE from image where id=" . $id;
	$result = $db->query($sql);
}


header("location: ../Main.php");
