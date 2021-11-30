<?php
include("classes/autoload.php");
$login = new Login();
$user_data = $login->check_login($_SESSION['mybook_userid']);

if(isset($_GET['find'])){

		$find = addslashes($_GET['find']);

		$sql = "select * from users where first_name like '%$find%' || last_name like '%$find%' limit 30";
		$DB = new Database();
		$results = $DB->read($sql);

	}
?>

<!DOCTYPE html>
	<html>
	<head>
		<title>People who like | facebook</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body style="font-family: tahoma; background-color: #d0d8e4;">
		<br>
		<?php include("header.php"); ?>
		<!--cover area-->
		<div style="width: 800px;margin:auto;min-height: 400px;">
			<!--below cover area-->
			<div style="display: flex;">
				<!--posts area-->
 				<div style="min-height: 400px;flex:2.5;padding: 20px;padding-right: 0px;">
 					<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

  					 <?php
  					 		$User = new User();
  					 		$image_class = new Image();

  					 		if(is_array($results)){

  					 			foreach ($results as $row) {
  					 				$FRIEND_ROW = $User->get_user($row['userid']);
 									include("user.php");
 					 			}
  					 		}else{
  					 			echo "no results were found";
  					 		}
  					 ?>
  					 <br style="clear: both;">
 					</div>
 				</div>
			</div>
		</div>
	</body>
</html>