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

		$view = new View('memberDashboard');
		$view ->setTitle('Mon compte membre');
		$view->generate(array(
				'user' => $user
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
		$user = new User(array(
			'username' => $loginAdmin,
			'password' => $passwordAdmin
		));

			// création de la var $admin 
			$admin = $this->user_manager->verifyUserByPassword($user, $passwordAdmin); 
		
			// si le username de l'admin correspond à $loginAdmin
			if ($user->getUsername() == $loginAdmin){
				$_SESSION['userUsername'] = $loginAdmin;
				header('Location: index.php?action=adminProfile');

			
		}else{
			header('Location: index.php?action=logAdmin');
		}
	}

	public function adminProfile()
	{
		$user = new User(array('username' => $_SESSION['userUsername']));
		$user = $this->user_manager->getAdminByLogin($user);

		$posts = $this->post_manager->getPosts();

		$view = new View('adminDashboard'); // plutot userProfile
		$view ->setTitle('Mon compte administrateur');
		$view->generate(array(
				'user' => $user,
				'posts'=> $posts
				));
	}

	public function tryLogAdmin()
	{
		$view = new View('admin');
		$view->setTitle('Accès administrateur');
		$view->generate(array());
	}
	
	public function logout()
	{	
		$_SESSION['userUsername'] = [];
		session_destroy();
		header('Location: index.php');
	}

	
}



