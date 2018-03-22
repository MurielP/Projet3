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
	 * @return [affiche la liste des billets]
	 */
	public function homePage()
	{
		$posts = $this->post_manager->getPosts();

		// appel du fichier qui génère la vue 
		$view = new view('home');
		// redéfinition des setters 
		$view->setTitle('Accueil - Blog de Jean Forteroche');
		$view->setAdmin(false); // cf body du template (classe css pour masquer image du header)
		// boucle foreach ($posts as $post) appelée ds vue 
		$view->generate(array(
			'posts' => $posts,
		));
	}
}