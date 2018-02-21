<?php

class Admin_control
{
	private $post_manager;
	private $user_manager;

	public function __construct()
	{
		$this->post_manager = new Post_manager();
		$this->user_manager = new User_manager();

	}

	/**
	 * [addPost] fonction pour ajouter un nouveau billet 
	 * @param [type] $author  [auteur]
	 * @param [type] $title   [titre ]
	 * @param [type] $content [contenu du billet]
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
		if (count($_SESSION['errors']) == 0){
			$insertPost = $this->post_manager->savePost($lastPost);		
			$_SESSION['success']['addedPost'] = 'Votre article '. $title.' a bien été publié';
			header('Location: index.php?action=adminDashboard');

		// si il y a des erreurs dans le tableau alors je reste sur la page adminDasboard pour voir les erreurs
		} elseif (count($_SESSION['errors']) > 0) {
			header('Location: index.php?action=adminDashboard');
		}
	}

	public function createPostPage()
	{
		header('Location: index.php?action=adminDashboard');
	}

	public function getPostsList()
	{
		$postsList = $this->post_manager->getPosts();
		
		$user = new User(array('username' => $_SESSION['adminUsername']));
		$user = $this->user_manager->getAdminByLogin($user);
	

		$view = new view('adminDashboard');
		$view->setTitle('Les billets');
		$view->generate(array(
			'posts' => $postsList,
			'user' => $user
		));
	}

	public function readPost($post_id)
	{
		$post = $this->post_manager->getPost($post_id);

		$view = new View('readPost');
		$view->setTitle('Lire l\'article');
		$view->generate(array(
			'post' => $post,
		));
	}

	public function deletePost($post_id)
	{
		$post = $this->post_manager->getPost($post_id);

		if(count($_SESSION['errors']) == 0){
			$suppr = $this->post_manager->suppressPost($post_id);

			if($suppr == true){
				$_SESSION['success']['supprPost'] = 'Votre article n°'. $post_id .' a bien été supprimé';
			}
		}
		
		header('Location: index.php?action=adminDashboard');
	}
	
	public function modifyPost($author, $post_id)
	{
		$newPost = new Post(array(
				'author' => $author, 
				'post_id' => $post_id,
 		));

		$post = $this->post_manager->getPost($post_id);

		if(count($_SESSION['errors']) == 0){
			$postUpdate = $this->post_manager->updatePost($newPost);

			/**
			 * si $postUpdate est ok : je crée ma variable de session pour afficher msg success 
			 */
			if ($postUpdate == true) {
				$_SESSION['success']['postUpdated'] = 'Votre article a bien été modifié';
			}	
		} 

		$view = new View('updatePost');
		$view->setTitle('Modifier l\'article');
		$view->generate(array(
			'post' => $post,
			'postUpdate' => $postUpdate,
		));

	}	

	public function updatePostPage()
	{
		header('Location : index.php?action=modifyPost');
	}

	public function getCommentsList()
	{
		$commentsList = $this->comment_manager->getComments();
		
		$user = new User(array('username' => $_SESSION['adminUsername']));
		$user = $this->user_manager->getAdminByLogin($user);

		$view = new view('adminComments');
		$view->setTitle('Les commentaires');
		$view->generate(array(
			'comments' => $commentsList,
			 'user' => $user
		));
		
	}


	
}