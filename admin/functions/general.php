<?php

function updateSetting($title, $desc, $keywords)
{
	global $db;
	global $errors;
	global $info;
	
	$update = array();
	
	if(empty($title))
	{
		$errors[] = "Title is empty";
		return false;
	}
	
	if($title != $info['title'])
		$update[] = '`title` = :title';
	
	if($desc != $info['desc'])
		$update[] = '`desc` = :desc';
	
	if($keywords != $info['keywords'])
		$update[] = '`keywords` = :keywords';
	
	if(empty($update))
	{
		$errors[] = "There is nothing to update";
		return false;
	}
	
	$query = $db->prepare("UPDATE `settings` SET 
	".implode(',', $update)."
	");
	
	if(in_array('`title` = :title',$update))
		$query->bindValue(':title',$title,PDO::PARAM_STR);
		
	if(in_array('`desc` = :desc',$update))
		$query->bindValue(':desc',$desc,PDO::PARAM_STR);
	
	if(in_array('`keywords` = :keywords',$update))
		$query->bindValue(':keywords',$keywords,PDO::PARAM_STR);
	
	$query->execute();
	echo '<pre>';
	print_r($update);
	echo '</pre>';
	return true;
}

?>