<?php
session_start();
require "database/database.php";
$chane = $_SESSION["accout"];
$result = json_decode($chane);
if (isset($_POST["update"])) {
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$phone = $_POST["phone"];
	$age = $_POST["age"];
	$email = $_POST["email"];

	$sqlu = "UPDATE  `users` set firstname='$firstname',lastname='$lastname',phone='$phone',age=$age,email='$email' WHERE  id=" . $result[0][0];
	$db->query($sqlu);
	$result[0][3] = $firstname;
	$result[0][4] = $lastname;
	$result[0][5] = $phone;
	$result[0][6] = $age;
	$result[0][7] = $email;
}


?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="shortcut icon" type="image/jpg" href="https://cdn2.vectorstock.com/i/1000x1000/36/91/images-of-bamboo-clipart-vector-2253691.jpg" />
	<meta charset="utf-8">
</head>

<body style="display: flex;justify-content: center;">


	<form action="" method="post" style="display: flex;flex-direction: column; height: 400px;width: 400px;">
		<img src="../<?php echo $result[0][9] ?>" style="height: 100px;width: 100px;border-radius: 90px;">

		<b>Firstname</b>
		<input type="" name="firstname" value="<?php echo $result[0][3] ?>">
		<b>Lastname</b>
		<input type="" name="lastname" value="<?php echo $result[0][4] ?>">
		<b>Phone</b>
		<input type="" name="phone" value="<?php echo $result[0][5] ?>">
		<b>Age</b>
		<input type="" name="age" value="<?php echo $result[0][6] ?>">
		<b>Email</b>
		<input type="" name="email" value="<?php echo $result[0][7] ?>">
		<button name="update">Update</button>
		<a href="../">back</a>

	</form>


</body>

</html>