<?php

require_once('core/db.php');
require_once('languages/error.php');
require_once('core/API/users.php');
require_once('core/API/posts.php');
require_once('core/API/sections.php');
require_once('core/init.php');

$posts = new sPost('posts',1);
if(!empty($_POST))
{
	if($posts->addPost($_POST['subject'],$_POST['content'],1))
		echo "added";
	else
	{
		echo "<pre>";
		print_r($errors);
		echo "</pre>";
	}
}

?>


<!DOCTYPE html>
<html>

	<head>
		<title>Add Post</title>
	</head>
	
	<body>
		<form action="AddPostBeta.php" method="post">
			Subject: <input type="text" name="subject"><br>
			Content:<br>
			<textarea name="content" cols="40" rows="4"></textarea><br>
			<input type="submit">
		</form>
	</body>

</html>