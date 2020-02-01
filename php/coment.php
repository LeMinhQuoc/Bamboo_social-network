
<?php
require "database/database.php";
require "model/class.php";

if (isset($_POST["userid"])) {
	$idar = json_decode($_POST["userid"]);
	$userid = (int) $idar[0];
	$postid = $idar[1];

	echo $userid;
	echo $postid;
	echo "<br/>";
	$comentcontent = $_POST["commentcontent"];
	$sqli = "SELECT *FROM `image` where id=" . $postid;
	$resulti = $db->query($sqli)->fetch_all();

	// echo json_encode($resulti)."<br/>";
	$newComment = array($userid, $comentcontent);


	$dbArrComment = (array) json_decode($resulti[0][5]);

	array_push($dbArrComment, $newComment);
	$ARU = json_encode($dbArrComment);
	$sqlu = "UPDATE  `image` set coment='" . $ARU . "' WHERE  id=" . $postid;
	$resultu = $db->query($sqlu);
}

header("location: ../Main.php");
// if (isset($_GET["dislike"])) {

// 	$arin=json_decode($_GET["dislike"]);
// 	 $id=$arin[1];
// 	 $sqli = "SELECT *FROM `image` where id=".$id;
// 	 $resulti = $db -> query($sqli) -> fetch_all(); 

// 	$idu=(integer)$arin[0];
// 	$l=(integer)$arin[1];

// 	$AR=json_decode($resulti[0][6]);
// 	for ($i=0; $i <count($AR) ; $i++) { 
// 		if ((integer)$AR[$i]==$idu) {
// 			$likear=(array)json_decode($resulti[0][6]);
// 			unset($likear[$i]);
// 			$arupdate=json_encode($likear);
// 			echo json_encode($likear);
// 			$sqldis = "UPDATE  `image` set liked='".$arupdate."' WHERE  id=".$l;

// 			$resultu = $db -> query($sqldis);
// 		}
// 	}





?>
