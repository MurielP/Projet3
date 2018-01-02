<?php
require_once 'model/postManager.php';
require_once 'entity/post.class.php';
require_once 'view/view.php';

class PostControl
{
	private $postManager;

	public function __construct()
	{
		$this->postManager = new PostManager();
	}

	public function post($postId)
	{
		$post = $this->postManager->getPost($postId);
		$view = new View('Post');
		$view->setTitle('Billet simple pour l\'Alaska');
		$view->generate(array('post' => $post));
	}

}


