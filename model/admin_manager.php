<?php

class Admin_manager extends Database
{
	public function savePost($lastPost)
	{
		try {
			$sql = ('INSERT INTO posts (author, title, content, creation_date) VALUES (?,?,?,NOW())');
			$createdPost = $this->executeQuery($sql, array(
				$lastPost->getAuthor(),
				$lastPost->getTitle(),
				$lastPost->getContent(),

			));
			return $createdPost; 
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	public function getList() //  Récupérer une liste de billets 
	{
	    try{
		    $sql = ('SELECT id, author, title, content, DATE_FORMAT(creation_date,\'%d/%m/%Y à %Hh%imin%ss\') AS creation_date FROM posts ORDER BY creation_date DESC ');
			$req = $this->executeQuery($sql);

			$postsList = array();
	        foreach ($lists as $list) {
	        	$postList = new Post($list);

	            /**
	             * array_push ( array &$array , $value1 [, $... ] )
	             * array = tableau d'entrée (ici $postsObj = array() donc un tableau vide)
	             * $value1 = 1ère valeur à insérer à la fin du tableau (ici $postObj donc un nouvel objet Post($post))
	             * retourne nveau nb d'éléments ds le tableau
	             */
	            array_push($postsList, $postList); 
	        }
	        return $postList; 
	        
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}	
}