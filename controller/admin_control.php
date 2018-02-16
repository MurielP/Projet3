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
	public function addPost($author, $title, $content)
	{
		$lastPost = new Post(array(
				'author' => $author, 
				'title' => $title,
				'content' => $content
 		));	
		/**
		 * si la tableau d'erreur est vide alors j'appelle la fonction savePost du admin_manager pour enregistrer le nouveau billet en bdd, puis je l'affiche 
		 */
		if (count($_SESSION['errors']) == 0){
			$insertPost = $this->post_manager->savePost($lastPost);		
			header('Location: index.php');

		// si il y a des erreurs dans le tableau alors je reste sur la page adminDasboard pour voir les erreurs
		} elseif (count($_SESSION['errors']) > 0) {
			header('Location: index.php?action=adminProfile');
		}
	}

	public function addPostPage()
	{
		header('Location: index.php?action=adminProfile');
	}

	public function getPostsList()
	{
		$postsList = $this->post_manager->getPosts();
		
		$user = new User(array('username' => $_SESSION['userUsername']));
		$user = $this->user_manager->getAdminByLogin($user);
	

		$view = new view('adminDashboard');
		$view->setTitle('Les billets');
		$view->generate(array(
			'posts' => $postsList,
			'user' =>$user
		));
	}
}