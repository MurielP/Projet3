<?php 

//require_once 'model/post_manager.php';
//require_once 'view/view.php';

class Home_control
{
	private $post_manager;
	private $comment_manager;

	public function __construct()
	{
		$this->post_manager = new Post_manager();
		$this->comment_manager = new comment_manager();
	}

	/**
	 * [homePage] page d'accueil 
	 * @return [type] [affiche la liste des billets]
	 */
	public function homePage()
	{

		$posts = $this->post_manager->getPosts();
		$posts_nb = $this->post_manager->countPosts();

		// appel du fichier qui génère la vue 
		$view = new view('home');
		$view->setTitle('Accueil - Jean Forteroche');
		$view->generate(array(
			'posts' => $posts,
			'posts_nb' => $posts_nb,
		));
	}
}