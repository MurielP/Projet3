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
	 * @return [un nouvel utilisateur et renvoie vers page dashborad]
	 */
	public function registerUser($username, $password, $email)
	{	
		/**
		 * [$user] création de l'objet User 
		 * @var User qui comprend les champs username, password et email
		 */
		$user = new User(array(
			'username' => $username,
			'password' => $password,
			'email' => $email
		));

		
		/**
		 * si la tableau d'erreur est vide alors j'appelle la fonction createUser du user_manager
		 */
		if (count($_SESSION['errors']) == 0){
			$insert = $this->user_manager->createUser($user);
			/**
			 * si $insert est ok je renvoie le user vers dashboard
			 */
			if ($insert == true) {
				header('Location: index.php?action=dashboard');	
			} else {
				$view = new View('user');
				$view ->setTitle('S\'inscrire');
				$view->generate(array());
		
			}

		/**
		 * si mon tableau contient des erreurs alors je renvoie le visiteur sur la page d'inscription view_user.php
		 */
		} elseif (count($_SESSION['errors']) != 0) {
			$mailExist= $this->user_manager->alreadyExists($email);
			var_dump($mailExist); // retourne NULL ???
			
	
		//} else {
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
}



