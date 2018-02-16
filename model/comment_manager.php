<?php
/*
require_once 'database.php'; 
require_once 'entity/comment.php';
*/
class Comment_manager extends Database
{
	/**
	 * [getComments renvoie la liste des commentaires associés à 1 billet
     * @param  $postId soit l'Id du billet sélectionné
     * @return tous les commentaires liés à l'id du billet choisi     
	 */
	
	public function getComments($post_id)
	{
		$sql = ('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date,\'%d/%m/%Y à %Hh%imin%ss\')  AS formatted_comment_date FROM comments WHERE post_id = ? ORDER BY comment_date');
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
	}

	/**
	 * saveComment traiter et insérer les données du formulaire dans la bdd
	 * @param [string] $author  [auteur du commentaire]
	 * @param [string] $comment [commentaire]
	 * @param [int] $post_id [id du billet choisi]
	 */
	public function saveComment($lastComment)
	{
		try {
			$sql = ('INSERT INTO comments (author, comment, post_id, comment_date) VALUES (?,?,?,NOW())');
			$createdComment = $this->executeQuery($sql, array(
				$lastComment->getAuthor(),
				$lastComment->getComment(),
				$lastComment->getPost_id()
			));
			
			return $createdComment; 
		} catch (Exception $e) {
			$_SESSION['errors']['sqlError'] = 'Une erreur SQL s\'est produite : '. $e->getMessage() . ' dont le code erreur est : '.$e->getCode() .'';
		}
	}

	public function getOneComment($post_id) {
        $sql = ('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date,\'%d/%m/%Y à %Hh%imin%ss\')  AS formatted_comment_date FROM comments WHERE post_id = ?');
		$newComment = $this->executeQuery($sql, array($post_id));

		// rowCount() retourne le nbr de ligne affectées par le dernier appel à la fonction execute() -> si ds $oneComment j'ai un post_id alors je vais afficher 
		if ($newComment->rowCount() > 0) {
			// fetch() = va chercher la 1ère ligne de résultat
			$result = new Comment($newComment->fetch());
			return $result;
		}
		else 
			throw new Exception('Aucun commentaire ne correspond au numéro ' .$id. '.');

    } 
}	