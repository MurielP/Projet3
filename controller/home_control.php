<?php 

//require_once 'model/post_manager.php';
//require_once 'view/view.php';

class Home_control
{
	private $post_manager;

	public function __construct()
	{
		$this->post_manager = new Post_manager();
	}

	/**
	 * [homePage] page d'accueil 
	 * @return [type] [affiche la liste des billets]
	 */
	public function homePage()
	{
		$posts = $this->post_manager->getPosts();

		$view = new view('home');
		$view->setTitle('Accueil - Jean Forteroche');
		$view->generate(array('posts' => $posts));
	}
}