<?php
/*
require_once 'database.php'; 
require_once 'entity/post.class.php';
*/
class Post_manager extends Database
{
	/**
	 * renvoie la liste de tous les billets
	 * @return  PDO Statement - la liste des billets 
	 */
	public function getPosts()
	{
		$sql = ('SELECT id, author, title, content, DATE_FORMAT(creation_date,\'%d %m %Y à %Hh%imin%ss\') AS creation_date FROM posts ORDER BY creation_date DESC ');
		$posts = $this->executeQuery($sql);
		
		$postsObj = array();
        foreach ($posts as $post){
            $postObj = new Post($post);

            /**
             * array_push ( array &$array , mixed $value1 [, mixed $... ] )
             * array = tableau d'entrée (ici $postsObj = array() donc un tableau vide)
             * $value1 = 1ère valeur à insérer à la fin du tableau (ici $postObj donc un nouvel objet Post($post))
             * retourne nveau nb d'éléments ds le tableau
             */
            array_push($postsObj, $postObj); 
        }
        return $postsObj; 
	}
	/**
	 * [getPost récupère un billet selon son id]
	 * @param  [int] $postId [id du billet]
	 * @return affiche un billet 
	 */
	public function getPost($postId) {
        $sql = ('SELECT id, author, title, content, DATE_FORMAT(creation_date,\'%d %m %Y à %Hh%imin%ss\') AS creation_date FROM posts WHERE id = ?');
		$post = $this->executeQuery($sql, array($postId));
		if ($post->rowCount() > 0) {
			$result = new Post($post->fetch());
			return $result;
		}
		else 
			throw new Exception('Aucun billet ne correspond au numéro ' .$postId. '.');

    }

}