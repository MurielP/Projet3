<?php 
class Home_control
{
	// déclaration de propriété 
	private $post_manager;

	public function __construct()
	{
		$this->post_manager = new Post_manager();
	}

	/**
	 * [homePage] méthode permettant d'afficher le page d'accueil 
	 * @return [affiche la liste des billets]
	 */
	public function homePage()
	{
		$posts = $this->post_manager->getPosts();
		// appel du fichier qui génère la vue 
		$view = new view('home');
		// redéfinition des setters 
		$view->setTitle('Accueil - Blog de Jean Forteroche');
		$view->setAdmin(false); // cf body du template (classe css pour masquer image du header à certaines pages admin)
		// boucle foreach ($posts as $post) appelée ds vue pour afficher tous les billets existants
		$view->generate(array(
			'posts' => $posts,
			));
	}
}