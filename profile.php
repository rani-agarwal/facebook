<?php
include("classes/autoload.php");

$login = new Login();
$_SESSION['mybook_userid'] = isset($_SESSION['mybook_userid']) ? $_SESSION['mybook_userid'] : 0;	$user_data = $login->check_login($_SESSION['mybook_userid'],false);

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
		include("change_image.php");
		if(isset($_POST['first_name'])){
		}else{
			$post = new Post();
			$id = $_SESSION['mybook_userid'];
			$result = $post->create_post($id, $_POST,$_FILES);

			if($result == ""){
				header("Location: profile.php");
				die;
			}else{
				echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
				echo "<br>The following errors occured:<br><br>";
				echo $result;
				echo "</div>";
			}
		}

	}

	//collect posts
	$post = new Post();
	$id = $user_data['userid'];

	$posts = $post->get_posts($id);

	//collect friends
	$user = new User();
	$friends = $user->get_following($user_data['userid'],"user");
	$image_class = new Image();

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
 	<!--change profile image area-->
 		<div id="change_profile_image" style="display:none;position:absolute;width: 100%;height: 100%;background-color: #000000aa;">
 			<div style="max-width:600px;margin:auto;min-height: 400px;flex:2.5;padding: 20px;padding-right: 0px;">
 					<form method="post" action="profile.php?change=profile" enctype="multipart/form-data">
	 					<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

	 						<input type="file" name="file"><br>
	 						<input id="post_button" type="submit" style="width:120px;" value="Change">
	 						<br>
							<div style="text-align: center;">
								<br><br>
							<?php
								echo "<img src='$user_data[profile_image]' style='max-width:500px;' >";
	 						?>
							</div>
	 					</div>
  					</form>
 				</div>
 		</div>
	<!--change cover image area-->
 		<div id="change_cover_image" style="display:none;position:absolute;width: 100%;height: 100%;background-color: #000000aa;">
 			<div style="max-width:600px;margin:auto;min-height: 400px;flex:2.5;padding: 20px;padding-right: 0px;">

 					<form method="post" action="profile.php?change=cover" enctype="multipart/form-data">
	 					<div style="border:solid thin #aaa; padding: 10px;background-color: white;">
	 						<input type="file" name="file"><br>
	 						<input id="post_button" type="submit" style="width:120px;" value="Change">
	 						<br>
							<div style="text-align: center;">
								<br><br>
							<?php
 	 							echo "<img src='$user_data[cover_image]' style='max-width:500px;' >";
	 						?>
							</div>
	 					</div>
  					</form>
 				</div>
 		</div>
	<!--cover area-->
		<div style="width: 800px;margin:auto;min-height: 400px;">
			<div style="background-color: white;text-align: center;color: #405d9b">
					<?php
						$image = "images/cover_image.jpg";
						if(file_exists($user_data['cover_image'])){
							$image = $image_class->get_thumb_cover($user_data['cover_image']);
						}
					?>
			<img src="<?php echo $image ?>" style="width:100%;">
			<span style="font-size: 12px;">
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
			</span>
				<br>
					<div style="font-size: 20px;color: black;">
						<a href="profile.php?id=<?php echo $user_data['userid'] ?>">
							<?php echo $user_data['first_name'] . " " . $user_data['last_name']  ?>
							<br>
						</a>
						<?php
							$mylikes = "";
							if($user_data['likes'] > 0){

								$mylikes = "(" . $user_data['likes'] . " Followers)";
							}
						?>
						<br>
						<a href="like.php?type=user&id=<?php echo $user_data['userid'] ?>">
							<input id="post_button" type="button" value="Follow <?php echo $mylikes ?>" style="margin-right:10px;background-color: #9b409a;width:auto;">
						</a>
					</div>
				<br>
				<a href="index.php"><div id="menu_buttons">Timeline</div></a>
				<a href="profile.php?section=followers&id=<?php echo $user_data['userid'] ?>"><div id="menu_buttons">Followers</div></a>
				<a href="profile.php?section=following&id=<?php echo $user_data['userid'] ?>"><div id="menu_buttons">Following</div></a>
				<a href="profile.php?section=photos&id=<?php echo $user_data['userid'] ?>"><div id="menu_buttons">Photos</div></a>
			</div>

			<!--below cover area-->
	 		<?php

	 			$section = "default";
	 			if(isset($_GET['section'])){

	 				$section = $_GET['section'];
	 			}

	 			if($section == "default"){

	 				include("profile_content_default.php");

	 			}elseif($section == "following"){

	 				include("profile_content_following.php");

	 			}elseif($section == "followers"){

	 				include("profile_content_followers.php");

	 			}elseif($section == "photos"){

	 				include("profile_content_photos.php");
	 			}
	 		?>
		</div>
	</body>
</html>

