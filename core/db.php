<?php

try{
//Database connection details
$config['db']   = array(
	'host' 		=> 'localhost',
	'username' 	=> 'root',
	'password' 	=> '',
	'dbname' 	=> 'cms'
);


//Executing database connection
$db = new PDO("mysql:host=".$config['db']['host'].";dbname=".$config['db']['dbname'],$config['db']['username'],$config['db']['password']);
} catch (PDOException $e) {
	echo "Failed to get DB handle: " . $e->getMessage() . "\n";
	exit;
}

//Setting errors attribute
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//Executing general information
$infoq = $db->prepare("SELECT * FROM `settings`");
$infoq->execute();
$info = $infoq->fetch(PDO::FETCH_ASSOC);


?>