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
		
		if (!isset($_SESSION['usernameError']) AND !isset($_SESSION['passwordError']) AND !isset($_SESSION['emailError'])){

			$this->user_manager->createUser($username, $password, $email);

			header('Location: index.php?action=dashboard');
		
		} else {
			$view = new View('user');
			$view ->setTitle('S\'inscrire');
			$view->generate(array());
		}
	}

	/**
	 * [registerUserPage]  
	 * @return [type] [description]
	 */
	public function registerUserPage()
	{
		$view = new View('user');
		$view ->setTitle('S\'inscrire');
		$view->generate(array());
	}
}



