<?php 

require_once 'model/postManager.php';
require_once 'entity/post.class.php';
require_once 'view/view.php';

class HomeControl
{
	private $postManager;

	public function __construct()
	{
		$this->postManager = new PostManager();
	}

	public function homePage()
	{
		$posts = $this->postManager->getPosts();
		$view = new view('Home');
		$view->setTitle('Accueil - Jean Forteroche');
		$view->generate(array('posts' => $posts));
	}
}