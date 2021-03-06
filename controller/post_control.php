<?php
/**
 * Classe qui gère les billets
 */
class Post_control
{
	private $post_manager;
	private $comment_manager;

	/**
	 * [__construct]
	 * création des instances manager
	 */
	public function __construct()
	{
		$this->post_manager = new Post_manager();
		$this->comment_manager = new Comment_manager();
	}

	/**
	 * [post affiche un billet et ses commentaires en fonction de son id ]
	 * @param  [int] $post-id [id du post]
	 * @return vue de la page un billet et ses commentaires
	 */
	public function post($post_id)
	{
		$post = $this->post_manager->getPost($post_id);
		$comments = $this->comment_manager->getCommentsByPostId($post_id);
		$comments_nb = $this->comment_manager->countComments($post_id);

		$view = new View('post');
		$view->setTitle('Épisode : '.$post->getTitle().'');
		$view->setAdmin(false);
		$view->generate(array(
			'post' => $post,
			'comments' => $comments,
			'comments_nb' => $comments_nb,
			));
	}

	/**
	 * [createComment] fonction pour laisser un commentaire
	 * @param  [str] $author  [auteur]
	 * @param  [str] $comment [commentaire]
	 * @param  [int] $post_id [id du billet concerné] 
	 * @return  page post actualisée
	 */
	public function createComment($author, $comment, $post_id)
	{
		$lastComment = new Comment(array(
				'author' => $author, 
				'comment' => $comment,
				'post_id' => $post_id,
 				));

		// signal le commentaire dès sa création
		if ($lastComment != NULL) {
			$lastComment->setIs_flagged(1);	
	 		// si aucune erreur - enregistre le commentaire en bdd 
			if (count($_SESSION['errors']) == 0) {
				$insertComment = $this->comment_manager->saveComment($lastComment);	
				/**
				 * si $insertComment est ok : je crée ma variable de session pour afficher msg success 
				 */
				if ($insertComment == true) {
					$_SESSION['success']['commentInserted'] = 'Votre commentaire a bien été enregistré';
				} 
			}
		}
		// puis retour sur le billet et ses commentaires / si erreur mm page
		header('Location: index.php?action=post&post_id=' .$post_id );
	}	
}


