<?php
include("classes/autoload.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['mybook_userid']);

$USER = $user_data;
 	if(isset($_GET['id']) && is_numeric($_GET['id'])){
	 	$profile = new Profile();
	 	$profile_data = $profile->get_profile($_GET['id']);

	 	if(is_array($profile_data)){
	 		$user_data = $profile_data[0];
	 	}
 	}

	//posting starts here
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$post = new Post();
		$id = $_SESSION['mybook_userid'];
		$result = $post->create_post($id, $_POST,$_FILES);

		if($result == ""){
			header("Location: index.php");
			die;
		}else{

			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following errors occured:<br><br>";
			echo $result;
			echo "</div>";
		}
	}
?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Profile | facebook</title>
		<link rel ="stylesheet" href="css/style.css">
	</head>

	<body style="font-family: tahoma; background-color: #d0d8e4;">
		<br>
		<?php include("header.php"); ?>
		<!--cover area-->
		<div style="width: 800px;margin:auto;min-height: 400px;">
			<!--below cover area-->
			<div style="display: flex;">

				<!--friends area-->
				<div style="min-height: 400px;flex:1;">

					<div id="friends_bar">

						 <?php

							$image = "images/user_male.jpg";
							if($user_data['gender'] == "Female"){
								$image = "images/user_female.jpg";
							}
							if(file_exists($user_data['profile_image'])){
								$image = $image_class->get_thumb_profile($user_data['profile_image']);
							}
						?>
					<img id="profile_pic" src="<?php echo $image ?>"><br/>

						<a href="profile.php" style="text-decoration: none;">
						 <?php echo $user_data['first_name'] . "<br> " . $user_data['last_name'] ?>
						</a>

					</div>

				</div>

				<!--posts area-->
 				<div style="min-height: 400px;flex:2.5;padding: 20px;padding-right: 0px;">

 					<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

 						<form method="post" enctype="multipart/form-data">

	 						<textarea name="post" placeholder="Whats on your mind?"></textarea>
	 						<input type="file" name="file">
	 						<input id="post_button" type="submit" value="Post">
	 						<br>
 						</form>
 					</div>

	 				<!--posts-->
	 				<div id="post_bar">

 						<?php
  							$DB = new Database();
 							$user_class = new User();
 							$image_class = new Image();

 							$followers = $user_class->get_following($_SESSION['mybook_userid'],"user");

 							$follower_ids = false;
 							if(is_array($followers)){

 								$follower_ids = array_column($followers, "userid");
 								$follower_ids = implode("','", $follower_ids);

 							}

 							if($follower_ids){
 								$myuserid = $_SESSION['mybook_userid'];
 								$sql = "select * from posts where parent = 0 and (userid = '$myuserid' || userid in('" .$follower_ids. "')) order by id desc";
 								$posts = $DB->read($sql);
 							}

 	 					 	if(isset($posts) && $posts){
 	 					 		foreach ($posts as $ROW) {

 	 					 			$user = new User();
 	 					 			$ROW_USER = $user->get_user($ROW['userid']);

 	 					 			include("post.php");
 	 					 		}
 	 					 	}
	 					 ?>
	 				</div>
 				</div>
			</div>
		</div>
	</body>
</html>