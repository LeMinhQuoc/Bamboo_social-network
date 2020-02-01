	<!DOCTYPE html>
	<html>

	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/jpg" href="https://cdn2.vectorstock.com/i/1000x1000/36/91/images-of-bamboo-clipart-vector-2253691.jpg" />
	</head>

	<body>
		<?php
		require "database/database.php";
		session_start();
		if (isset($_POST["logout"])) {
			session_unset();
			session_destroy();

			header("location: ../index.php");
		}

		if (isset($_POST["upfile"])) {
			$tmp_name = $_FILES["images"]["tmp_name"];
			$fname = basename($_FILES["images"]["name"]);

			move_uploaded_file($tmp_name, "../image/" . $fname);
			$id = $_POST['id'];
			$status = $_POST['status'];

			echo $id;
			$sql = "INSERT INTO image(userid,image,ustatus) VALUES (" . $id . ",'image/" . $fname . "','" . $status . "')";
			$db->query($sql);
			header("location: ../Main.php");
		}

		?>




	</body>

	</html>