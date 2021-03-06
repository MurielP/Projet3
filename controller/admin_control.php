<?php
class Admin_control
{
	// déclarations des propriétés de la classe
	private $post_manager;
	private $user_manager;
	private $comment_manager;

	public function __construct()
	{
		$this->post_manager = new Post_manager();
		$this->user_manager = new User_manager();
		$this->comment_manager = new Comment_manager();
	}

	/**
	 * [addPost] fonction pour ajouter un nouveau billet 
	 * @param [str] $author  [auteur]
	 * @param [str] $title   [titre ]
	 * @param [arr] $content [contenu du billet]
	 */
	public function createPost($author, $title, $content)
	{
		$lastPost = new Post(array(
				'author' => $author, 
				'title' => $title,
				'content' => $content,	
 				));	
		/**
		 * si la tableau d'erreur est vide alors j'appelle la fonction savePost du admin_manager pour enregistrer le nouveau billet en bdd, puis je l'affiche 
		 */
		if (count($_SESSION['errors']) == 0) {
			$insertPost = $this->post_manager->savePost($lastPost);		
			if($insertPost == true){
				$_SESSION['success']['addedPost'] = 'Votre article '. $title.' a bien été publié';
			} else {
				$_SESSION['errors']['addedPostFail'] = 'Votre article '. $title.' n\'a pu être publié';
			}
			header('Location: index.php?action=adminPosts');
		// si il y a des erreurs dans le tableau alors je reste sur la page adminPosts pour voir les erreurs
		} elseif (count($_SESSION['errors']) > 0) {
			header('Location: index.php?action=adminPosts');
		}
	}

	/**
	 * [createPostPage]
	 * @return renvoie l'admin sur la page de création d'article si les champs sont vides
	 */
	public function createPostPage()
	{
		header('Location: index.php?action=adminPosts');
	}
	/**
	 * [getPostsList] affiche la liste des billets si l'admin est connecté
	 * @return [type] [description]
	 */
	public function getPostsList()
	{
		$postsList = $this->post_manager->getPosts();
		
		$user = new User(array('username' => $_SESSION['adminUsername']));
		$user = $this->user_manager->getAdminByLogin($user);

		$view = new view('adminPosts');
		$view->setTitle('Les billets');
		$view->setAdmin(true);
		$view->generate(array(
			'posts' => $postsList,
			'user' => $user
			));
	}

	/**
	 * [readPost] lire un billet
	 * @param  [int] $post_id [id du billet]
	 * @return  [un billet]
	 */
	public function readPost($post_id)
	{
		$post = $this->post_manager->getPost($post_id);

		$view = new View('readPost');
		$view->setTitle('Lire l\'article');
		$view->setAdmin(false);
		$view->generate(array(
			'post' => $post,
			));
	}

	/**
	 * [deletePost] supprimer un billet selon son id 
	 * @param  [int] $post_id [id du billet]
	 * @return message de succès ou erreur, puis renvoie sur la page administration des billets
	 */
	public function deletePost($post_id)
	{
		$post = $this->post_manager->getPost($post_id);

		if (count($_SESSION['errors']) == 0) {
			$suppr = $this->post_manager->suppressPost($post_id);
			if($suppr == true){
				$_SESSION['success']['deletedPost'] = 'Votre article n° '. $post_id.' a bien été supprimé ainsi que ses commentaires.';
			} else {
				$_SESSION['errors']['deletedPostFail'] = 'Votre article n°'. $post_id.' n\'a pu être supprimé.';
			}	
			// la suppression des commentaires liés à l'article est effectuée en bdd : 
			// table comments - foreign_key ON DELETE : CASCADE (structure bdd et vue relationnelle
		}				
		header('Location: index.php?action=adminPosts');
	}
	
	/**
	 * [modifyPost] modifier un billet 
	 * @param  [int] $post_id [id du billet]
	 * @param  [str] $author  [nom de l'auteur]
	 * @param  [str] $title   [titre du billet]
	 * @param  [str] $content [contenu du billet]
	 * @return billet modifié et renvoie sur la page de modificiation de billet
	 */
	public function modifyPost($post_id, $author = NULL, $title = NULL, $content = NULL)
	{
		$post = $this->post_manager->getPost($post_id);

		// je redéfinis mon objet post avec les setters définis ds entity post
		if ($author != NULL AND $title != NULL AND $content != NULL) {
			$post->setAuthor($author);
			$post->setTitle($title);
			$post->setContent($content);
			$post->setId($post_id);

			// j'appelle dans le manager des posts la fonction pour enregistrer les modif 
			$postUpdate = $this->post_manager->updatePost($post);

			/**
			 * si $postUpdate est ok : je crée ma variable de session pour afficher msg success 
			 */
			if ($postUpdate == true) {
				$_SESSION['success']['postUpdated'] = 'Votre article n°'. $post_id .' a bien été modifié';
			}
		}

		$view = new View('updatePost');
		$view->setTitle('Modifier l\'article');
		$view->setAdmin(true);
		$view->generate(array(
			'post' => $post,			
			));
	}	

	/**
	 * [getCommentsList] liste des commentaires
	 * @return tableau affichant la liste des commentaires
	 */
	public function getCommentsList()
	{
		$commentsList = $this->comment_manager->getCommentsByFlag();
		//var_dump($commentsList);
		$user = new User(array('username' => $_SESSION['adminUsername']));
		$user = $this->user_manager->getAdminByLogin($user);

		$view = new view('adminComments');
		$view->setTitle('Les commentaires');
		$view->setAdmin(true);
		$view->generate(array(
			'comments' => $commentsList,
			 'user' => $user
			));		
	}

	/**
	 * [readComment] lecture d'un commentaire
	 * @param  [int] $id [id du commentaire]
	 * @return [un commentaire] 
	 */
	public function readComment($id)
	{
		$comment = $this->comment_manager->getCommentById($id);
		$post = $this->post_manager->getPostByCommentId($id);

		if ($id >0 AND count($_SESSION['errors']) == 0) {
			$noFlag = $this->comment_manager->supprFlag($id);
		}		
		//var_dump($comment);
		$view = new View('readComment');
		$view->setTitle('Lire le commentaire');
		$view->setAdmin(false);
		$view->generate(array(		
			'comment' => $comment,
			'post' => $post,
			));
	}
	
	/**
	 * [deleteComment] suppression d'un commentaire 
	 * @param  [int] $comment_id [id du commentaire]
	 * @return [message de suucès ou d'erreru et renvoie sur la page d'administration des commentaires]
	 */
	public function deleteComment($comment_id)
	{
		$comment = $this->comment_manager->getCommentById($comment_id);

		if (count($_SESSION['errors']) == 0) {
			$suppr = $this->comment_manager->suppressComment($comment_id);

			if($suppr == true){
				$_SESSION['success']['supprComment'] = 'Le commentaire n°'. $comment_id .' a bien été supprimé';
			} else {
				$_SESSION['errors']['deletedCommentFail'] = 'Votre commentaire n°'. $post_id.' n\'a pu être supprimé.';
			}
		}	
		header('Location: index.php?action=adminComments');
	}

	/**
	 * [modifyComment] modification d'un commentaire 
	 * @param  [int] $id              [id du commentaire]
	 * @param  [int] $post_id         [id du billet]
	 * @param  [str] $author          [auteur du commentaire]
	 * @param  [str] $commentModified [commentaire modifié]
	 * @return [commentaire modifié + message de succès ou erreur + renvoie sur la page de modification d'unc commentaire]
	 */
	public function modifyComment($id, $post_id, $author = NULL, $commentModified = NULL)
	{
		$comment = $this->comment_manager->getCommentById($id);

		// je redéfinis mon objet commentaire
		if ($author != NULL AND $commentModified != NULL) {
			$comment->setAuthor($author);
			$comment->setComment($commentModified);
			$comment->setIs_flagged(0);			

			if (count($_SESSION['errors']) == 0 ) {
				$commentUpdate = $this->comment_manager->updateComment($comment);
				//var_dump($commentUpdate);
				/**
				 * si $commentUpdate est ok : je crée ma variable de session pour afficher msg success 
				 */
				if ($commentUpdate == true) {
					$_SESSION['success']['commentUpdated'] = 'Le commentaire n°'. $id .' a bien été modifié';
				} else {
					$_SESSION['errors']['commentUpdatedFail'] = 'Le commentaire n°'. $id .' n\'a pas pu être modifié';
				}
			}
		}
		$view = new View('updateComment');
		$view->setTitle('Modifier le commentaire');
		$view->setAdmin(true);
		$view->generate(array(
			'comment' => $comment,		
			));
	}	

	/**
	 * [flagComment] signalement du commentaire à l'administrateur en appelenat la fonction ajout flag 
	 * @param  [int] $id [id du commentaire]
	 * @return message d'eeur ou succès et renvoie sur la page d'un billet et ses commentaires
	 */
	public function flagComment($id)
	{
		$commentAddFlag = $this->comment_manager->flaggedComment($id);	
		$comment = $this->comment_manager->getCommentById($id);

		if ($commentAddFlag == true) {
			$_SESSION['success']['commentUpdated'] = 'Le commentaire n°'. $id .' a bien été signalé';	
		} else {
			$_SESSION['errors']['commentUpdatedFail'] = 'Le commentaire n°'. $id .' n\'a pas pu être signalé';
		}
		header('Location: index.php?action=post&post_id=' .$comment->getPost_id());
	}
}