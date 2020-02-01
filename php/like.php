<?php
 require "database/database.php";
 

if (isset($_GET["like"])) {
	$arin=json_decode($_GET["like"]);
 $id=(integer)$arin[1];
 $l=(integer)$arin[1];

 $sqli = "SELECT *FROM `image` where id=".$id;
 $resulti = $db -> query($sqli) -> fetch_all();  



					
						$AR=(array)json_decode($resulti[0][6]);
					
						$idu= (integer)$arin[0];
						
						array_push($AR,$idu);
						echo json_encode($AR);
						$ARU=json_encode($AR);
						$sqlu = "UPDATE  `image` set liked='".$ARU."' WHERE  id=".$l;

						$resultu = $db -> query($sqlu);
						echo $resultu;
	
}
if (isset($_GET["dislike"])) {

	$arin=json_decode($_GET["dislike"]);
	 $id=$arin[1];
	 $sqli = "SELECT *FROM `image` where id=".$id;
	 $resulti = $db -> query($sqli) -> fetch_all(); 
	
	$idu=(integer)$arin[0];
	$l=(integer)$arin[1];
	
	$AR=json_decode($resulti[0][6]);
	for ($i=0; $i <count($AR) ; $i++) { 
		if ((integer)$AR[$i]==$idu) {
			$likear=(array)json_decode($resulti[0][6]);
			unset($likear[$i]);
			$arupdate=json_encode($likear);
			echo json_encode($likear);
			$sqldis = "UPDATE  `image` set liked='".$arupdate."' WHERE  id=".$l;

			$resultu = $db -> query($sqldis);
		}
	}
		
			
					
}
header("location: ../Main.php");
