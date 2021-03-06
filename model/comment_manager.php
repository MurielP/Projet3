<?php
class Comment_manager extends Database
{
	/**
	 * [getComments renvoie la liste des commentaires associés à 1 billet
     * @param  $post_id soit l'Id du billet sélectionné
     * @return tous les commentaires liés à l'id du billet choisi     
	 */
	
	public function getCommentsByPostId($post_id)
	{
		try {
			$sql = ('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date,\'%d/%m/%Y à %Hh%imin\')  AS formatted_comment_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
			$comments = $this->executeQuery($sql, array($post_id));
			// création d'un tableau vide 
			$commentsObj = array();
			// à chq itération on accède à l'élément suivant 
	        foreach ($comments as $comment){
	        	// je crée mon instance et ainsi je remplis chq ligne di tableau par un new Comment
	            $commentObj = new Comment($comment);
	            /**
	             * array_push ( array $nomDuTableau , mixed $elementAInsererALaFinTableau [, mixed $... ] )
	             * 				array = tableau d'entrée (ici $commentsObj = array() donc un tableau vide)
	             *     			$elementAInsererALaFinTableau = 1ère valeur à insérer à la fin du tableau (ici $commentObj donc un nouvel objet Comment($comment)))
	             * retourne nveau nb d'éléments ds le tableau
	             */
	            array_push($commentsObj, $commentObj); 
	        }
	        return $commentsObj;
	    } catch (Exception $e){
	    	$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
	    } 
	}

	/**
	 * [getCommentByPostId] récupère le commentaire selon id du billet
	 * @param  [int] $post_id [id du billet]
	 * @return  un commentaire
	 */
	public function getCommentByPostId($post_id) 
	{
		try {
        	$sql = ('SELECT id, post_id, author, comment, is_flagged, DATE_FORMAT(comment_date,\'%d/%m/%Y à %Hh%imin\') AS formatted_comment_date, is_flagged FROM comments WHERE post_id = ?');
			$comment = $this->executeQuery($sql, array($post_id));
			// rowCount() retourne le nbr de ligne affectées par le dernier appel à la fonction execute() -> si ds $post j'ai un post_id alors je vais afficher le commentaire
			if ($comment->rowCount() > 0) {
				// fetch() = va chercher la 1ère ligne de résultat
				$result = new Comment($comment->fetch());
				return $result;
			}
		} catch (Exception $e){
			//throw new Exception('Aucun commentaire ne correspond au billet numéro ' .$post_id. '.');
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}	 	
    } 

    /**
     * [getCommentById] récupère un commentaire selon son id
     * @param  [int] $id [id du commentaire]
     * @return un commentaire
     */
    public function getCommentById($id)
    {
    	try {
        	$sql = ('SELECT id, post_id, author, comment, is_flagged, DATE_FORMAT(comment_date,\'%d/%m/%Y à %Hh%imin\') AS formatted_comment_date FROM comments WHERE id = ?');
			$comment = $this->executeQuery($sql, array($id));
			// rowCount() retourne le nbr de ligne affectées par le dernier appel à la fonction execute() -> si ds $post j'ai un $id alors je vais afficher le commentaire
			if ($comment->rowCount() > 0) {
				// fetch() = va chercher la 1ère ligne de résultat
				$result = new Comment($comment->fetch());
				return $result;
			}
		} catch (Exception $e){
			//throw new Exception('Aucun commentaire ne correspond au billet numéro ' .$post_id. '.');
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}		 
    } 

	/**
	 * [saveComment] traiter et insérer les données du formulaire dans la bdd
	 * @param  $lastComment [objet créé ds post_control - fct createComment($author, $comment, $post_id)]
	 * @return $createdComment [le commentaire inséré en bdd]
	 */
	public function saveComment($lastComment)
	{
		try {
			$sql = ('INSERT INTO comments (author, comment, post_id, comment_date, is_flagged) VALUES (?,?,?,NOW(),?)');
			$createdComment = $this->executeQuery($sql, array(
				$lastComment->getAuthor(),
				$lastComment->getComment(),
				$lastComment->getPost_id(),
				$lastComment->getIs_flagged(),		
				));			
			return $createdComment; 
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	/**
	 * [getComments] récupère l'ensemble des commentaires
	 * @return tous les commentaires
	 */
	public function getComments()
	{
		try {
			$sql = ('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date,\'%d/%m/%Y à %Hh%imin\')  AS formatted_comment_date  FROM comments ORDER BY comment_date DESC');
			$comments = $this->executeQuery($sql);			
			// tableau vide
			$commentsObj = array();
	        foreach ($comments as $comment){
	            $commentObj = new Comment($comment);
	            /**
	             * array_push ( array &$array , $value1 [, $... ] )
	             * array = tableau d'entrée (ici $commentsObj = array() donc un tableau vide)
	             * $value1 = 1ère valeur à insérer à la fin du tableau (ici $commentObj donc un nouvel objet Comment($comment))
	             * retourne nveau nb d'éléments ds le tableau
	             */
	            array_push($commentsObj, $commentObj); 
	        }
	        return $commentsObj; 
    	} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	/**
	 * [getCommentsByFlag] récupère les commentaires selon le is_flagged
	 * @return tri les commentaires par ordre décroissant
	 */
	public function getCommentsByFlag()
	{
		try {
			$sql = ('SELECT id, post_id, author, comment,is_flagged, DATE_FORMAT(comment_date,\'%d/%m/%Y à %Hh%imin\')  AS formatted_comment_date  FROM comments ORDER BY is_flagged DESC');
			$comments = $this->executeQuery($sql);
			
			// tableau vide
			$commentsObj = array();
	        foreach ($comments as $comment){
	            $commentObj = new Comment($comment);
	            array_push($commentsObj, $commentObj); 
	        }
	        return $commentsObj; 	
        } catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	/**
	 * [suppressComment] supprime un commentaire selon son id
	 * @param  [int] $comment_id [id du commentaire]
	 * @return $deletedComment
	 */
	public function suppressComment($comment_id)
	{
		try {
			$sql = ('DELETE FROM comments WHERE id = ?');
			$deletedComment = $this->executeQuery($sql, array($comment_id));
			return $deletedComment;
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	/**
	 * [suppressCommentByPostId] supprime un commentaire selon id du billet
	 * @param  [int] $post_id [id du billet]
	 * @return $deletedComment
	 */
	public function suppressCommentByPostId($post_id)
	{
		try {
			$sql = ('DELETE FROM comments WHERE post_id = ?');
			$deletedComment = $this->executeQuery($sql, array($post_id));
			return $deletedComment;
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	/**
	 * [updateComment] modification d'un commentaire 
	 * @param  [str] $comment [commentaire]
	 * @return [type]          [description]
	 */
	public function updateComment($comment)
	{
		//var_dump($comment);
		try {
			$sql = ('UPDATE comments SET author = ?, comment = ?, post_id = ?, is_flagged = ? WHERE id = ?');

			$createdComment = $this->executeQuery($sql, array(
				$comment->getAuthor(),
				$comment->getComment(),
				$comment->getPost_id(),
				$comment->getIs_flagged(),
				$comment->getId(),
				));
			return $createdComment; 
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}


	/**
	 * [flaggedComment] modifie le statut du signalement de commentaire en lui attribuant la valeur 1 
	 * @param  [int] $id [id du commentaire]
	 * @return commentaire signalé
	 */
	public function flaggedComment($id)
	{
		try {
			$sql = ('UPDATE comments SET is_flagged = 1 WHERE id = ?');
			$flagComment = $this->executeQuery($sql, array($id));
			return $flagComment; 
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	/**
	 * [countPosts] compte le nombre de commentaires publiés selon id du post
	 * @return [int] [nbr de commentaires]
	 */
	public function countComments($post_id)
	{
		try {
			$sql =('SELECT COUNT(*) AS nb_comments FROM comments WHERE post_id = ?');
			$req = $this->executeQuery($sql, array($post_id));
			$result = $req->fetchColumn();
			return $result;
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}
	
	/**
	 * [supprFlag] supprime le signalement du commentaire selon son id  en lui attribuant la valeur 0
	 * @param  [int] $id [id du commentaire]
	 * @return effacement du signalement du commentaire 
	 */
	public function supprFlag($id)
	{
		try {
			$sql = ('UPDATE comments SET is_flagged = 0 WHERE id = ?');
			$cancelledFlag = $this->executeQuery($sql, array($id));
			return $cancelledFlag; 
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	/**
	 * [countComments2] compte le nombre de commentaire avec une jointure
	 * @return [int] [nombre de commentaires]
	 */
	public function countComments2()
	{
		try {
			$sql =('SELECT posts.id, posts.title, posts.content,
					COUNT(comments.id) AS nb_comments 
					FROM posts 
					JOIN comments 
					WHERE posts.id = comments.post_id 
					GROUP BY posts.id');

			$req = $this->executeQuery($sql);			
			$result = $req->fetchColumn();
			return $result;		
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}
}	