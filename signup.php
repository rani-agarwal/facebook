<?php
include("classes/connect.php");
include("classes/signup.php");

$first_name = "";
$last_name = "";
$gender = "";
$email = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$signup = new Signup();
		$result = $signup->evaluate($_POST);

		if($result != ""){

			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following errors occured:<br><br>";
			echo $result;
			echo "</div>";
		}else{
			header("Location: login.php");
			die;
		}
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
	}
?>

<html>
	<head>
		<title>facebook | Signup</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body style="font-family: tahoma;background-color: #e9ebee;">
		<div id="bar">
			<div style="font-size: 40px;">facebook</div>
			<a href="login.php">
			<div id="signup_button">Log in</div>
			</a>
		</div>

		<div id="bar2">
			Sign up to facebook<br><br>

			<form method="post" action="">
				<input value="<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First name"><br><br>
				<input value="<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="Last name"><br><br>

				<span style="font-weight: normal;">Gender:</span><br>
				<select id="text" name="gender">

					<option><?php echo $gender ?></option>
					<option>Male</option>
					<option>Female</option>

				</select>
				<br><br>
				<input value="<?php echo $email ?>" name="email" type="text" id="text" placeholder="Email"><br><br>

				<input name="password" type="password" id="text" placeholder="Password"><br><br>
				<input name="password2" type="password" id="text" placeholder="Retype Password"><br><br>

				<input type="submit" id="button" value="Sign up">
				<br><br><br>
			</form>
		</div>
	</body>
</html>