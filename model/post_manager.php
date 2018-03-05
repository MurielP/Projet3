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
		$sql = ('SELECT id, author, title, content, DATE_FORMAT(creation_date,\'%d/%m/%Y à %Hh%imin%ss\') AS formatted_creation_date FROM posts ORDER BY creation_date DESC');
		$posts = $this->executeQuery($sql);
		
		// tableau vide de tout billet
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
	 * [getPost récupère un billet selon son id]
	 * @param  [int] $post_id [id du billet]
	 * @return [un billet]
	 */
	 public function getPost($post_id) {
	    	
	    	$sql = ('SELECT COUNT(*)  FROM  posts WHERE id = ?'); 

			if($req = $this->executeQuery($sql, array($post_id))) {

				/* Récupère le nombre de lignes qui correspond à la requête SELECT */
				if($req->fetchColumn() > 0){

					 /* Effectue la vraie requête SELECT et travaille sur le résultat */
					$sql = ('SELECT id, author, title, content, DATE_FORMAT(creation_date,\'%d/%m/%Y à %Hh%imin%ss\') AS formatted_creation_date FROM posts WHERE id = ?');
					foreach ($req = $this->executeQuery($sql, array($post_id)) as $row){
						$result = new Post($row);
						return $result;	
					}
				}	
			/* Aucune ligne ne correspond -- faire quelque chose d'autre */		
			} else {
				throw new Exception('Aucun billet ne correspond au numéro ' .$post_id. '.');
			}
	   	}

    /**
	 * [countPosts compte le nombre d'articles publiés]
	 * @return [int] [nbr d'articles]
	 */
	public function countPosts()
	{
		$sql =('SELECT COUNT(*) AS nb_posts FROM posts');
		$req = $this->executeQuery($sql);
		$result = $req->fetchColumn();
		return $result;
	}

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

	public function suppressPost($post_id)
	{
		try {
			$sql = ('DELETE FROM posts WHERE id = ?');
			$deletedPost = $this->executeQuery($sql, array($post_id));

			return $deletedPost;

		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	public function updatePost($post)
	{
		//var_dump($post);
		try {
			$sql = ('UPDATE posts SET author = ?, title = ?, content = ? WHERE id = ?');

			$createdPost = $this->executeQuery($sql, array(
				$post->getAuthor(),
				$post->getTitle(),
				$post->getContent(),
				$post->getId(),			
			));
			
			return $createdPost; 

		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	public function getPostByCommentId($id)
    {
    	try {
	    	$sql =('SELECT posts.id, posts.title, posts.content
	    			FROM posts 
	    			INNER JOIN comments
	    				ON posts.id = comments.post_id
	   				WHERE comments.id = ? ');
    		$jointure = $this->executeQuery($sql, array($id));
    		
    		if($jointure->rowCount() > 0) {
    			$resultJointure = new Post($jointure->fetch());
    			return $resultJointure;	
    		}		
    	} catch (Exception $e) {
    		$_SESSION['errors']['missingPost'] = 'Aucun article ne correspond au commentaire ' .$id .' ';
    	}
    }

/*
    /**
	 * [getPost récupère un billet selon son id avec une requête préparée]
	 * @param  [int] $post_id [id du billet]
	 * @return  un billet 
	 */
/*
	public function getPost($post_id) {
        $sql = ('SELECT id, author, title, content, DATE_FORMAT(creation_date,\'%d/%m/%Y à %Hh%imin%ss\') AS formatted_creation_date FROM posts WHERE id = ?');
		$post = $this->executeQuery($sql, array($post_id));
		// rowCount() retourne le nbr de ligne affectées par le dernier appel à la fonction execute() -> si ds $post j'ai un post_id alors je vais afficher le billet
		if ($post->rowCount() > 0) {
			// fetch() = va chercher la 1ère ligne de résultat
			$result = new Post($post->fetch());
			return $result;
		}
		else 
			throw new Exception('Aucun billet ne correspond au numéro ' .$post_id. '.');
    } 
*/
   	
}
 