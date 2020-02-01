	<!DOCTYPE html>
	<html>

	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/themelogin.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="shortcut icon" type="image/jpg" href="https://cdn2.vectorstock.com/i/1000x1000/36/91/images-of-bamboo-clipart-vector-2253691.jpg" />
		<link rel="stylesheet" type="text/css" href="../Css/home.css">
	</head>

	<body style="display: flex;flex-direction: column;justify-content: center">

		<div style="width: 1920px;">
			<div>

			<div class="header" id="header">
				<img src="image/iconlogo.png" style="height: 80px;width: 80px;">
				<h3 style=" color: white;font-family: Florence, cursive">BAMBOO</h3>
				<ul>
					<li style="list-style-type: none;">

					</li>

				</ul>
				<div id="fisrt">
					<button style="margin-top: 18px;" onclick="loginform()">Login</button>
				</div>
			</div>


			<div style="display: flex;">
				<img src="image/login.png" style="position: absolute; z-index: -1; left: 300; width: 206px;height: 382px;">

				<div class="login-form" id="login-form">


					<form action="" method="post">
						<h1 style="color: white;font-family: Florence, cursive">VN BamBoo</h1>
						<div style="display: flex;flex-direction: column;">
							<input class="inputf" type="" name="username">
							<input class="inputf" type="password" name="password">
						</div>
						<div style="display: flex;flex-direction: column;">
							<button name="check" style="font-family: Florence, cursive" class="login-b" value="<?php echo $countlogin ?>"> Login </button>

							<button name="signin" style="font-family: Florence, cursive" class="signin-b" onclick="hideloginform()">Sign in</a></button>
						</div>

					</form>


				</div>
				<div id="body">
					<?php require "php/signin.php" ?>
				</div>
			</div>
			

		</div>





		<?php
		require "php/model/class.php";
		session_start();
		if (isset($_POST["logout"])) {
			session_unset();
			session_destroy();
		}

		if (isset($_SESSION["accout"])) {
			header("location: Main.php");
		}
		if (isset($_POST["signin-bi"])) {


			if (isset($_POST["firstname"]) != "" && isset($_POST["lastname"]) != "" && isset($_POST["phone"]) != "" && isset($_POST["age"]) != "" && isset($_POST["email"]) != "" && isset($_POST["gender"]) != "") {
				$user = new User();

				$user->usernames = $_POST["username"];
				$user->passwords = $_POST["password"];
				$user->firstname = $_POST["firstname"];
				$user->lastname = $_POST["lastname"];
				$user->phone = $_POST["phone"];
				$user->age = $_POST["age"];
				$user->email = $_POST["email"];
				$user->gender = $_POST["gender"];

				$tmp_name = $_FILES["avata"]["tmp_name"];
				$fname = basename($_FILES["avata"]["name"]);


				if (move_uploaded_file($tmp_name, "image/" . $fname)) {
					echo "The file " . basename($_FILES["avata"]["name"]) . " has been uploaded.";
				}

				$servername = "localhost";
				$username = "root";
				$password = "";
				$database = "socialnet";

				$db = new mysqli($servername, $username, $password, $database);
				$sql = "INSERT INTO `users`(username,passwords,firstname,lastname,phone,age,email,gender,avata) values ('" . $user->usernames . "','" . $user->passwords . "','" . $user->firstname . "','" . $user->lastname . "','" . $user->phone . "','" . $user->age . "','" . $user->email . "','" . $user->gender . "'," . "'" . "image/" . $fname . "'" . ")";
				$db->query($sql);
				$userar = $user->email;
				echo "dang ky tc!";
				header("location: Mailer/sendmail.php?id=" . $userar);
			} else {
				echo "error sign up!";
			}
		}

		$countlogin = 2;
		require "php/database/database.php";
		if (isset($_POST["signin"])) {
			$countlogin = 1;
			require "php\signin.php";
		}
		if (isset($_POST['check'])) {
			if (isset($_POST['username']) && isset($_POST['password'])) {
				if (isset($_POST['check']) == 1) {
					$countlogin = $_POST['check'];
					# code...
				} else {
					$countlogin = 0;
				}

				$ktra = 0;
				$username = $_POST["username"];
				$password = $_POST["password"];

				$sql = "SELECT *FROM `users` where username" . "=" . "'" . $username . "'" . "AND passwords=" . "'" . $password . "'";
				$result = $db->query($sql)->fetch_all();

				if ($result != null) {
					$_SESSION["accout"] = json_encode($result);

					$countlogin = 1;
					$ktra++;

					header("location: Main.php");
				}
			}
			if ($ktra == 0) {
				require "php\worng.php";
			}
		}

		?>
	</div>





		<script>
			document.getElementById("login-form").style.display = "none";
			if (<?php echo $countlogin ?> == 1) {
				document.getElementById("fisrt").style.display = "none";
				document.getElementById("header").style.display = "none";
			}



			function loginform() {
				document.getElementById("login-form").style.display = "flex";
				document.getElementById("fisrt").style.display = "none";

				document.getElementById("body").style.display = "none";
			}

			function hideloginform() {
				document.getElementById("login-form").style.display = "none";
				document.getElementById("fisrt").style.display = "none";
				document.getElementById("header").style.display = "none";

			}
		</script>
	</body>

	</html>