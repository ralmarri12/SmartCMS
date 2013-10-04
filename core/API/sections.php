<?php

// it returns true if the section has added or false
function addSec($secName){

	global $db;
	global $errors;
	if(empty($secName)){
		$errors[] = ERR_SEC_NAME;
		return false;
	}
	
	$query = $db->prepare("INSERT INTO `sections` (`name`) VALUES (:name)");
	$query->bindValue(':name',$secName,PDO::PARAM_STR);
	$query->execute();
	return true;
}

function secExsist($secId){
	global $db;
	$query = $db->prepare("SELECT * FROM `sections` WHERE `id` = :id");
	$query->bindValue(':id',$secId,PDO::PARAM_INT);
	$query->execute();
	
	return ($query->rowCount() == 1) ? true:false;
}

function deleteSec($secId){
	global $db;
	global $errors;
	
	if(!secExsist($secId))
	{
		$errors[] = ERR_SEC_EXSIST;
		return false;
	}
	
	$query = $db->prepare("DELETE FROM `sections` WHERE `id` = :id");
	$query->bindValue(':id',$secId,PDO::PARAM_INT);
	$query->execute();
	return true;
}

function getSecById($secId){
	global $db;
	global $errors;
	
	if(!secExsist($secId)){
		$errors[] = ERR_SEC_EXSIST;
		return false;
	}
	
	$query = $db->prepare("SELECT * FROM `sections` WHERE `id` = :id");
	$query->bindValue(':id',$secId,PDO::PARAM_INT);
	$query->execute();
	
	return $query->fetch(PDO::FETCH_ASSOC);
}

function updateSec($secId,$secName){
	global $db;
	global $errors;
	
	if(empty($secName)){
		$error[] = ERR_SEC_NAME;
		return false;
	}
	
	$getSec = getSecById($secId);
	
	if($getSec['name'] === $secName){
		$errors[] = ERR_POST_EDIT;
		return false;
	}
	
	$query = $db->prepare("UPDATE `sections` SET `name` = :name WHERE id = :id");
	$query->bindValue(':name',$secName,PDO::PARAM_STR);
	$query->bindValue(':id',$secId,PDO::PARAM_INT);
	$query->execute();
	return true;
}

?>