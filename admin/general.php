<?php
	require_once('../core/db.php');
	require_once('functions/general.php');
	
	if(!empty($_POST))
	{
		if(updateSetting($_POST['title'], $_POST['desc'], $_POST['keywords']))
			echo 'updated';
		else
		{
			echo 'Error: <pre>';
			print_r($errors);
			echo '</pre>';
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Control Panel </title>
	</head>

	<body>
	
		<h2>General Settings:</h2>
		<hr>
		<form action="general.php" method="post">
		
			Title: <input type="text" name="title" value="<?php echo $info['title']; ?>"><br>
			description: <br>
			<textarea name="desc"><?php echo $info['desc']; ?></textarea><br>
			Keywords: <br>
			<textarea name="keywords"><?php echo $info['keywords']; ?></textarea><br>
			<input type="submit">
			
		</form>
		
		<a href="index.php">Setting home page</a>
	
	</body>


</html>