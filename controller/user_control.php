<?php 
class User_control
{
	private $user_manager;
	private $post_manager;
	private $comment_manager;

	public function __construct()
	{
		$this->user_manager = new User_manager();
		$this->post_manager = new Post_manager();
		$this->comment_manager = new Comment_manager();
	}

	/**
	 * [logAdmin description] récupère les identifiants de l'admin
	 * @param  [str] $loginAdmin    [identifiant de l'admin]
	 * @param  [str] $passwordAdmin [mot de passe de l'admin]
	 * @return session admin et vue de la page d'administration
	 */
	public function logAdmin($loginAdmin, $passwordAdmin)
	{
		$adminCheck = new User(array(
			'username' => $loginAdmin, // 'username" = clé/nom du champ - $loginAdmin = valeur
			'password' => $passwordAdmin,
			));
			// création de la var $adminReqCheck 
			$adminReqCheck = $this->user_manager->verifyUserByPassword($adminCheck, $passwordAdmin);
			// si le username de l'admin correspond à $loginAdmin on crée variable de session $_SESSION['adminUsername'] qui récupère le username de l'admin
			if ($adminReqCheck != false) {
				$_SESSION['adminUsername'] = $adminReqCheck->getUsername();
				$_SESSION['success']['loggedAdmin'] ='Vous êtes maintenant connecté';
				header('Location: index.php?action=adminProfile');		
			} else {
				$_SESSION['errors']['errorLog'] = 'Le pseudonyme et le mot de passe ne correspondent pas. Veuillez vérifier vos identifiants.';
				header('Location: index.php?action=logAdmin');
		}
	}

	/**
	 * [adminProfile] page de profil de l'admin
	 * @return [array] affiche les infos de l'admin et les commentaires signalés
	 */
	public function adminProfile()
	{
		$admin1 = new User(array(
			'username' => $_SESSION['adminUsername'],
			));

		$adminReq = $this->user_manager->getAdminByLogin($admin1);
		$commentsList = $this->comment_manager->getCommentsByFlag();
		
		$view = new View('adminProfile'); 
		$view ->setTitle('Accueil administrateur');
		$view->setAdmin(true);
		$view->generate(array(
				'adminReq' => $adminReq,
				'comments' => $commentsList,
				));
	}

	/**
	 * [logAdminPage] en cas de saisie erronée dans le formulaire connexion à l'espace admin
	 * @return renvoie sur la page du formulaire de connexion administreur
	 */
	public function logAdminPage()
	{
		$view = new View('admin');
		$view->setTitle('Accès administrateur');
		$view->setAdmin(false);
		$view->generate(array());
	}
	
	/**
	 * [logoutAdmin] déconnexion de l'admin
	 * @return renvoie sur la page de connexion à espace admin
	 */
	public function logoutAdmin()
	{	
		// ecrase le tableau 
		$_SESSION['adminUsername'] = [];
		// détruit les variables de la session en cours
		session_unset();
		// détruit la session en cours
		session_destroy();
		// redirection
		header('Location: index.php?action=logAdmin');
		exit();
	}	
}



