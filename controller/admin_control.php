<?php

class Admin_control
{
	private $admin_manager;
	private $post_manager;

	public function __construct()
	{
		$this->admin_manager = new Admin_manager();
		$this->post_manager = new Post_manager();

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
			$insertPost = $this->admin_manager->savePost($lastPost);		
		} 
			header('Location: index.php');
	}

	public function addPostPage()
	{
		header('Location: index.php?action=adminProfile');
	}

	public function getPostsList()
	{
		$postsList = $this->admin_manager->getList();

		$view = new view('adminDashboard');
		$view->setTitle('');
		$view->generate(array());
	}
}