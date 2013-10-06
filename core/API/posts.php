<?php

class sPost
{
	private $table;
	private $uid;
	
	public function __construct($table,$uid){
		$this->table = $table;
		$this->uid = (int)$uid;
	}

	public function addPost($subject,$content,$dir){
		$array = array($subject,$content,$dir);
		
		global $errors;
		if(empty($array[0])){
			$errors[] = ERR_POST_ADD_SUB;
			return false;
		}elseif(empty($array[1]) || strlen($array[1]) < $_GLOBAL['char']){
			$errors[] = ERR_POST_CHAR;
			return false;
		}elseif(empty($array[2])){
			$errors[] = ERR_POST_DIR;
			return false;
		}
		else{
			$this->_addToDb($array);
			return true;
		}
	}
	
	private function _addToDb($array = array()){
		global $db;
		$query = $db->prepare("INSERT INTO `".$this->table."` (`id`,`uid`,`toId`,`subject`,`content`) 
		VALUES
		(NULL,:uid,:toId,:subject,:content)");
		$query->bindValue(':uid',$this->uid,PDO::PARAM_INT);
		$query->bindValue(':toId',$array[2],PDO::PARAM_INT);
		$query->bindValue(':subject',$array[0],PDO::PARAM_STR);
		$query->bindValue(':content',$array[1],PDO::PARAM_STR);
		$query->execute();
	}
	
	public function getPostsBySec($toId){
            global $db;
			
            $query = $db->prepare("SELECT * FROM `".$this->table."` WHERE toId = :toId");
            $query->bindValue(':toId',$toId,PDO::PARAM_INT);
            $query->execute();

            if($query->rowCount() > 0)
                    return $query->fetchAll();
            else
                    return false;
	}
        
	public function getPostById($id){
		global $db;
		global $errors;
		if($this->_postExsist($id)){
			$query = $db->prepare("SELECT * FROM `".$this->table."` WHERE `id` = :id");
			$query->bindValue(':id',$id,PDO::PARAM_INT);
			$query->execute();
			return $query->fetch();
		}else{
			$errors[] = ERR_POST_EXSIST;
		}
		
	}
	
	public function getAllPosts(){
            global $db;
			
            $query = $db->prepare("SELECT * FROM `".$this->table."`");
            $query->execute();

            if($query->rowCount() > 0)
                    return $query->fetchAll();
            else
                    return false;
	}
	
	
	private function _postExsist($id){
		global $db;
		$id = (int)$id;
		$query = $db->prepare("SELECT * FROM ".$this->table." WHERE `id` = :id");
		$query->bindValue(':id',$id,PDO::PARAM_INT);
		$query->execute();
		
		return ($query->rowCount() > 0) ? true:false; 
	}
	
	public function delete($id){
		global $db;
		global $errors;
		if($this->_postExsist($id))
		{
			$query = $db->prepare("DELETE FROM `".$this->table."` WHERE `id` = :id");
			$query->bindValue(':id',$id,PDO::PARAM_INT);
			$query->execute();
			return true;
		}
		else
			$errors[] = ERR_POST_EXSIST;
			return false;
			
	}
        
	public function edit($id,$subject,$content,$dir){
		global $db;
		global $errors;
		
		$oldPost = $this->getPostById($id);
		if(count($errors) > 0)
			return false;
		
		
		$goingToEdit = array();
		if($oldPost["subject"] != $subject)
			$goingToEdit[] = "`subject` = :subject";
		
		if($oldPost["content"] != $content)
			$goingToEdit[] = "`content` = :content";
		
		if($oldPost["toId"] != $dir)
			$goingToEdit[] = "`toId` = :toId";
		
		if(!empty($goingToEdit))
		{
			$query = $db->prepare("UPDATE ".$this->table." SET
			".implode(',', $goingToEdit)."
			WHERE id = :id");
			
			if(in_array("`subject` = :subject", $goingToEdit))
				$query->bindValue(':subject',$subject,PDO::PARAM_STR);
			
			if(in_array("`content` = :content", $goingToEdit))
				$query->bindValue(':content',$content,PDO::PARAM_STR);
			
			if(in_array("`toId` = :toId", $goingToEdit))
				$query->bindValue(':toId',$dir,PDO::PARAM_INT);
			
			$query->bindValue(':id',$id,PDO::PARAM_INT);
		 
			$query->execute();
			return true;
		}else{
			$errors[] = ERR_POST_EDIT;
			return false;
		}
		
			
	}
	
	
}

?>