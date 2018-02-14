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

	public function addPost($author, $title, $content)
	{
		$lastPost = new Post(array(
				'author' => $author, 
				'title' => $title,
				'content' => $content
 		));

		/**
		 * si la tableau d'erreur est vide alors j'appelle la fonction savePost du admin_manager
		 */
		if (count($_SESSION['errors']) == 0){
			$insertPost = $this->post_manager->savePost($lastPost);		
		} 
			header('Location: index.php');
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