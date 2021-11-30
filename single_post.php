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
				header("Location: single_post.php?id=$_GET[id]");
				die;
			}else{
				echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
				echo "<br>The following errors occured:<br><br>";
				echo $result;
				echo "</div>";
			}
	}

	$Post = new Post();
	$ROW = false;

	$ERROR = "";
	if(isset($_GET['id'])){

		$ROW = $Post->get_one_post($_GET['id']);
	}else{

		$ERROR = "No post was found!";
	}

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Single Post |facebook</title>
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
  					 		$user = new User();
  					 		$image_class = new Image();

  					 		if(is_array($ROW)){
 	 					 		$ROW_USER = $user->get_user($ROW['userid']);

  					 			if($ROW['parent'] == 0){
  					 				include("post.php");
  					 			}else{
  					 				$COMMENT = $ROW;
  					 				include("comment.php");
  					 			}
  					 		}
  					 ?>
  					 <?php if($ROW['parent'] == 0): ?>
	  					 <br style="clear: both;">
	  					 <div style="border:solid thin #aaa; padding: 10px;background-color: white;">

	 						<form method="post" enctype="multipart/form-data">
		 						<textarea name="post" placeholder="Post a comment"></textarea>
		 						<input type="hidden" name="parent" value="<?php echo $ROW['postid'] ?>">
		 						<input type="file" name="file">
		 						<input id="post_button" type="submit" value="Post">
		 						<br>
	 						</form>
	 					</div>

 					 <?php else: ?>
 					 	<a href="single_post.php?id=<?php echo $ROW['parent'] ?>" >
 					 		<input id="post_button" style="width:auto;float: left;cursor: pointer;" type="button" value="Back to main post" />
 					 	</a>
 					 <?php endif; ?>

 						<?php
 							$comments = $Post->get_comments($ROW['postid']);
 							if(is_array($comments)){
 								foreach ($comments as $COMMENT) {
 									$ROW_USER = $user->get_user($COMMENT['userid']);
 									include("comment.php");
 								}
 							}
 						?>
 					</div>
 				</div>
			</div>
		</div>
	</body>
</html>