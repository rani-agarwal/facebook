<?php
function i_own_content($row){
	$myid = $_SESSION['mybook_userid'];
	//profiles
	if(isset($row['gender']) && $myid == $row['userid']){
		return true;
	}
	//comments and posts
	if(isset($row['postid'])){

		if($myid == $row['userid']){
			return true;
		}else{
			$Post = new Post();
			$one_post = $Post->get_one_post($row['parent']);

			if($myid == $one_post['userid']){
				return true;
			}
		}
	}
	return false;
}

function tag($postid,$new_post_text = ""){
	$DB = new Database();
	$sql = "select * from posts where postid = '$postid' limit 1";
	$mypost = $DB->read($sql);

	if(is_array($mypost)){
		$mypost = $mypost[0];

		if($new_post_text != ""){
			$old_post = $mypost;
			$mypost['post'] = $new_post_text;
		}
	}
}
function content_i_follow($userid,$row){

	$row = (object)$row;

	$userid = esc($userid);
 	$date = date("Y-m-d H:i:s");
	$contentid = 0;
	$content_type = "";

	if(isset($row->postid)){
		$contentid = $row->postid;
		$content_type = "post";

		if($row->parent > 0){
			$content_type = "comment";
		}
	}
	if(isset($row->gender)){
		$content_type = "profile";
	}

	$query = "insert into content_i_follow (userid,date,contentid,content_type)
	values ('$userid','$date','$contentid','$content_type')";
	$DB = new Database();
	$DB->save($query);
}

function esc($value){
	return addslashes($value);
}

function check_tags($text){
	$str = "";
	$words = explode(" ", $text);
	if(is_array($words) && count($words)>0)
	{
		$DB = new Database();
		foreach ($words as $word) {

			if(preg_match("/@[a-zA-Z_0-9\Q,.\E]+/", $word)){

				$word = trim($word,'@');
				$word = trim($word,',');
				$tag_name = esc(trim($word,'.'));

				$query = "select * from users where tag_name = '$tag_name' limit 1";
				$user_row = $DB->read($query);

				if(is_array($user_row)){
					$user_row = $user_row[0];
					$str .= "<a href='profile.php?id=$user_row[userid]'>@" . $word . "</a> ";
				}else{

					$str .= htmlspecialchars($word) . " ";
				}

			}else{
				$str .= htmlspecialchars($word) . " ";
			}
		}

	}
	if($str != ""){
		return $str;
	}
	return htmlspecialchars($text);
}

