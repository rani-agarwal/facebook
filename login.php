<?php
session_start();
include("classes/connect.php");
include("classes/login.php");

$email = "";
$password = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$login = new Login();
		$result = $login->evaluate($_POST);

		if($result != ""){
			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following errors occured:<br><br>";
			echo $result;
			echo "</div>";
		}else{
			header("Location: profile.php");
			die;
		}
		$email = $_POST['email'];
		$password = $_POST['password'];
	}
?>
<html>
	<head>
		<title>facebook | Log in</title>
		<link rel ="stylesheet" href="css/style.css">
	</head>
	<body style="font-family: tahoma;background-color: #e9ebee;">

		<div id="bar">
			<div style="font-size: 40px;">facebook</div>
			<a href="signup.php">
			<div id="signup_button">Signup</div>
			</a>
		</div>

		<div id="bar2">
			<form method="post">
				Log in to facebook<br><br>
				<input name="email" value="<?php echo $email ?>" type="text" id="text" placeholder="Email"><br><br>
				<input name="password" value="<?php echo $password ?>" type="password" id="text" placeholder="Password"><br><br>
				<input type="submit" id="button" value="Log in">
				<br><br><br>
			</form>
		</div>
	</body>
</html>