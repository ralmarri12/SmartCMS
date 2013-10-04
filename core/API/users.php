<?php

//`id`, `username`, `password`, `fullname`, `email`, `phoneNo`, `address`, `option`, `regDate`
function addUser($user = array()){

	$username = $user['username'];
	$passowrd = md5(md5($user['password']));
	$fullname = $user['fullname'];
	$email    = $user['email'];
	$phoneNo  = $user['phoneNo'];
	$address  = $user['address'];
	$option   = $user['option'];
	$regDate  = $user['regDate'];
	
	global $db;
	$query = $db->prepare("INSERT INTO `users` 
	(`id`, `username`, `password`, `fullname`, `email`, `phoneNo`, `address`, `option`, `regDate`)
	VALUES
	(NULL,:username,:password,:fullname,:email,:phoneNo,:address,:option,:regDate)");
	$query->bindValue(':username',$username,PDO::PARAM_STR);
	$query->bindValue(':password',$password,PDO::PARAM_STR);
	$query->bindValue(':fullname',$fullname,PDO::PARAM_STR);
	$query->bindValue(':email',$email,PDO::PARAM_STR);
	$query->bindValue(':phoneNo',$phoneNo,PDO::PARAM_INT);
	$query->bindValue(':address',$address,PDO::PARAM_STR);
	$query->bindValue(':option',$option,PDO::PARAM_INT);
	$query->bindValue(':regDate',$regDate,PDO::PARAM_STR);
	$query->execute();
	return true;
}

// returns Id or false
function getIdByUsername($username){
	global $db;

	if(userExists($username))
	{
	$query = $db->prepare("SELECT `id` FROM `users` WHERE `username` = :username");
	$query->bindValue(':username',$username,PDO::PARAM_STR);
	$query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);
	return $row['id'];
	}
	return false;
}

// get ALL users or get user by id
function getUser($id = ''){
	global $db;
	if($id != '')
	{
		$query = $db->prepare("SELECT * FROM `users` WHERE `id` = :id");
		$query->bindValue(':id',$id,PDO::PARAM_INT);
		$query->execute();
		return ($query->rowCount() === 1) ? $query->fetch(PDO::FETCH_ASSOC):false;
	}
	$query = $db->prepare("SELECT * FROM `users`");
	$query->execute();
	if($query->rowCount() >= 1){
		$users = array();
		while($fetch = $query->fetch(PDO::FETCH_ASSOC))
			$users[] = $fetch;
		return $users;
	}
	return false;
}

// User exists:
function userExists($username){
	global $db;

	$query = $db->prepare("SELECT `username` FROM `users` WHERE `username` = :username");
	$query->bindValue(':username',$username,PDO::PARAM_STR);
	$query->execute();
	return ($query->rowCount() === 1) ? true:false;
}

// Email exists:
function emailExists($email){
	global $db;
	$query = $db->prepare("SELECT `username` FROM `users` WHERE `email` = :email");
	$query->bindValue(':email',$email,PDO::PARAM_STR);
	$query->execute();
	return ($query->rowCount() === 1) ? true:false;
}

// User Data:
function userData($userId){
	global $db;
	$data = array();
	
	$func_num_args = func_num_args();
    $func_get_args = func_get_args();
	
	if($func_num_args > 0){
        unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args).'`';
		$query = $db->prepare("SELECT ". $fields." FROM `users` WHERE `id` = :id");
		$query->bindValue(':id',$userId,PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch(PDO::FETCH_ASSOC);
		return $data;
	}
		
}

// login and returns userId after logging in:
function logIn($username,$password){
	
	global $db;
	$userId = getIdByUsername($username);
	$password = md5($password);
	
	$query = $db->prepare("SELECT `id` FROM `users`
	WHERE `username` = :username AND `password` = :password");
	$query->bindValue(':username',$username,PDO::PARAM_STR);
	$query->bindValue(':password',$password,PDO::PARAM_STR);
	$query->execute();
	
	return ($query->rowCount() == 1) ? $userId:false;	
}

// it returns true whenever the user logged in or false
function logged_in(){
    return (isset($_SESSION['user_id'])) ? true : false;
}

// this function is to redirect logged user from the login page
function logged_in_redirect(){
    if(logged_in() === true){
        header('Location: index.php');
        exit();
    }
}

// for pages that needs to login first
function protect_page(){
    if(logged_in() === false){
        header('Location: index.php');
        exit();
    }
}


?>