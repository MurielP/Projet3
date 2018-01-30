<?php 

class User_control
{
	private $user_manager;

	public function __construct()
	{
		$this->user_manager = new User_manager();
	}

	/**
	 * [registerUser] enregistre un nouvel utilisateur
	 * @param  [str] $username [pseudo]
	 * @param  [str] $password [mot de passe]
	 * @param  [str] $mail     [mail]
	 * @param  [str] $confirm_password     [confirmation du mot de passe]
	 * @return [un nouvel utilisateur et renvoie vers page dashboard]
	 */
	public function registerUser($username, $password, $email, $confirm_password)
	{	
		/**
		 * [$user] création de l'objet User 
		 * @var User qui comprend les champs username, password,  email et confirm_password
		 */
		$user = new User(array(
			'username' => $username, 
			'password' => $password,
			'email' => $email,
			'confirm_password' => $confirm_password
		));

		/** 
		 * je vérifie si l'email existe déjà en bdd 
		 */
		$this->user_manager->emailExists($user);

		/**
		 * si la tableau d'erreur est vide alors j'appelle la fonction createUser du user_manager
		 */
		if (count($_SESSION['errors']) == 0){
			$insert = $this->user_manager->createUser($user);
			/**
			 * si $insert est ok je renvoie le user vers son dashboard
			 */
			if ($insert == true) {
		
				$view = new View('dashboard');
				$view ->setTitle('Mon compte membre');
				$view->generate(array(
					'user' => $user
					));

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
		$user = new User(array(
			'username' => $loginAdmin,
			'password' => $passwordAdmin
		));
		
		$admin = $this->user_manager->getUserByLogin($user); 
		
		if ($admin == true){
			$_SESSION['admin'] = $admin; 

			$view = new View('admin');
			$view ->setTitle('Mon compte adminstrateur');
			$view->generate(array(
					'user' => $user
					));
			
		}
	}

/*
	public function userDashoard($userId)
	{
		$userId = intval($_GET['id']);
		if ($userId != 0) {

			$userDetails = $this->user_manager->getUserDetails($userId);

			$view = new view('dashboard');
			$view->setTitle('Détail de votre compte');
			$view->generate(array('userDetails' => $userDetails));
		}
	}
*/	
}



