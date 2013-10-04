<?php
session_start();
//Errors array
$errors = array();

// Making a varible for the user's id of user's details;
$session_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id']: 0;

if(logged_in())
	$userData = userData($session_id,'id','username','password','fullname','email','phoneNo','address','option','regDate');


?>