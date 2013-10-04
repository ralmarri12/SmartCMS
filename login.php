<?php
include('core/db.php');
include('languages/error.php');
include('core/API/users.php');
include('core/init.php');


logged_in_redirect();

if(!empty($_POST))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(empty($username))
		$errors[] = ERR_USR_LOGIN;
	elseif(!userExists($username))
		$errors[] = ERR_USR_EXSIST;
	//elseif(user_active($username));
	else
	{
		$login = logIn($username,$password);
		if(!$login)
			$errors[] = ERR_USR_PWD;
		else{
			$_SESSION['user_id'] = $login;
            header('Location: index.php');
            exit();
		}
	}

}else
	$errors[] = ERR_USR_NODATA;
	
if(!empty($errors))
{
	echo "<pre>";
	print_r($errors);
}

?>