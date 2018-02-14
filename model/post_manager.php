<?php
/*
require_once 'database.php'; 
require_once 'entity/post.class.php';
*/
class Post_manager extends Database
{
	/**
	 * renvoie la liste de tous les billets
	 * @return la liste des billets 
	 */
	public function getPosts()
	{

		$sql = ('SELECT id, author, title, content, DATE_FORMAT(creation_date,\'%d/%m/%Y à %Hh%imin%ss\') AS creation_date FROM posts ORDER BY creation_date DESC ');
		$posts = $this->executeQuery($sql);
		
		// tableau vide
		$postsObj = array();
        foreach ($posts as $post){
            $postObj = new Post($post);

            /**
             * array_push ( array &$array , $value1 [, $... ] )
             * array = tableau d'entrée (ici $postsObj = array() donc un tableau vide)
             * $value1 = 1ère valeur à insérer à la fin du tableau (ici $postObj donc un nouvel objet Post($post))
             * retourne nveau nb d'éléments ds le tableau
             */
            array_push($postsObj, $postObj); 
        }
        return $postsObj; 
	}
	/**
	 * [getPost récupère un billet selon son id avec une requête préparée]
	 * @param  [int] $post_id [id du billet]
	 * @return affiche un billet 
	 */
	
	public function getPost($post_id) {
        $sql = ('SELECT id, author, title, content, DATE_FORMAT(creation_date,\'%d/%m/%Y à %Hh%imin%ss\') AS creation_date FROM posts WHERE id = ?');
		$post = $this->executeQuery($sql, array($post_id));

		// rowCount() retourne le nbr de ligne affectées par le dernier appel à la fonction execute() -> si ds $post j'ai un post_id alors je vais afficher 
		if ($post->rowCount() > 0) {
			// fetch() = va chercher la 1ère ligne de résultat
			$result = new Post($post->fetch());
			return $result;
		}
		else 
			throw new Exception('Aucun billet ne correspond au numéro ' .$post_id. '.');

    } 

    /*
    public function getPost($post_id) {
    	
    	$sql = ('SELECT COUNT(*) AS nb_id FROM  posts WHERE id = ?'); 
		$req = $this->executeQuery($sql, array([$id]));
		$resultPost = $req->fetchColumn();
		//print($resultPost);
				if ($resultPost > 0) {
				$result = new Post($post_id);
				return $result;	
		} else {
			throw new Exception('Aucun billet ne correspond au numéro ' .$post_id. '.');
		}
   	}	
   	*/
}
 