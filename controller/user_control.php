<?php 

class User_control
{
	private $user_manager;
	private $post_manager;

	public function __construct()
	{
		$this->user_manager = new User_manager();
		$this->post_manager = new Post_manager();
	}

	/**
	 * [registerUser] enregistre un nouveau membre
	 * @param  [str] $username [pseudonyme]
	 * @param  [str] $password [mot de passe]
	 * @param  [str] $mail     [mail]
	 * @param  [str] $confirm_password [confirmation du mot de passe]
	 * @return [un nouvel utilisateur et renvoie vers page dashboard]
	 */
	public function registerUser($username, $email, $password, $confirm_password)
	{	
		/**
		 * [$user] création de l'objet User 
		 * @var User qui comprend les champs username, password,  email et confirm_password
		 */
		$user = new User(array(
			'username' => $username, 
			'email' => $email,
			'password' => $password,
			'confirm_password' => $confirm_password,
			));

		/** 
		 * je vérifie si l'email du $user existe déjà en bdd 
		 */
		$this->user_manager->emailExists($user);

		/**
		 * si la tableau d'erreur est vide alors j'appelle la fonction createUser du user_manager
		 */
		if (count($_SESSION['errors']) == 0){
			$insert = $this->user_manager->createUser($user);

			/**
			 * si $insert est ok : je crée ma variable de session je renvoie le user vers son userProfile - vue dashboard
			 */
			if ($insert == true) {
				$_SESSION['userUsername'] = $user->getUsername();
				header('Location: index.php?action=userProfile');
			}

		/**
		 * si mon tableau contient des erreurs alors je renvoie le visiteur sur la page d'inscription view_user.php
		 */
		} else {
			$view = new View('user');
			$view ->setTitle('S\'inscrire');
			$view->generate(array());
		}
	}

	/**
	 * [userProfile] création d'un new User en fonction de son username et récupère es infos liées
	 * @return affiche le dashboard du user créé
	 */
	public function userProfile()
	{	
		// création d'un new User
		$user = new User(array('username' => $_SESSION['userUsername']));
		// 
		$user = $this->user_manager->getUserByLogin($user);

		$view = new View('userProfile');
		$view ->setTitle('Mon compte membre');
		$view->generate(array(
				'user' => $user,
				));
	}
	/**
	 * [registerUserPage]  si les champs sont vides 
	 * @return vue de la page d'inscription view_user.php
	 */
	public function registerUserPage()
	{
		$view = new View('user');
		$view ->setTitle('S\'inscrire');
		$view->generate(array());
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
			'username' => $loginAdmin,
			'password' => $passwordAdmin,
			
		));

			// création de la var $admin 
			$adminReqCheck = $this->user_manager->verifyUserByPassword($adminCheck, $passwordAdmin); 
		
			// si le username de l'admin correspond à $loginAdmin
			if ($adminReqCheck != false){
				$_SESSION['adminUsername'] = $adminReqCheck->getUsername();
				header('Location: index.php?action=adminProfile');

			
		}else{
			$_SESSION['errors']['errorLog'] = 'Le pseudonyme et le mot de passe ne correspondent pas. Veuillez vérifier vos identifiants.';

			header('Location: index.php?action=logAdmin');
		}
	}

	public function adminProfile()
	{
		$admin1 = new User(array(
			'username' => $_SESSION['adminUsername'],
			));

		$adminReq = $this->user_manager->getAdminByLogin($admin1);

		$view = new View('adminProfile'); 
		$view ->setTitle('Accueil administrateur');
		$view->generate(array(
				'adminReq' => $adminReq,
				));
	}

	public function tryLogAdmin()
	{
		$view = new View('admin');
		$view->setTitle('Accès administrateur');
		$view->generate(array());
	}
	
	public function logoutAdmin()
	{	
		// ecrase le tableau 
		$_SESSION['adminUsername'] = [];
		// détruit les variables de la session en cours
		session_unset();
		// détruit la session en cours
		session_destroy();
		// redirection
		header('Location: index.php');
		exit();
	}

	
}



