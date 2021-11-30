<!--top bar-->
<?php 

	$corner_image = "images/user_male.jpg";
	if(isset($USER)){		
		if(file_exists($USER['profile_image'])){
			$image_class = new Image();
			$corner_image = $image_class->get_thumb_profile($USER['profile_image']);
		}else{
			if($USER['gender'] == "Female"){
				$corner_image = "images/user_female.jpg";
			}
		}
	}
?>

<div id="blue_bar">
	<form method="get" action="search.php">
		<div style="width: 800px;margin:auto;font-size: 30px;">
			
			<a href="index.php" style="color: white;">facebook</a> 
			&nbsp &nbsp <input type="text" id="search_box" name="find" placeholder="Search for people" />

			<?php if(isset($USER)): ?>
				<a href="profile.php">
				<img src="<?php echo $corner_image ?>" style="width: 50px;float: right;">
				</a>
				<a href="logout.php">
				<span style="font-size:11px;float: right;margin:10px;color:white;">Logout</span>
				</a>

			<?php else: ?>
				<a href="login.php">
				<span style="font-size:13px;float: right;margin:10px;color:white;">Login</span>
			<?php endif; ?>
		</div>
	</form>
</div>