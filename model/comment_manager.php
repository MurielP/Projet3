<?php
/*
require_once 'database.php'; 
require_once 'entity/comment.class.php';
*/
class Comment_manager extends Database
{
	/**
	 * [getComments renvoie la liste des commentaires associés à 1 billet
     * @param  $postId soit l'Id du billet sélectionné
     * @return tous les commentaires liés à l'id du billet choisi     
	 */
	
	public function getComments($postId)
	{
		$sql = ('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date,\'%d %m %Y à %Hh%imin%ss\')  AS formatted_comment_date FROM comments WHERE post_id = ? ORDER BY comment_date');
		$comments = $this->executeQuery($sql, array($postId));
		
		$commentsObj = array();
        foreach ($comments as $comment){
            $commentObj = new Comment($comment);

            /**
             * array_push ( array &$array , mixed $value1 [, mixed $... ] )
             * array = tableau d'entrée (ici $postsObj = array() donc un tableau vide)
             * $value1 = 1ère valeur à insérer à la fin du tableau (ici $postObj donc un nouvel objet Post($post))
             * retourne nveau nb d'éléments ds le tableau
             */
            array_push($commentsObj, $commentObj); 
        }
        return $commentsObj; 
	}

	/**
	 * addComment traiter et insérer les données du formulaire dans la bdd
	 * @param [string] $author  [auteur du commentaire]
	 * @param [string] $comment [commentaire]
	 * @param [int] $post_id [id du billet choisi]
	 */
	public function addComment($author, $comment, $post_id)
	{
		if (!empty($author) and !empty($comment)) {
		$sql = ('INSERT INTO comments (author, comment, post_id, comment_date) VALUES (?,?,?,NOW())');
		$addedComment = $this->executeQuery($sql, array($author, $comment, $post_id));
		}
	}
}	