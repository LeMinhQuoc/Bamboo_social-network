<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="shortcut icon" type="image/jpg" href="https://cdn2.vectorstock.com/i/1000x1000/36/91/images-of-bamboo-clipart-vector-2253691.jpg" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
		.collapsible {
			background-color: pink;
			color: white;
			border-radius: 15px;
			border: none;

		}

		.active,
		.collapsible:hover {
			background-color: #555;
		}

	

		.active:after {
			content: "\2212";
		}

		.content {
			padding: 0 18px;
			max-height: 0;
			overflow: hidden;
			transition: max-height 0.2s ease-out;
			background-color: #f1f1f1;
		}
	</style>

</head>

<body style="display: flex;justify-content: center;" class="contain">
	<div style="width: 900px;">

		<div>

			<?php
			require "php/database/database.php";


			$sqlu = "SELECT *FROM `users`";
			$userar = $db->query($sqlu)->fetch_all();


			if (isset($_SESSION["accout"]) == false) {
				session_start();
			}

			if (isset($_SESSION["accout"]) == false) {
				header('location: index.php');
			}
			$chane = $_SESSION["accout"];
			$result = json_decode($chane);


			if (isset($_POST["delete"])) {
				$id = $_POST["delete"];
				$sqli = "DELETE FROM image where id=" . $id;
				$resultimg = $db->query($sqli);
			}

			if ($result[0][10] == "admin") {
			?><div class="menu1">
					<ul>
						<li>
							<img src="">
							<a href="">Home</a>

						</li>


						<li style="display: flex; position: absolute; right: 0;">
							<div>
								<img src="<?php echo $result[0][9] ?>" style=" height: 50px;width: 50px; border-radius: 30px; border:2px solid blue;"><?php
																																						echo $result[0][3];
																																						$sqli = "SELECT *FROM `image`";
																																						$resultimg = $db->query($sqli)->fetch_all();
																																						?>
								<b><?php echo  "(Admin)" ?></b>
							</div>



							<form action="index.php" method="post" class="logout">
								<button name="logout" alt="Logout" title="Logout" style="margin-right: 300px;"><img src="image/logout.png"></button>
							</form>

						</li>
					</ul>


				</div>
				<div class="conten">
					<?php

					for ($i = 0; $i < count($resultimg); $i++) {

					?>
						<?php
						echo  '<button class="btn btn-primary">
		  				<a style="color:red;" href="php/delete.php?delete=' . $resultimg[$i][0] . '">
		  					DeletePost!
		  				</a>
		  		</button>';
						?>
						<div style="display: flex; flex-direction: column;"><img src="<?php echo $resultimg[$i][2] ?>" style="height:300px;width:400px;">
							<b><?php echo  $resultimg[$i][3] ?></b>

							<div>
								<div><?php



										$AR = (array) json_decode($resultimg[$i][6]);


										echo count($AR) . "like";


										?>
								</div>
								<form action="php/coment.php" method="post">
									<a href="#" class="collapsible">Comment</a>
									<div class="content">
										<input type="" name="commentcontent">
										<button name="userid" value="<?php echo $str ?>">send</button>


										<div><?php

												$postcomment = (array) json_decode($resultimg[$i][5]);

												for ($k = 0; $k < count($postcomment); $k++) {
													$comentandavata = $postcomment[$k];
													$index = 0;
													for ($l = 0; $l < count($userar); $l++) {

														if ($comentandavata[0] == $userar[$l][0]) {

															$index = $l;
														}
													}
												?>

												<img src="<?php echo $userar[$index][9] ?>" style="width: 30px;height: 30px">
												<div>
													<?php echo $comentandavata[1] ?>
												</div>
											<?php } ?>

										</div>

									</div>
								</form>
							</div>


						</div><?php
							}
								?>
				</div>
			<?php


			} else {

			?><form action="php/upload.php" class="menu" method="post">

					<ul>
						<li>

							<img src="image/iconlogo.PNG" style="height: 60px;width: 80px;">
							<img src="<?php echo $result[0][9] ?>" style="margin-left: 500px;height: 50px;width: 50px; border-radius: 30px; border:2px solid blue;">
							<b style="font-family:  lucida handwriting; margin-left: 20px;margin-top: 30px;"><?php echo $result[0][3]; ?></b>
							<?php

							$sqli = "SELECT *FROM `image`";
							$resultimg = $db->query($sqli)->fetch_all();
							?><?php
					echo  '
							  <button style="height:30px; margin-left:20px;margin-top:15px;"type="button" class="btn btn-info"> <i class="fas fa-info-square"></i><a href="php/detail.php ">
						  Detail
						  </a></button> 	 
						 
						  		';
					?>
							<div style="margin-left: 30px;">
								<!-- <img style="" src="image/chat-bubble.png"> -->
								<button name="logout" alt="Logout" title="Logout">
									<img style="" src="image/logout.png"></button>
							</div>


						</li>
					</ul>
				</form>

				<form action="php/upload.php" method="post" enctype="multipart/form-data">
					<input type="file" name="images" id="images" style="display: none;">
					<label for="images"><img src="image/photo-camera.png" style=" height: 15px"></label>
					<input hidden="" type="text" name="id" value="<?php echo $result[0][0] ?>">
					<input type="" name="status">
					<input type="submit" name="upfile" value="up">
				</form>
				<form action="" method="post">
					<div class="conten">

						<?php for ($i = 0; $i < count($resultimg); $i++) {
						?><div> <?php

							$sqlim = "SELECT firstname,avata FROM users where id=" . $resultimg[$i][1];
							$r = $db->query($sqlim)->fetch_all();

					?>

								<div style="width: 400px; display: flex;justify-content: space-between;">
									<div><img src="<?php echo $r[0][1] ?>" style=" height: 50px;width: 50px; border-radius: 30px; border:2px solid blue;"><b style="font-family:  lucida handwriting" ;><?php echo $r[0][0] ?></b>

									</div>


								</div>
								<div style="display: flex;flex-direction: column;align-items: center;">
									<img src="<?php echo $resultimg[$i][2] ?>" style="height:600px;width:500px; ">
									<b><?php echo  $resultimg[$i][3] ?></b>
								</div>
								<div style="display: flex; justify-content: space-between;">
									<div><?php
											$like = false;
											$idimg = (int) $resultimg[$i][0];
											$iduser = (int) $result[0][0];
											$ar = array($iduser, $idimg);
											$str = json_encode($ar);
											if (json_decode($resultimg[$i][6]) != null) {
												$AR = (array) json_decode($resultimg[$i][6]);

												for ($j = 0; $j < count($AR); $j++) {

													if ($AR[$j] == (int) $result[0][0]) {
														$like = true;
													}
												}
											} else {
												$AR = array();
											}
											if ($like == false) {
												echo count($AR);
												echo  '
			 	 <button >
		  				<a  href="php/like.php?like=' . $str . '">
		  					like
		  				</a>
		  		</button>';
											} else {
												echo count($AR);
												echo  '<button class="btn btn-primary">
		  				<a style="color:white;" href="php/like.php?dislike=' . $str . '">
		  					Dislike!<img style="height: 24px;" src="image/like (2).png"  >
		  				</a>
		  		</button>';
											}

											?>
									</div>
				</form>
				<div><?php
							$idimg = (int) $resultimg[$i][0];
							$iduser = (int) $result[0][0];
							$ar = array($iduser, $idimg);
							$str = json_encode($ar);


						?>

					<form action="php/coment.php" method="post">
						<a href="#" class="collapsible" style="height: 30px;width: 300px;">Comment</a>
						<div class="content">
							<input type="" name="commentcontent">
							<button name="userid" value="<?php echo $str ?>">send</button>


							<div><?php

									$postcomment = (array) json_decode($resultimg[$i][5]);

									for ($k = 0; $k < count($postcomment); $k++) {
										$comentandavata = $postcomment[$k];
										$index = 0;
										for ($l = 0; $l < count($userar); $l++) {

											if ($comentandavata[0] == $userar[$l][0]) {

												$index = $l;
											}
										}


									?>
									<div style=" border-radius: 4px; border:1px solid lightblue; ">
										<img src="<?php echo $userar[$index][9] ?>" style="width: 25px;height: 25px;border-radius: px;">
										<b style="margin-top: 1px;"><?php echo $userar[$index][3] ?></b>
										<div style="margin-top: 1px;">
											<?php echo $comentandavata[1] ?>
										</div>
									</div>
								<?php } ?>

							</div>

						</div>
					</form>
				</div>

		</div>
<?php
						}
					} ?>


<hr>
	</div>


</body>
<script type="text/javascript">
	var coll = document.getElementsByClassName("collapsible");
	var i;

	for (i = 0; i < coll.length; i++) {
		coll[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var content = this.nextElementSibling;
			if (content.style.maxHeight) {
				content.style.maxHeight = null;
			} else {
				content.style.maxHeight = content.scrollHeight + "px";
			}
		});
	}
</script>


</html>